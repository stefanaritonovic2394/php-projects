<?php

    declare(strict_types = 1);

    class Login implements LoginInterface {
        public function loginUser(string $user): string
        {
            return $user . ' is logged in';
            //echo "Logging in user...";
        }
    }
