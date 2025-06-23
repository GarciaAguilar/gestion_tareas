<?php
// Eliminar la cookie del token
setcookie("token", "", time() - 3600, "/");

// Redireccionar al login
header("Location: login.php");
exit();
