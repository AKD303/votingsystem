<?php
// Small helper functions for the project

function redirect($path){
    // $path can be absolute (starting with http) or relative to BASE_URL
    if (filter_var($path, FILTER_VALIDATE_URL)) {
        header('Location: ' . $path);
    } else {
        header('Location: ' . rtrim(BASE_URL, '/') . '/' . ltrim($path, '/'));
    }
    exit;
}

function e($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
