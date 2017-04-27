<?php
$data = 'This Text Will Encrypt and Decrypt using OpenSSL!!';
$secretKey = 'somerandomkey';
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));

function encrypt($data, $secretKey, $iv)
    {
        return trim(strtr(base64_encode(openssl_encrypt($data, 'AES-256-CBC', $secretKey, 0, $iv)),'+/=', '-_,'));
    }
$encrypted = encrypt($data, $secretKey, $iv);

function decrypt($encrypted, $secretKey, $iv)
    {
        return trim(openssl_decrypt(base64_decode(strtr($encrypted,'-_,', '+/=')),'AES-256-CBC', $secretKey, 0, $iv));
    }
$decrypted = decrypt($encrypted, $secretKey, $iv);

var_dump ('Encrypted: ' . $encrypted);
var_dump ('Decrypted: ' . $decrypted);
?>
