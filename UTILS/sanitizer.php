<?php
    function sanitize_string($str){
        return filter_var($str, FILTER_SANITIZE_STRING);
    }
?>
