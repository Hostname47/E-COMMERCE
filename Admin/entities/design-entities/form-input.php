<?php

    function generateInput($label_for, $label_content, $error, $input_type, $input_name, $input_id, $input_value) {
        echo <<<EOS
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="{$label_for}">{$label_content}</label>
                <div class="invalid-credential"><?php {$error} ?></div>
            </div>
            <input type="{$input_type}" name="{$input_name}" id="{$input_id}" class="styled-form-input" value="$input_value">
        EOS;
    }

?>