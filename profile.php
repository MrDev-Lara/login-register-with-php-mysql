<?php
	include "inc/header.php";
	include "lib/user.php";
	session::checklogout();
	$user = new user();
	
	
 ?>
 
 <?php
			if(isset($_POST['update'])){
					$id = $_GET['id'];
					$name = $_POST['name'];
					$username = $_POST['username'];
					$email = $_POST['email'];
					
					$user->setName($name);
					$user->setUsername($username);
					$user->setEmail($email);
					
					$result = $user->updatedata($id);
					if(isset($result)){
						echo $result;
					}
					
	}
		?>
 <div class="container">
	<div class="row">
		
		<div class="well well-lg">
			<div class="col-sm-12">
				<h1 class="text-left col-sm-3 profile">User Profile</h1>
				<a href="<?php echo "index.php"; ?>" class="text-right btn btn-primary col-sm-offset-8 col-sm-1">BACK</a>
			</div>
			<?php
				$showdata = $user->showdatabyid($id);
				if($showdata){
			?>		
				
			
			<form action="" method="post">
				<div class="form-group">
					<label for="username">Your Name :</label>
					<input type="text" placeholder="Your Name" name="name" class="form-control" value="<?php echo $showdata->name;?>"/>
				</div>
				<div class="form-group">
					<label for="password">Username :</label>
					<input type="text" placeholder="Your username" name="username" class="form-control" value="<?php echo $showdata->username;?>"/>
				</div>
				<div class="form-group">
					<label for="password">E-mail :</label>
					<input type="mail" placeholder="Your email" name="email" class="form-control" value="<?php echo $showdata->email;?>"/>
				</div>
				<button class="btn btn-primary" name="update" type="submit">UPDATE</button>
				<a href="changepassword.php?id=<?php echo $id; ?>" class="btn btn-info">Change Password</a>
				
			</form>
			<?php } ?>
		</div>
	</div>
 </div>
  <?php
	include "inc/footer.php";
?>