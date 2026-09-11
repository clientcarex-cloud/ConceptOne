<?php
/**
 * Enquiry handling for contact.php.
 *
 * Stateless CSRF (an HMAC-signed timestamp) so no session cookie is needed.
 * Every enquiry is appended to storage/enquiries.log before mail is
 * attempted, so nothing is lost if the host's mail transport is down.
 */
declare(strict_types=1);

const TOKEN_LIFETIME = 7200; // 2 hours
const TOKEN_MIN_AGE  = 2;    // a bot fills the form faster than this

/** Signing key, created on first use. */
function secret(): string
{
    $file = ROOT . '/storage/secret.key';
    if (is_file($file)) {
        return (string) file_get_contents($file);
    }

    $key = bin2hex(random_bytes(32));
    @mkdir(dirname($file), 0775, true);
    file_put_contents($file, $key, LOCK_EX);

    return $key;
}

function csrf_token(): string
{
    $ts = (string) time();

    return $ts . '.' . hash_hmac('sha256', $ts, secret());
}

function csrf_valid(string $token): bool
{
    [$ts, $mac] = array_pad(explode('.', $token, 2), 2, '');
    if ($ts === '' || !ctype_digit($ts)) {
        return false;
    }
    if (!hash_equals(hash_hmac('sha256', $ts, secret()), $mac)) {
        return false;
    }

    $age = time() - (int) $ts;

    return $age >= TOKEN_MIN_AGE && $age <= TOKEN_LIFETIME;
}

/** One-line-per-enquiry JSON log, so no request is dropped. */
function log_enquiry(array $data, bool $mailed): void
{
    $file = ROOT . '/storage/enquiries.log';
    @mkdir(dirname($file), 0775, true);
    file_put_contents(
        $file,
        json_encode($data + ['mailed' => $mailed, 'at' => date('c')], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n",
        FILE_APPEND | LOCK_EX
    );
}

/** Strip anything that could forge a mail header. */
function header_safe(string $v): string
{
    return trim(str_replace(["\r", "\n"], ' ', $v));
}

function redirect(string $to, int $status = 303): never
{
    header('Location: ' . $to, true, $status);
    exit;
}

/**
 * Validate and deliver a submission. Redirects on success.
 *
 * @return array{errors: array<string,string>, values: array<string,string>}
 */
function handle_enquiry(): array
{
    $field = static fn (string $k): string => header_safe((string) ($_POST[$k] ?? ''));

    $values = [
        'name'       => mb_substr($field('name'), 0, 120),
        'phone'      => mb_substr($field('phone'), 0, 20),
        'email'      => mb_substr($field('email'), 0, 160),
        'interest'   => $field('interest'),
        'budget'     => $field('budget'),
        'visit_date' => $field('visit_date'),
        'message'    => trim((string) ($_POST['message'] ?? '')),
        'consent'    => ($_POST['consent'] ?? '') === '1' ? '1' : '',
        'source'     => mb_substr($field('source'), 0, 60),
    ];

    // Honeypot: a real browser never fills a hidden field.
    if (($_POST['website'] ?? '') !== '') {
        redirect(url('contact') . '?sent=1#enquire');
    }

    // Only accept values the form actually offers.
    if (!in_array($values['interest'], interest_options(), true)) {
        $values['interest'] = '';
    }
    if (!in_array($values['budget'], [...array_column(BUDGETS, 0), 'Not decided yet'], true)) {
        $values['budget'] = '';
    }

    $errors = [];
    if (!csrf_valid((string) ($_POST['token'] ?? ''))) {
        $errors['form'] = 'Your session expired. Please send the form again.';
    }
    if ($values['name'] === '') {
        $errors['name'] = 'Please tell us your name.';
    }
    $digits = preg_replace('/\D+/', '', $values['phone']);
    if (strlen((string) $digits) < 10 || strlen((string) $digits) > 15) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }
    if ($values['email'] !== '' && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ($values['visit_date'] !== '') {
        $d = DateTimeImmutable::createFromFormat('!Y-m-d', $values['visit_date']);
        if (!$d || $d->format('Y-m-d') !== $values['visit_date'] || $values['visit_date'] < date('Y-m-d')) {
            $errors['visit_date'] = 'Please choose a date from today onwards.';
        }
    }
    if (mb_strlen($values['message']) > 3000) {
        $errors['message'] = 'Please keep the message under 3,000 characters.';
    }
    if ($values['consent'] !== '1') {
        $errors['consent'] = 'Please agree so our team can get back to you.';
    }

    if ($errors) {
        return ['errors' => $errors, 'values' => $values];
    }

    $labels = [
        'name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'interest' => 'Interested in',
        'budget' => 'Budget', 'visit_date' => 'Preferred visit', 'message' => 'Message', 'source' => 'Source',
    ];
    $body = '';
    foreach ($labels as $k => $label) {
        $body .= $label . ': ' . ($values[$k] === '' ? '—' : $values[$k]) . "\n";
    }

    $domain  = (string) parse_url(SITE_URL, PHP_URL_HOST);
    $headers = [
        'From'         => SITE_NAME . ' <no-reply@' . $domain . '>',
        'Content-Type' => 'text/plain; charset=UTF-8',
    ];
    if ($values['email'] !== '') {
        $headers['Reply-To'] = $values['email'];
    }
    $mailed = @mail(
        MAIL_TO,
        'New enquiry — ' . $values['name'] . ($values['interest'] !== '' ? ' · ' . $values['interest'] : ''),
        $body,
        $headers
    );

    log_enquiry($values, $mailed);
    redirect(url('contact') . '?sent=1#enquire');
}
