<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    header('location:admin_login.php');
}
//根据id用户
require './config.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "SELECT * FROM notice where id =1 ";
$retval = mysqli_query($db, $sql);
$notice = mysqli_fetch_array($retval, MYSQLI_ASSOC);

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
                    <input type="hidden" name="type" value="update_notice">
                    <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Title:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="<?php echo $notice['title'];?>" name="title" placeholder="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">content:</label>
                        <div class="col-sm-6">
                        <textarea name="content"  class="form-control" rows="10"><?php echo $notice['content']?></textarea>
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
