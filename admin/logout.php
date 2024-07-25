<?php
session_start();
require 'config.php';

function logoutSession() {
    session_destroy();
    header('Location: ../login.php');
    exit;
}

logoutSession();
?>