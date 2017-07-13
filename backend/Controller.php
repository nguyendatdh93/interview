<?php 
	/**
	 * Main code.
	 */
	require 'BlogAstract.php';
	require 'User.php';
	$blog = new BlogAstract();
	session_start();
	/**
	 * Client must login to add block.
	 */
	if(isset($_POST['title']) && $_POST['content']){
		if(isset($_SESSION["username"])){
			$blog->setTitle($_POST['title']);
			$blog->setContent($_POST['content']);
			$result = $blog->add_record();
		}
		header('Location:Controller.php');
	}else if(isset($_GET['id'])){
		$result = $blog->get_list(array('id'=>$_GET['id']));
		$row=mysqli_fetch_array($result,MYSQLI_NUM);
		echo json_encode($row);
		return;
	}else if(isset($_POST['username']) && isset($_POST['password'])){
		$user = new User();
		$user->setUsername($_POST['username']);
		$user->setPassword($_POST['password']);
		if($user->check_login()){
			$_SESSION["username"] = $_POST['username'];
		}
		header('Location:Controller.php');
	}else if(isset($_GET['showid'])){
		$blog->show_blog($_GET['showid']);
		header('Location:Controller.php');
	}
	else{
		$page = 1;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$totalPage = $blog->get_total_page(10);
		// echo $totalPage;die;
		$result = $blog->get_list(null,10,$page);
		include '../fontend.php';
	}
	
?>