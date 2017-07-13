<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>This is test example</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.btn-addblog{
			margin-top: 10px;
			float: right;
		}
	</style>
</head>
<body>
	<div class="container">
		<button type="button" class="btn btn-info btn-addblog" data-toggle="modal" data-target="#myModal">Add Blog</button>
		<div class="row">
			<h1>List Blog</h1>
		    <div class="col-md-1"></div>
			<div class="col-md-10">
				<?php 
            		while($row = mysqli_fetch_assoc($result)) {
				        echo '<div class="postlist">
								<div class="panel">
					                <div class="panel-heading">
					                    <div class="text-center">
					                        <div class="row">
					                            <div class="col-sm-9">
					                                <h3 class="pull-left">'.$row["title"].'</h3>
					                            </div>
					                            <div class="col-sm-3">
					                                <h4 class="pull-right">
					                                '.date("Y-m-d H:i:s",$row["time_created"]).'</small>
					                                </h4>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					                
					            <div class="panel-body">
					                <a class="btn-readmore" data-id="'.$row["id"].'" data-timecreated="'.date("Y-m-d H:i:s",$row["time_created"]).'" data-title="'.$row["title"].'" data-content="'.$row["content"].'" href="#" data-toggle="modal" data-target="#myModalDetail" style="float: right;">Read more</a>
					            </div>
					        </div>';
				    }
            	?>
		    </div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Create Blog</h4>
		        </div>
		        <div class="modal-body">
		          	<form method="post" action="Controller.php">
						<div class="form-group">
						    <label for="email">Title</label>
						    <input type="text" class="form-control" id="title" name='title'>
						</div>
						<div class="form-group">
						    <label for="pwd">Content</label>
						    <textarea class="form-control" rows="5" id="content" name='content'></textarea>
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
	     	</div>
	    </div>
	</div>

	<div class="modal fade" id="myModalDetail" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Blog</h4>
		        </div>
		        <div class="modal-body">
		          	<div class="postlist">
						<div class="panel">
			                <div class="panel-heading">
			                    <div class="text-center">
			                        <div class="row">
			                            <div class="col-sm-9">
			                                <h3 class="pull-left title-modal"></h3>
			                            </div>
			                            <div class="col-sm-3">
			                                <h4 class="pull-right">
			                                <small class='timecreated-modal'></small>
			                                </h4>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                
			            <div class="panel-body">
			                <p class="content-modal"></p>
			            </div>
			        </div>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
	     	</div>
	    </div>
	</div>
	<script>
		jQuery(document).ready(function($) {
			$('.btn-readmore').click(function(event) {
				var id = $(this).attr('data-id');
				$.ajax({
                    url : "Controller.php",
                    type : "GET",
                    data : {id:id},
                    success : function (result){
                        var data = JSON.parse(result);
                        $('.title-modal').html(data[1]);
                        $('.timecreated-modal').html(data[3]);
                        $('.content-modal').html(data[2]);
                    }
                });
			});
		});
	</script>
</body>
</html>