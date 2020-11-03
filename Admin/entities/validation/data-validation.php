<?php

    function clean($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }

?>