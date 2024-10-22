<?php

if(!session_id()){
session_start();
}

if(!isset($_SESSION['uname'])){
    header("location: login.php");
}
?>