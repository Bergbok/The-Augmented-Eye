<?php
    //Modified version of: https://gist.github.com/fedir/4662cd863475eb08765ecf19e302949a

    //Used to generate a random password
    function generatePassword(int $length): string {
        return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
    }

    //Used in generatePassword function
    function getRandomBytes(int $nbBytes = 32): string  {
        $strong = null;
        $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
        if ($bytes !== false && $strong === true) {
            return $bytes;
        }
        else {
            throw new Exception("Unable to generate secure token from OpenSSL.");
        }
    }
?>