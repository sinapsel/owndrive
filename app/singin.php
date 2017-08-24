<?php
if(isset($_POST['submit'])){

	$err = array();
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "You can use only english letters and numbers in the login field";
exit("Error: You can use only english letters and numbers in the login field");

    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 25)
    {
        $err[] = "The length of the login must be from 3 to 25 symbols";
exit("Error: The length of the login must be from 3 to 25 symbols");

    }



	if(count($err) == 0){
		session_start();

		$root_login = array(
			'717650cfbb75ee7e328d411d9a216717' => '6f55d431c2a643fbc85d3f1b16f824a4'
		);
		$guest_login = array(
			md5("guest")=>md5("guest")
		);
		
		
		$login_root= md5("root_user1");
		$password_root= md5("root_user1");

		$login_guest = md5('guest');
		$password_guest = md5('guest');

		$login=$_POST['login'];
		$password=$_POST['password'];

		//if( ($login_root == md5($login)) and ($password_root == md5($password)) )
		if(isset($root_login[md5($login)])){
			if($root_login[md5($login)] == md5($password))
			{
				$_SESSION['logedin_user'] = 'ADMIN';
				header("Location: /");
			}
		}else if(isset($guest_login[md5($login)])){
			if($guest_login[md5($login)] == md5($password)){
				$_SESSION['logedin_user'] = 'GUEST';
				header("Location: /");
			}
		}else{
			exit("Error: Incorrect login or/and password");
		}
	}
}
?>
