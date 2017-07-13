<?php 
	/**
	 * Main code.
	 */
	include 'BlogAstract.php';
	$blog = new BlogAstract();
	if(isset($_POST['title']) && $_POST['content']){
		$blog->setTitle($_POST['title']);
		$blog->setContent($_POST['content']);
		$result = $blog->add_record();
		header('Location:Controller.php');
	}else if(isset($_GET['id'])){
		$result = $blog->get_one_data($_GET['id']);
		$row=mysqli_fetch_array($result,MYSQLI_NUM);
		echo json_encode($row);
		return;
	}
	else{
		$result = $blog->get_data(10);

		include '../fontend.php';
	}
	
?>