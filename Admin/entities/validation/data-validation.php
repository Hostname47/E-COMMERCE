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

?>