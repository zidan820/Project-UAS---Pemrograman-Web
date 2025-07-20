<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: admin/index.php');
} else {
    header('Location: login/index.php');
}
exit;
?>
