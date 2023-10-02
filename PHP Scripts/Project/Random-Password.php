<?php
// using rand() or mt_rand() are not secure according to the PHP manual.

function getRandomBytes($nbBytes = 32)
{
    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
    if ($bytes !== false && $strong === true) {
        return $bytes;
    }
    else {
        throw new Exception("Unable to generate secure token from OpenSSL.");
    }
}

function generatePassword($length){
    return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
}

$password = generatePassword(10);
echo $password .'<br>';
echo strlen($password);

?>