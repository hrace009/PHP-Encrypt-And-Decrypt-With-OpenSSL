<?php
/**
* Main Code By: Khucing Ithem : https://www.facebook.com/backcat
* Make with Class by: hrace009
**/
$data = 'Text ini akan di encrypt menggunakan openssl! dan akan di decrypt dengan openssl juga';
$secretKey = 'mykey';

class MyCrypt {
    public static function safe_encode ($text)
    {
        return trim(strtr(base64_encode($text), '+/=', '-_,'));
    }
    
    public static function safe_decode($text)
    {
        return base64_decode(strtr($text, '-_,', '+/='));
    }
    
    public static function encrypt($data, $secretKey)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        $cipher = openssl_encrypt($data, 'AES-256-CBC', $secretKey, 0, $iv);
        
        $safe_cipher = MyCrypt::safe_encode($cipher);
        $safe_iv = MyCrypt::safe_encode($iv);
        
        return $safe_cipher . '::' . $safe_iv;
    }
    
    public static function decrypt($encrypted, $secretKey)
    {
        $token = explode('::', $encrypted);
        $cipher = MyCrypt::safe_decode($token[0]);
        $iv = MyCrypt::safe_decode($token[1]);
        
        $plain = openssl_decrypt($cipher, 'AES-256-CBC', $secretKey, 0, $iv);
        
        return trim($plain);
    }
}

$encrypted = MyCrypt::encrypt($data, $secretKey);
$decrypted = MyCrypt::decrypt($encrypted, $secretKey);
var_dump('Encrypted: ' . $encrypted);
var_dump('Decrypted: ' . $decrypted);
?>
