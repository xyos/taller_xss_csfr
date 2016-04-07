<?
$file = '/tmp/tokens.txt';
// Open the file to get existing content
// Append a new person to the file
$token = $_GET['token'] . "\n";
// Write the contents back to the file
file_put_contents($file, $token, FILE_APPEND | LOCK_EX);
