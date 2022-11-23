<?php
    session_start();
    $key = $_POST['key'];
    unset($_SESSION['products'][$key]);
    echo true;
    exit;
