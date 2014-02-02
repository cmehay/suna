<?php
include('scripts/functions.php');
//automatise le passage en https
if ($_SERVER['HTTPS'] != "on")
{
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}
session_start();
if (isset($_SESSION['edit_user']))
{
    unset($_SESSION['edit_user']);
}
print(parse());
?>