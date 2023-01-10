<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    header('location:admin_login.php');
}
//根据id用户
require './config.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "SELECT * FROM users where id = $_GET[id] ";
$retval = mysqli_query($db, $sql);
$user = mysqli_fetch_array($retval, MYSQLI_ASSOC);




?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- header部分 -->
<?php require_once 'public/layouts/admin_header.php' ?>
<div class="container" style="margin-top: 1%;">
    <div class="modal-dialog modal-lg" style="margin-top: 10%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center;" class="modal-title" id="myModalLabel">Edit User Info</h4>
            </div>
            <form action="admin/User.php" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?php echo $user['id'];?>">
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Username:</label>
                        <div class="col-sm-6">
                            <input disabled type="text" class="form-control" name="username" id="username"
                                   placeholder="Username" required="" value="<?php echo $user['username']?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password:</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" placeholder="password"
                                   minlength="6" maxlength="20">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Email:</label>
                        <div class="col-sm-6">
                            <input  value="<?php echo $user['email']?>" type="email" class="form-control" name="email" placeholder="Email"
                                   minlength="6" maxlength="20">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">gender:</label>
                        <div class="radio-list">
                            <label>
                                <input type="radio" value="boy" <?php  if($user['gender'] == 'boy') echo 'checked';?> name="gender" data-title="boy"/> boy
                            </label>
                            <label>
                                <input type="radio" value="girl" name="gender" <?php  if($user['gender'] == 'girl') echo 'checked';?> data-title="girl"/> girl
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" >Edit</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<body>
