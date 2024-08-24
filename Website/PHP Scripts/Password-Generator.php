<?php

/**
 * Filename: About.php
 * Author: Albertus Cilliers & Fedir RYKHTIK fedir (https://gist.github.com/fedir)
 * Description: Used to generate a secure password when a new user registers.
 *              Modified version of: https://gist.github.com/fedir/4662cd863475eb08765ecf19e302949a
 */

/**
 * Generates a secure password
 * Yoinked from: https://gist.github.com/fedir/4662cd863475eb08765ecf19e302949a
 * @param int $length Length of password
 * 
 * @return string Password
 */
function generate_password(int $length): string {
    return substr(preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(get_random_bytes($length+1))),0,$length);
}

/**
 * Gets pseudo-random bytes
 * Yoinked from: https://gist.github.com/fedir/4662cd863475eb08765ecf19e302949a
 * @param int $nbBytes Number of pseudo-random bytes to generate
 * 
 * @return string String of bytes
 */
function get_random_bytes(int $nbBytes = 32): string  {
    $strong = null;
    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
    if ($bytes !== false && $strong === true) {
        return $bytes;
    }
    else {
        throw new Exception('Unable to generate secure token from OpenSSL.');
    }
}

// EOF
