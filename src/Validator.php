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
        "regex" => "This format is not respected!",
        "url" => "This field must correspond to a url!",
        "email" => "This field must correspond to an email: exemple@gmail.com!",
        "phone" => "This field must correspond to a phone number!",
        "creditCard" => "This field must correspond to a credit card number!",
        "date" => "This field must be a date!",
        "time" => "This field must be time!",
        "alpha" => "This field can only contain uppercase and lowercase letters!",
        "numeric" => "This field can only contain numbers!",
        "alphaNum" => "This field can only contain lowercase letters, uppercase letters and numbers!",
        "alphaSpace" => "This field can contain only lowercase letters, uppercase letters, spaces!",
        "alphaNumDash" => "This field can only contain lowercase letters, uppercase letters, numbers, slashes and hyphens!",
        "alphaNumDashUnderscore" => "This field can only contain letters, numbers, hyphens and underscores!",
        "confirm" => "This field does not comply with confirmation!"
    ];
    // FR
    // private $messages = [
    //     "required" => "Ce champ est requis !",
    //     "min" => "Ce champ doit contenir moins de %^% lettres !",
    //     "max" => "Ce champ doit contenir plus de %^% lettres !",
    //     "length" => "Ce champ doit contenir %^% caractère(s) !",
    //     "regex" => "Ce format n'est pas respecté ! ",
    //     "url" => "Ce champ doit correspondre à une url !",
    //     "email" => "Ce champ doit correspondre à une email: exemple@gmail.com !",
    //     "phone" => "Ce champ doit correspondre à un numéro de téléphone !",
    //     "creditCard" => "Ce champ doit correspondre à un numéro de carte de crédit !",
    //     "date" => "Ce champ doit être une date !",
    //     "time" => "Ce champ doit être temporel !",
    //     "alpha" => "Ce champ peut contenir que des lettres minuscules et majuscules !",
    //     "numeric" => "Ce champ peut contenir que des chiffres !",
    //     "alphaNum" => "Ce champ peut contenir que des lettres et des chiffres !",
    //     "alphaSpace" => "Ce champ peut contenir que des lettres, espace !",
    //     "alphaNumDash" => "Ce champ peut contenir que des lettres, des chiffres, des slashs et des tirets !",
    //     "alphaNumDashUnderscore" => "Ce champ peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement !",
    //     "confirm" => "Ce champs n'est pas conforme au confirm !"
    // ];
    private $rules = [
        "required" => "#^.+$#",
        "min" => "#^.{ù,}$#",
        "max" => "#^.{0,ù}$#",
        "length" => "#^.{ù}$#",
        "regex" => "ù",
        "url" => FILTER_VALIDATE_URL,
        "email" => FILTER_VALIDATE_EMAIL,
        "phone" => "#^\+(?:[0-9] ?){6,14}[0-9]$#",
        "creditCard" => "#^(?:[0-9]{4}-?){3}[0-9]{4}$#",
        "date" => "#^(\d{4})(\/|-)(0[0-9]|1[0-2])(\/|-)([0-2][0-9]|3[0-1])$#",
        "time" => "#^([01]?[0-9]|2[0-3]):[0-5][0-9]$#",
        "alpha" => "#^[A-z]+$#",
        "numeric" => "#^[0-9]+$#",
        "alphaNum" => "#^[A-z0-9]+$#",
        "alphaSpace" => "#^[A-z À-ú]+$#",
        "alphaNumDash" => "#^[A-z0-9-\|]+$#",
        "alphaNumDashUnderscore" => "#^[A-z0-9-_]+$#",
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