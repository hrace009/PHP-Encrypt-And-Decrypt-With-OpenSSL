<?php
/**
* Author: Khucing Ithem : https://www.facebook.com/backcat
**/
$data = 'Text ini akan di encrypt menggunakan openssl! dan akan di decrypt dengan openssl juga';
$secretKey = 'mykey';

function safe_encode($text)
{
    return trim(strtr(base64_encode($text), '+/=', '-_,'));
}
function safe_decode($text)
{
    return base64_decode(strtr($text, '-_,', '+/='));
}

function encrypt($data, $secretKey)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $cipher = openssl_encrypt($data, 'AES-256-CBC', $secretKey, 0, $iv);
        
        $safe_cipher = safe_encode($cipher);
        $safe_iv = safe_encode($iv);
        
        return $safe_cipher . '::' . $safe_iv;
    }
$encrypted = encrypt($data, $secretKey);

function decrypt($encrypted, $secretKey)
    {
        $token = explode('::', $encrypted);
        $cipher = safe_decode($token[0]);
        $iv = safe_decode($token[1]);
        
        $plain = openssl_decrypt($cipher, 'AES-256-CBC', $secretKey, 0, $iv);
        
        return trim($plain);
    }
$decrypted = decrypt($encrypted, $secretKey);

var_dump('Encrypted: ' . $encrypted);
var_dump('Decrypted: ' . $decrypted);
