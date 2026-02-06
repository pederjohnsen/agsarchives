<?php
// Function to log traffic
function logTraffic($requestedUrl, $referrer, $userAgent, $clientIP)
{
  $logFile = 'traffic.log';
  $timestamp = date('Y-m-d H:i:s');
  $logEntry = sprintf(
    "[%s] IP: %s | URL: %s | Referrer: %s | User-Agent: %s\n",
    $timestamp,
    $clientIP,
    $requestedUrl,
    $referrer,
    $userAgent
  );
  file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Capture request information
$requestedUrl = $_SERVER['REQUEST_URI'] ?? '/';
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

// Get client IP (handles proxies)
$clientIP = '';
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $clientIP = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $clientIP = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
}

// Log the traffic
logTraffic($requestedUrl, $referrer, $userAgent, $clientIP);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="/favicon.ico">

  <style>
    body,
    html {
      padding: 0;
      margin: 0;
    }

    .app {
      max-width: 100%;
      width: 1701px;
      margin: 0 auto;
      min-height: 100vh;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      background: center / auto no-repeat url('/agsa.png');
    }
  </style>

  <title>AGS Archives</title>
</head>

<body>
  <div class="app"></div>
</body>

</html>
