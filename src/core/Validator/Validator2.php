<?php
namespace App\Core;

class Validator {
    private $data;
    private $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function validateRequired($field) {
        if (empty($this->data[$field])) {
            $this->errors[$field][] = 'This field is required.';
        }
    }

    public function validateEmail($field) {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Invalid email format.';
        }
    }

    public function validateLength($field, $min, $max) {
        $length = strlen($this->data[$field]);
        if ($length < $min || $length > $max) {
            $this->errors[$field][] = "The length of this field must be between $min and $max characters.";
        }
    }

    public function validateFile($field, $types) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $fileType = mime_content_type($_FILES[$field]['tmp_name']);
            if (!in_array($fileType, $types)) {
                $this->errors[$field][] = 'Invalid file type.';
            }
        } else {
            $this->errors[$field][] = 'File upload error.';
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }
}
