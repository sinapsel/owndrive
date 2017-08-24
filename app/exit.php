<?php
session_start();
unset($_SESSION['logedin_user']);
session_destroy();

header("Location: /");
?>
