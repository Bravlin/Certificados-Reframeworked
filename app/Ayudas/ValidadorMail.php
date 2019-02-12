<?php

namespace App\Ayudas;

abstract class ValidadorMail
{
    public static function superValidateEmail($email)
    {
        // SET INITIAL RETURN VARIABLES
        $emailIsValid = !empty($email);

        // MAKE SURE AN EMPTY STRING WASN'T PASSED
        if ($emailIsValid) {
            // GET EMAIL PARTS
            $domain = ltrim(stristr($email, '@'), '@') . '.';
            $user   = stristr($email, '@', true);

            // VALIDATE EMAIL ADDRESS
            $emailIsValid = !empty($user) && !empty($domain) && checkdnsrr($domain);
        }

        // RETURN RESULT
        return $emailIsValid;
    }
}
