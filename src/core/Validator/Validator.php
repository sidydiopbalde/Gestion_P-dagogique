<?php


namespace App\Controller;
namespace Core\Validator;
use App\App;
use Core\Controller;

class Validator {
    private $errors = [];
    private $utilisateurModel;
        public function __construct() {
            $this->utilisateurModel = App::getInstance()->getModel("utilisateur");
        }

        public function validate($data, $rules) {
            foreach ($rules as $field => $ruleSet) {
                $value = isset($data[$field]) ? $data[$field] : null;
                $rules = explode('|', $ruleSet);
                foreach ($rules as $rule) {
                    if ($rule === 'required' && empty($value)) {
                        $this->errors[$field] = "Le champ $field est obligatoire.";
                    } elseif ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[$field] = "Le champ $field doit être une adresse email valide.";
                    }
                    elseif ($rule === 'email' && $this->utilisateurModel->findByMail($value)) {
                        $this->errors[$field] = "Ce mail existe déjà dans la base de données.";
                    }
                     elseif (strpos($rule, 'min:') === 0) {
                        $min = (int) str_replace('min:', '', $rule);
                        if (strlen($value) < $min) {
                            $this->errors[$field] = "Le champ $field doit contenir au moins $min caractères.";
                        }
                    } elseif (strpos($rule, 'max:') === 0) {
                        $max = (int) str_replace('max:', '', $rule);
                        if (strlen($value) > $max) {
                            $this->errors[$field] = "Le champ $field ne doit pas dépasser $max caractères.";
                        }
                    } elseif (strpos($rule, 'regex:') === 0) {
                        $pattern = str_replace('regex:', '', $rule);
                        if (!preg_match($pattern, $value)) {
                            $this->errors[$field] = "Le champ $field n'est pas dans un format valide.";
                        }
                    } elseif ($rule === 'tel') {
                        if ($this->utilisateurModel->findByPhone($value)) {
                            $this->errors[$field] = "Ce numéro existe déjà dans la base de données.";
                        }
                    }
                }
            }
        }
    public function fails() {
        return !empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }
}

