<?php


class Users
{
    function __construct()
    {
        if (isset($_SESSION['user'])) {
            header('location:admin_login.php');
        }
        require '../config.php';
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
    }

    public function update_notice()
    {
        $post = $_POST;
        $title = $post['title'];
        $content = $post['content'];
        $t = date('y-m-d H:i:s');
        $sql = "update notice set title = '$post[title]',content = '$post[content]',update_time='$t' where id = 1";
        $result = $this->db->query($sql);
        if ($result) {
            $this->db->close();
            echo "<script>alert('Successful');location.href = '/admin_notice.php';</script>";
            exit();
        } else {
            echo $this->db->error;
            exit();
        }
    }


    public function del()
    {
        $id = $_POST['id'];

        $sql = "delete from users where id = $id";

        $this->db->query($sql);
        echo 1;
    }

    public function update()
    {
        $post = $_POST;

        $uid = $post['id'];
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (!preg_match($pattern, $post['email'])) {
            echo "<script>alert('Email format incorrect');history.go(-1);</script>";
            exit();
        }
        if (!empty($post['password'])) {
            if (trim($post['password']) == '' || strlen($post['password']) < 6 || strlen($post['password']) > 20) {
                echo "<script>alert('PassWord format incorrect');history.go(-1);</script>";
                exit();
            }
        }
        $sql = "update users set email = '$post[email]',gender = '$post[gender]' where id = $uid";
        if (!empty($post['password'])) {
            $pwd = md5(trim($post['password']));
            $sql = "update users set email = '$post[email]',gender = '$post[gender]',password = '$pwd' where id = $uid";
        }

        $result = $this->db->query($sql);
        if ($result) {
            $this->db->close();
            echo "<script>alert('Successful');location.href = '/admin_home.php';</script>";
            exit();
        } else {
            echo $this->db->error;
            exit();
        }


    }


}

$user = new Users();

switch ($_POST['type']) {
    case 'update':
        $user->update();
        break;
    case 'del':
        $user->del();
        break;
    case 'update_notice':
        $user->update_notice();
        break;
    default:
        echo "error";
        break;
}
