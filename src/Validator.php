<?php

namespace Project;

/** Class Validator **/
class Validator
{

    private $data;
    private $errors = [];
    // EN
    private $messages = [
        "required" => "The field is required!",
        "min" => "This field must contain less than %^% letters!",
        "max" => "This field must contain a maximum of %^% letters!",
        "length" => "This field must contain %^% characters!",
        "regex" => "This format is not respected",
        "url" => "This field must correspond to a url!",
        "email" => "This field must correspond to an email: exemple@gmail.com!",
        "date" => "This field must be a date!",
        "alpha" => "This field can only contain uppercase and lowercase letters!",
        "alphaNum" => "This field can only contain lowercase letters, uppercase letters and numbers!",
        "alphaNumDash" => "This field can only contain lowercase letters, uppercase letters, numbers, slashes and hyphens!",
        "alphaSpace" => "This field can contain only lowercase letters, uppercase letters, spaces.",
        "numeric" => "This field can only contain numbers!",
        "confirm" => "This field does not comply with confirmation!"
    ];
    // FR
    // private $messages = [
    //     "required" => "Ce champ est requis!",
    //     "min" => "Ce champ doit contenir moins de %^% lettres!",
    //     "max" => "Ce champ doit contenir plus de %^% lettres!",
    //     "length" => "Ce champ doit contenir %^% caractère(s)!",
    //     "regex" => "Ce format n'est pas respecté",
    //     "url" => "Ce champ doit correspondre à une url!",
    //     "email" => "Ce champ doit correspondre à une email: exemple@gmail.com!",
    //     "date" => "Ce champ doit être une date!",
    //     "alpha" => "Ce champ peut contenir que des lettres minuscules et majuscules!",
    //     "alphaNum" => "Ce champ peut contenir que des lettres minuscules, majuscules et des chiffres!",
    //     "alphaNumDash" => "Ce champ peut contenir que des lettres minuscules, majuscules, des chiffres, des slashs et des tirets!",
    //     "alphaSpace" => "Ce champ peut contenir que des lettres minuscules, majuscules, espace",
    //     "numeric" => "Ce champ peut contenir que des chiffres!",
    //     "confirm" => "Ce champs n'est pas conforme au confirm!"
    // ];
    private $rules = [
        "required" => "#^.+$#",
        "min" => "#^.{ù,}$#",
        "max" => "#^.{0,ù}$#",
        "length" => "#^.{ù}$#",
        "regex" => "ù",
        "url" => FILTER_VALIDATE_URL,
        "email" => FILTER_VALIDATE_EMAIL,
        "date" => "#^(\d{4})(\/|-)(0[0-9]|1[0-2])(\/|-)([0-2][0-9]|3[0-1])$#",
        "alpha" => "#^[A-z]+$#",
        "alphaNum" => "#^[A-z0-9]+$#",
        "alphaNumDash" => "#^[A-z0-9-\|]+$#",
        "alphaSpace" => "#^[A-z À-ú]+$#",
        "numeric" => "#^[0-9]+$#",
        "confirm" => ""
    ];

    public function __construct($data = [])
    {
        $this->data = $data ?: $_POST;
    }

    public function validate($array)
    {
        foreach ($array as $field => $rules) {
            $this->validateField($field, $rules);
        }
    }

    public function validateField($field, $rules)
    {
        foreach ($rules as $rule) {
            $this->validateRule($field, $rule);
        }
    }

    public function validateRule($field, $rule)
    {
        $res = strrpos($rule, ":");
        if ($res == true) {
            $repRule = explode(":", $rule);
            $changeRule = str_replace("ù", $repRule[1], $this->rules[$repRule[0]]);
            $changeMessage = str_replace("%^%", $repRule[1], $this->messages[$repRule[0]]);

            if (!preg_match($changeRule, $this->data[$field])) {
                $this->errors = [$this->messages[$repRule[0]]];
                $this->storeSession($field, $changeMessage);
            }
        } elseif ($res == false) {
            if ($rule == "confirm") {
                if (!isset($this->data[$field . 'Confirm'])) {
                    $this->errors = ["Nous buttons sur un problème"];
                    $this->storeSession('confirm', "Nous buttons sur un problème");
                } elseif (isset($this->data[$field . 'Confirm']) && $this->data[$field] != $this->data[$field . 'Confirm']) {
                    $this->errors = [$this->messages[$rule]];
                    $this->storeSession('confirm', $this->messages[$rule]);
                }
                return;
            }
            if ($rule == "email" || $rule == "url") {
                if (!filter_var($this->data[$field], $this->rules[$rule])) {
                    $this->errors = [$this->messages[$rule]];
                    $this->storeSession($field, $this->messages[$rule]);
                }
            } elseif (!preg_match($this->rules[$rule], $this->data[$field])) {
                $this->errors = [$this->messages[$rule]];
                $this->storeSession($field, $this->messages[$rule]);
            }
        }
    }

    public function errors()
    {
        return $this->errors;
    }

    public function storeSession($field, $error)
    {
        if (!isset($_SESSION["error"][$field])) {
            $_SESSION["error"][$field] = $error;
        } else {
            return;
        }
    }
}