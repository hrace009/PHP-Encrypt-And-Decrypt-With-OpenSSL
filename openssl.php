<?php
$data = 'This Text Will Encrypt and Decrypt using OpenSSL!!'; // Define text will encrypted.
$secretKey = 'somerandomkey'; // Define some random key.
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC')); // Define your initialization vector.

// Function to encryp
function encrypt($data, $secretKey, $iv)
    {
        return trim(strtr(base64_encode(openssl_encrypt($data, 'AES-256-CBC', $secretKey, 0, $iv)),'+/=', '-_,'));
    }
$encrypted = encrypt($data, $secretKey, $iv); // Encrypted Result

// Function to decrypt
function decrypt($encrypted, $secretKey, $iv)
    {
        return trim(openssl_decrypt(base64_decode(strtr($encrypted,'-_,', '+/=')),'AES-256-CBC', $secretKey, 0, $iv));
    }
$decrypted = decrypt($encrypted, $secretKey, $iv); // Decrypted Result

var_dump ('Encrypted: ' . $encrypted); // Dump the value, or you can use echo
var_dump ('Decrypted: ' . $decrypted); // Dump the value, or you can use echo
?>
