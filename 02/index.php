<?php
session_start();

if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) || (isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true)) {
	header("Location: http://www.google.com");
	exit();
}
