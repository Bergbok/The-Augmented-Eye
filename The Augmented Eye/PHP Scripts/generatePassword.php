<?php
    //Used in generatePassword function
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

    //Used to generate a random password
    function generatePassword($length){
        return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
    }
?>