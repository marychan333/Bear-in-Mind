<?php 
session_start();
unset($_SESSION['user']);
unset($_COOKIE['user']);
echo "<script>alert('You have logout successfully!');location.href = '/home.php'</script>";
exit();