<?php
session_start();
session_unset($_SESSION['codigo']);
session_destroy();

header('location: index.html');
?>