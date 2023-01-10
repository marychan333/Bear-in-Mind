<?php 
session_start();
unset($_SESSION['admin_user']);
echo "<script>alert('You have logout successfully!');location.href = '/admin_login.php'</script>";
exit();