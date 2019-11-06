<?php

    class Login implements LoginInterface {
        public function loginUser($user)
        {
            return $user . ' is logged in';
            //echo "Logging in user...";
        }
    }
