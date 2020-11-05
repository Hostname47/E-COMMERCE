<?php

    function clean($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function validName($name) {
        // Valid name should contains at least 2 alphanumeric items
        // it shuld begin with character
        return (preg_match("/^[a-zA-Z][a-zA-Z0-9_]{1,}$/", $name)) ? true: false;
    }

    function valideCity($city) {
        return preg_match("/^[a-zA-Z0-9_\s]+$/", $city) ? true : false;
    }

    function validePostalCode($postal_code) {
        return preg_match("/^[a-zA-Z0-9_-]+$/", $postal_code) ? true : false;
    }

    function valideEmail($email) {
        $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/";
        return preg_match($pattern, $email) ? true : false;
    }

?>