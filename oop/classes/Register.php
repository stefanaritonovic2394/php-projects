<?php

    class Register implements RegisterInterface {
        public function registerUser($user)
        {
            return $user . ' is registered';
            //echo "Registering user..." . $user;
        }
    }
