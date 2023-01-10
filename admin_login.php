<?php
session_start();
//未login會自動跳轉至 admin_home.php
if (isset($_SESSION['admin_user'])) {
    header('location:admin_home.php');
}
//获取公告栏数据
require './config.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "SELECT * FROM notice WHERE id = 1";
$res = mysqli_fetch_assoc($db->query($sql));


?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>admin</title>
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/header.css" rel="stylesheet">
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.js"></script>

    <style>

    </style>
</head>

<body  style="background-image: url('public/img/lg.jpg');padding-top: 0;">
<!-- 页面主体内容 -->
<div class="container">
    <div class="modal-dialog modal-lg" style="margin-top: 10%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center;" class="modal-title" id="myModalLabel">Administrator Login</h4>
            </div>
            <form action="admin/Login.php" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Username:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="username" id="username"
                                   placeholder="Username" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password:</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" placeholder="password"
                                   minlength="6" maxlength="20" required="">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <input type="reset" class="btn btn-warning" value="reset"/>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>
            </form>
        </div>
    </div>

</div><!-- /.container -->

</body>
</html>