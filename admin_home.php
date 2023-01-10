<?php
session_start();
//未login會自動跳轉至 admin_home.php
if (!isset($_SESSION['admin_user'])) {
    header('location:admin_login.php');
}
//获取公告栏数据
require './config.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "SELECT * FROM users ";
$retval = mysqli_query( $db, $sql );

while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)){
    $user[] = $row;
}




?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- header部分 -->
<?php require_once 'public/layouts/admin_header.php' ?>
<div class="container" style="margin-top: 5%;">
    <table class="table table-hover table-bordered mt-3">
        <thead class="thead-inverse">
        <tr>
            <th class="text-center align-middle">Name</th>
            <th class="text-center align-middle">Email</th>
            <th class="text-center align-middle">Gender</th>
            <th class="text-center align-middle">Register Time</th>
            <th class="text-center align-middle">Operate</th>
        </tr>
        </thead>
        <tbody class="text-center">
        <?php foreach($user as $v): ?>
            <tr>
                <td class="align-middle"><?php echo $v['username']; ?></td>
                <td class="align-middle"><?php echo $v['email']; ?></td>
                <td class="align-middle"><?php echo $v['gender']; ?></td>
                <td class="align-middle"><?php echo $v['addtime']; ?></td>
                <td class="align-middle">
                    <a class="btn btn-info mr-2" href="admin_edit_user.php?id=<?php echo $v['id']; ?>">Edit</a>
                    <a  style="margin-left: 20px;" class="btn btn-danger ml-2" onclick="del(<?php echo $v['id']?>)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
</div>
<body>
<script>
    function del(id) {
        var r = confirm("Are you sure to delete");
        if (r == true) {
            $.post('admin/User.php', {id: id, type: 'del'}, function (data, textStatus, xhr) {
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
