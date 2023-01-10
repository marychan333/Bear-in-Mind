<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:home.php');
}


//获取公告栏数据
require './config.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "SELECT * FROM notice WHERE id = 1";
$notice = mysqli_fetch_assoc($db->query($sql));

//定义颜色数组
$colorArr = [
    '#337ab7',
    '#5cb85c',
    '#5bc0de',
    '#f0ad4e',
    '#d9534f',
    '#000000',
    '#FFB6C1',
    '#4169E1',
    '#B22222',
    '#DA70D6',
    '#F5DEB3',
    '#FF6347'
];

//获取todo列表
$uid = $_SESSION['user']['id'];

$sql = "SELECT * FROM todo  where user_id = $uid";
$list = [];
$result = mysqli_query($db, $sql);
while ($info = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $list[] = $info;
}


//拼接详情
foreach ($list as $k => $v) {
    $list[$k]['detail'] = [];
    $sql2 = "SELECT * FROM todo_detail  where todo_id = $v[id]";
    $list2 = [];
    $result2 = mysqli_query($db, $sql2);
    while ($info2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $list[$k]['detail'][] = $info2;
    }
}


?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- 网页头部 -->
<?php require_once 'public/layouts/header.php' ?>
<link href="public/css/index.css" rel="stylesheet">
<body>
<!-- 网页内容区域 -->
<div class="container">
    <div class="adds" data-toggle="modal" data-target="#todo">
        +Todo
    </div>

    <div class="row" style="margin-top: 50px;">
        <div class="col-md-4">
            <div class="jumbotron">
                <div class="alert alert-warning text-left">
                    <h2 class="text-center"><?php echo $notice['title']; ?></h2>
                    <p><?php echo $notice['content']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <?php
                foreach ($list as $v) {
                    echo '<div class="col-sm-6 col-md-4">';
                    echo '<div class="thumbnail">';
                    echo '<div class="panel " style="border-bottom:none;border-color:#ffffff;">';
                    echo "<div class='panel-body text-center' style='background-color:$v[color] ;color: white;'>";
                    echo $v['title'];
                    echo '</div >';
                    foreach ($v['detail'] as $v2) {
                        echo "<div class='panel-footer' ><div>$v2[content]</div><div>$v2[dotime] <span onclick='delDetail($v2[id])' class='btn btn-danger btn-xs'>delete</span></div> </div >";
                    }
                    echo '<div class="caption" >';
                    echo "<p onclick='btnOpenDetail($v[id])'  class='btn btn-xs' style='background-color:$v[color];color: white;'> Add</p ><p style='margin-left: 50px;'  onclick='del($v[id])'  class='btn btn-warning btn-xs'>Del</p >";


                    echo '</div >';
                    echo '</div >';
                    echo '</div >';
                    echo ' </div>';
                }
                ?>

                <!--                    <div class="thumbnail">-->
                <!--                        <div class="panel " style="border-bottom:none;border-color:#ffffff;">-->
                <!--                            <div class="panel-body text-center" style="background-color: #337ab7;color: white;">-->
                <!--                                Panel content-->
                <!--                            </div>-->
                <!--                            <div class="panel-footer">Panel footer</div>-->
                <!--                            <div class="panel-footer">Panel footer</div>-->
                <!--                            <div class="caption">-->
                <!--                                <p><a href="#" class="btn btn-primary" role="button">Add</a></p>-->
                <!--                            </div>-->
                <!---->
                <!--                        </div>-->
                <!---->
                <!--                    </div>-->


            </div>
        </div>

    </div>
</div>
<!-- 网页内容区域 -->

<!--add TO DO-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="todo"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Todo</h4>
            </div>
            <form action="home/Advice.php" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="hidden" name="type" value="add">
                        <label class="col-sm-4 control-label">title:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">color:</label>
                        <div class="col-sm-6">
                            <?php
                            foreach ($colorArr as $v) {
                                echo <<<EOF
                                    <label class="radio-inline" style="margin-left:0;margin-right: 20px;">
                                    <div>
                                    <input checked type='radio' name='color' value=$v />
                                    <div style = 'background-color: $v;;width: 50px;height: 20px;' ></div >
                                    </div>
                                    </label >
EOF;
                            }
                            ?>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">
                            Close
                        </button>
                        <input type="reset" class="btn btn-warning" value="reset"/>
                        <button type="submit" class="btn btn-primary" name="toto">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--add TO DO-->


<!--add TO DO detial-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="todo2"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">add something</h4>
            </div>
            <form action="home/Advice.php" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="type" value="detail">
                        <input type="hidden" name="id" id="detailId" value="">
                        <label class="col-sm-4 control-label">content:</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">time:</label>
                        <div class="col-sm-6">
                            <input type="datetime-local" class="form-control" name="dotime">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">
                            Close
                        </button>
                        <input type="reset" class="btn btn-warning" value="reset"/>
                        <button type="submit" class="btn btn-primary" name="toto2">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--add TO DO detail-->
<script src="public/js/register.js"></script>
</body>
</html>

<script>

    function btnOpenDetail(id) {
        $('#detailId').val(id)//点击哪个的值就赋值过去
        $('#todo2').modal('show');

    }

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

    function del(id) {
        var r = confirm("Are you sure to delete");
        if (r == true) {
            $.post('home/Advice.php', {id: id, type: 'del'}, function (data, textStatus, xhr) {
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