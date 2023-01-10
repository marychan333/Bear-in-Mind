<?php
session_start();
//if (!isset($_SESSION['user'])) {
//    header('location:index.php');
//}
//获取公告栏数据
require './config.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "SELECT * FROM notice WHERE id = 1";
$res = mysqli_fetch_assoc($db->query($sql));



?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- header部分 -->
<?php require_once 'public/layouts/header.php' ?>

<body>
<!-- 页面主体内容 -->
<div class="container">
    <div class="content">
        <div class="jumbotron">

            <div class=" alert alert-warning text-left">
                <h2 class="text-center"><?php echo $res['title']; ?></h2>
                <p><?php echo $res['content']; ?></p>
            </div>

        </div>
        <!-- 注册表单 -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="register"
             aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Register</h4>
                    </div>
                    <form action="home/Register.php" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">UserName:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="username" id="rusername" minlength="2"
                                           maxlength="20" placeholder="username">
                                </div>
                                <!-- 错误提示信息 -->
                                <h6 style="color: red;" id="dis_un"></h6>
                            </div>

                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">Gender:</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" checked  value="boy">Boy
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender"  value="girl">Girl
                                    </label>
                                </div>

                            </div>



                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label">Email:</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" name="email" id="remail"
                                           placeholder="Email">
                                </div>
                                <h6 style="color: red;" id="dis_em"></h6>
                            </div>



                            <div class="form-group">
                                <label for="password" class="col-sm-4 control-label">Password:</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password" id="rpassword"
                                           placeholder="password" minlength="6" maxlength="20">
                                </div>
                                <h6 style="color: red;" id="dis_pwd"></h6>
                            </div>

                            <div class="form-group">
                                <label for="confirm" class="col-sm-4 control-label">Confirm password:</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="confirm" id="rconfirm"
                                           placeholder="confirm" minlength="6" maxlength="20">
                                </div>
                                <h6 style="color: red;" id="dis_con_pwd"></h6>
                            </div>

                            <input type="hidden" name="type" value="all">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">
                                Close
                            </button>
                            <input type="reset" class="btn btn-warning" value="reset"/>
                            <button type="submit" class="btn btn-primary" id="reg">register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- 登陆表单 -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="login"
             aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                    <form action="home/Login.php" method="post" accept-charset="utf-8" class="form-horizontal">
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
                                <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">
                                    Close
                                </button>
                                <input type="reset" class="btn btn-warning" value="reset"/>
                                <button type="submit" class="btn btn-primary" name="login">Login</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div><!-- /.container -->
<script src="public/js/register.js"></script>
</body>
</html>