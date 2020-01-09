<?php

    namespace App\Classes;

    class Validator implements ValidatorInterface
    {
        private $validators;
        private $allowedValues = [];
        private $errors = [];

        public function validate(array $data)
        {
            $this->validators = $data;
            return $this;
        }

        public function int()
        {
            if (!is_int($this->validators)) {
                $this->errors[] = "Must be integer";
            }
            return $this;
        }

        public function empty()
        {
            if (empty($this->validators)) {
                $this->errors[] = "Must not be empty";
            }
            return $this;
        }

        public function operator()
        {
            $this->allowedValues = [
                '=',
                '<',
                '>'
            ];
            list(,$operator,) = $this->validators;

            if (!in_array($operator, $this->allowedValues)) {
                $this->errors[] = "Operator must be '='";
            }

            return $this;
        }

        public function max($value, $numberOfChars)
        {
            if (strlen($value) > $numberOfChars) {
                $this->errors[] = "Must not be greater than 10 characters";
            }
            return $this;
        }

        public function min($value, $numberOfChars)
        {
            if (strlen($value) < $numberOfChars) {
                $this->errors[] = "Must be at least 6 characters long";
            }
            return $this;
        }

        public function getErrors() {
            return $this->errors;
        }

    }
