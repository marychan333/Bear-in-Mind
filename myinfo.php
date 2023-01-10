<?php
session_start();
if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    } else {
        header('location:home.php');
        exit();
    }
}

//获取自己的信息
require './config.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$uid = $_SESSION['user']['id'];
$sql = "SELECT username,email,addtime,gender FROM users WHERE id = $uid";

$user = mysqli_fetch_assoc($db->query($sql));


?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- 网页头部 -->
<?php require_once 'public/layouts/header.php' ?>
<link href="public/css/index.css" rel="stylesheet">
<body>
<!-- 网页内容区域 -->
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-6">
            <form action="home/Users.php" method="post">
                <div class="form-group">
                    <input type="hidden" name="type" value="update">
                    <label for="exampleInputEmail1">UserName</label>
                    <input type="text" disabled class="form-control" value="<?php echo $user['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">RegisterDate</label>
                    <input type="text" disabled class="form-control" value="<?php echo $user['addtime']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email"
                           value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" <?php if($user['gender'] == 'boy') echo 'checked'?> value="boy">Boy
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" <?php if($user['gender'] == 'girl') echo 'checked'?>  value="girl">Girl
                    </label>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password (If the password is blank, it will not be
                        modified)</label>
                    <input type="password" class="form-control" name="password" placeholder="password">
                </div>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>


</div>
<!-- 网页内容区域 -->


</body>
</html>

<script>

    function delDetail(id) {
        var r = confirm("Are you sure to delete");
        if (r == true) {
            $.post('home/Advice.php', {id: id, type: 'delDetail'}, function (data, textStatus, xhr) {
                if (textStatus == 'success') {

                    if (data == '1') {
                        location.reload(true);
                    } else {
                        alert('delete fail')
                    }
                }
            });
        }
    }


</script>