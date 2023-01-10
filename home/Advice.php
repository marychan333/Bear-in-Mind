<?php


class Advice
{
    function __construct()
    {
        require '../config.php';
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
    }

    //新增主记录
    public function add()
    {
        $title = $_POST['title'];
        $color = $_POST['color'];
        $addtime = date('Y-m-d H:i:s');
        $uid = $_SESSION['user']['id'];
        if (empty($title)) {
            echo "<script>alert('Title must write');history.go(-1);</script>";
            exit();
        }
        $sql = "INSERT INTO todo (title, color, addtime,user_id) VALUES ('" . $title . "','" . $color . "','" . $addtime . "','" . $uid . "')";
        $result = $this->db->query($sql);
        if ($result) {
            $this->db->close();
            echo "<script>location.href = '/todo.php';</script>";
            exit();
        } else {
            echo $this->db->error;
            exit();
        }
    }

    //新增子纪录
    public function addDetail()
    {

        $content = $_POST['content'];
        $dotime = $_POST['dotime'];
        $uid = $_SESSION['user']['id'];
        if (empty($dotime)) {
            echo "<script>alert('dotime must select');history.go(-1);</script>";
            exit();
        }
        $dotime = date('Y-m-d H:i', strtotime($dotime));//转换时间
        $id = $_POST['id'];
        $addtime = date('Y-m-d H:i:s');
        if (empty($id)) {
            echo "<script>alert('selelct record add');history.go(-1);</script>";
            exit();
        }

        if (empty($content)) {
            echo "<script>alert('content must write');history.go(-1);</script>";
            exit();
        }

        $sql = "INSERT INTO todo_detail (todo_id, content, addtime,dotime,user_id) VALUES ('" . $id . "','" . $content . "','" . $addtime . "','" . $dotime . "','" . $uid . "')";

        $result = $this->db->query($sql);
        if ($result) {
            $this->db->close();
            echo "<script>location.href = '../todo.php';</script>";
            exit();
        } else {
            echo $this->db->error;
            exit();
        }
    }

    //删除子纪录
    public function delDetail()
    {
        $id = $_POST['id'];
        $uid = $_SESSION['user']['id'];
        $sql = "select * from todo_detail where id = $id and user_id = $uid";

        $r = mysqli_fetch_assoc($this->db->query($sql));

        if (empty($r)) {
            echo 0;
        } else {
            $sql = "delete from todo_detail where id = $id";
            $this->db->query($sql);
            echo 1;
        }
    }

    //删除主记录
    public function del()
    {
        $id = $_POST['id'];
        $uid = $_SESSION['user']['id'];
        $sql = "select * from todo where id = $id and user_id = $uid";

        $r = mysqli_fetch_assoc($this->db->query($sql));

        if (empty($r)) {
            echo 0;
        } else {
            $sql = "delete from todo where id = $id";
            $this->db->query($sql);
//            $sql = "delete from todo_detail where todo_id = $id";
//            $this->db->query($sql);
            echo 1;
        }
    }
}


$reg = new Advice();

switch ($_POST['type']) {
    case 'add':
        $reg->add();
        break;
    case 'detail':
        $reg->addDetail();
        break;
    case 'del':
        $reg->del();
        break;
    case 'delDetail':
        $reg->delDetail();
        break;
    default:
        echo "error";
        break;
}