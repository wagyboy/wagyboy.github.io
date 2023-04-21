<?php
session_start();
session_destroy();
unset($_SESSION["login_session"]);
header("Location: login.php");
exit;
?>