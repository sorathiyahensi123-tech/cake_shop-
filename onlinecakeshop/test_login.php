<?php
$url_base = 'http://localhost/cakeshopping-main/online-cake-shop-master/onlinecakeshop';

// First, get the captcha to initialize the session and get the PHPSESSID
$ch = curl_init($url_base . '/captcha.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
$response = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
curl_close($ch);

if (!isset($cookies['PHPSESSID'])) {
    die("Error: No PHPSESSID cookie received.\n");
}
$phpsessid = $cookies['PHPSESSID'];

// Since we cannot read the session from the server side without loading the session file, 
// let's read the session file directly to get the captcha code!
$session_file = "C:/xampp/tmp/sess_" . $phpsessid;
if (!file_exists($session_file)) {
    die("Error: Session file not found at $session_file\n");
}
$session_data = file_get_contents($session_file);
// Session data format: captcha_code|s:6:"123456";
preg_match('/captcha_code\|s:\d+:"([^"]+)"/', $session_data, $m);
if (!isset($m[1])) {
    die("Error: captcha_code not found in session data: $session_data\n");
}
$captcha_code = $m[1];
echo "Got Captcha Code: $captcha_code\n";

// Now submit the login form
$post_data = http_build_query([
    'users_username' => 'kaxeel',
    'users_password' => '123',
    'captcha_code' => $captcha_code
]);

$ch2 = curl_init($url_base . '/login_check_users.php');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HEADER, true); // We want headers for Location check
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch2, CURLOPT_COOKIE, "PHPSESSID=" . $phpsessid);
$response2 = curl_exec($ch2);
$header_size2 = curl_getinfo($ch2, CURLINFO_HEADER_SIZE);
$headers2 = substr($response2, 0, $header_size2);
$body2 = substr($response2, $header_size2);
curl_close($ch2);

echo "--- Response Headers ---\n$headers2\n";
echo "--- Response Body ---\n" . substr($body2, 0, 500) . "\n";
