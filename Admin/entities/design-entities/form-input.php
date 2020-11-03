<?php

    function generateInputText($label_for, $label_content, $error, $input_type, $input_name, $input_id, $input_value) {
        echo <<<EOS
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="{$label_for}">{$label_content}</label>
                <div class="invalid-credential">{$error}</div>
            </div>
            <input type="{$input_type}" name="{$input_name}" id="{$input_id}" class="styled-form-input" value="$input_value">
        EOS;
    }

    function generateDisabledInputText($label_for, $label_content, $error, $input_type, $input_name, $input_id, $input_value) {
        echo <<<EOS
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="{$label_for}">{$label_content}</label>
                <div class="invalid-credential">{$error}</div>
            </div>
            <input type="{$input_type}" name="{$input_name}" id="{$input_id}" class="styled-form-input" value="$input_value" disabled>
        EOS;
    }

    function generateFileInput($label_for, $label_content, $error, $input_name, $input_id) {
        echo <<<EOS
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="{$label_for}">{$label_content}</label>
                <div class="invalid-credential">{$error}</div>
            </div>
            <input type="file" name="{$input_name}" id="{$input_id}" class="styled-form-input">
        EOS;
    }

    function generateTextArea($label_for, $label_content, $error, $input_name, $input_id, $input_value) {
        echo <<<EOS
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="{$label_for}">{$label_content}</label>
                <div class="invalid-credential">{$error}</div>
            </div>
            <textarea style="height: 50px; max-width: 300px; min-height: 50px; transition: all 0.1s ease; max-height: 200px;" class="styled-form-input" name="{$input_name}" id="{$input_id}">{$input_value}</textarea>
        EOS;
    }

?>