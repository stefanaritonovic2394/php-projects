<?php

    declare(strict_types = 1);

    class Register implements RegisterInterface {
        public function registerUser(string $user): string
        {
            return $user . ' is registered';
            //echo "Registering user..." . $user;
        }
    }
