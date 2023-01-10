<?php
session_start();
/**
* login
*/
class Login
{
	public $password;
	function __construct()
	{
		if (!isset($_POST['login'])) {
			echo "<script>alert('You access the page does not exist!');history.go(-1);</script>";
			exit();
		}
        require '../config.php';
		$this->username = $_POST['username'];
		$this->password = $_POST['password'];
        $this->db = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME) or die('数据库连接异常');

	}


	public function checkPwd()
	{
		//验证密码格式
		if (!trim($this->password) == '') {
			$strlen = strlen($this->password);
			if ($strlen < 6 || $strlen > 20) {
				echo "<script>alert('Password length of illegal.please try again!');history.go(-1);</script>";
				exit();
			}else{
				$this->password = md5($this->password);
			}
		}else{
			echo "<script>alert(' Password must write.please try again!');history.go(-1);</script>";
			exit();
		}
	}


	public function checkUser()
	{
		//数据库验证
		$sql = "SELECT username,id FROM admin_user WHERE username = '".$this->username."' and password = '".$this->password."'";
		$result = mysqli_fetch_assoc($this->db->query($sql));

		if (!$result) {
			echo "<script>alert('username or password is incorrect.please try again!');history.go(-1);</script>";
			exit();
		}else{
            $_SESSION['admin_user'] = $result;
			echo "<script>alert('Login Success!');location.href = '/admin_home.php'</script>";
			exit();
		}
	}

	public function doLogin()
	{

		$this->checkPwd();
		$this->checkUser();
	}
}

$login = new Login();
$login->doLogin();

