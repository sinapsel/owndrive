<?php
	session_start();
	
	function forbid(){
		header("Location: err/403.html");
		exit;
	}
	function notfnd(){
		header("Location: err/404.html");
		exit;
	}
	function noperms(){
		echo "No permisions to view this folder or file";
		exit;
	}
	
	if(!isset($_SESSION['logedin_user'])){
		require "app/login.html";
		exit;
	}else{
		$rList = array();
		$ut = $_SESSION['logedin_user'];
		if($ut == "ADMIN")
			$rList[] = "app/headerroot.html";
		else if($ut == "GUEST")
			$rList[] = "app/headerguest.html";
		$url = explode('?', $_SERVER['REQUEST_URI']);
		$url = $url[0];
		switch($url){
			case "/":
				break;
			case "/files":
				if($ut == "ADMROOTOK")
					$rList[] = "app/filemanager.php";
				if($ut == "GUEST")
					$rList[] = "app/fileviewer.php";
				break;
			case "/fileview":
				$rList[] = "app/fileviewer.php";
				break;
			case "/contacts":
				if($ut == "ADMROOTOK")
					$rList[] = "app/contacts.php";
				if($ut == "GUEST")
					forbid();
				break;
		}
					
		$rList = array_unique($rList);
		foreach($rList as $r) if(file_exists($r)) require $r; else notfnd();
	}

?>
