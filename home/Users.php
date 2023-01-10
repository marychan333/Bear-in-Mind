<?php


class Users
{
    function __construct()
    {
        if (isset($_SESSION['user'])) {
            header('location:home.php');
        }
        require '../config.php';
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
    }

    public function update()
    {
        $post = $_POST;
        $uid = $_SESSION['user']['id'];
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (!preg_match($pattern, $post['email'])) {
            echo "<script>alert('Email format incorrect');history.go(-1);</script>";
            exit();
        }
        if(!empty($post['password'])){
            if (trim($post['password']) == '' || strlen($post['password']) < 6 || strlen($post['password']) > 20) {
                echo "<script>alert('PassWord format incorrect');history.go(-1);</script>";
                exit();
            }
        }
        $sql = "update users set email = '$post[email]',gender = '$post[gender]' where id = $uid";
        if(!empty($post['password'])){
            $pwd = md5(trim($post['password']));
            $sql = "update users set email = '$post[email]',gender = '$post[gender]',password = '$pwd' where id = $uid";
        }

        $result = $this->db->query($sql);
        if ($result) {
            $this->db->close();
            echo "<script>alert('Successful');location.href = '../myinfo.php';</script>";
            exit();
        }else{
            echo $this->db->error;
            exit();
        }




    }


}

$user = new Users();
switch ($_POST['type']) {
    case 'update':
        $user->update();//检查用户名字是否唯一
        break;
    default:
        echo "error";
        break;
}
