<?php
	include "inc/header.php";
	include "lib/user.php";
	session::checklogin();
 ?>
 <div class="container">
	<div class="row">
		<div class="well well-lg"> 
			<h1 class="text-center">Login Form</h1>
			
			<?php
				$user = new user();
				if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
					$username = $_POST['username'];
					$password =$_POST['password'];
					
					$user->setUsername($username);
					$user->setPassword($password);
					
					$result = $user->loginsuccess();
				}
			?>
			<?php
				if (isset($result)){
					echo $result;
				}
			?>
	
			<form action="" method="post">
			<div class="">
				<div class="form-group">
					<label for="username">Username :</label>
					<input type="text" placeholder="Your Name" name="username" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password">Password :</label>
					<input type="password" placeholder="Your Password" name="password" class="form-control"/>
				</div>
				<button class="btn btn-primary" name="login" type="submit">Login</button>
			</div>
			</form>
		</div>
	</div>
 </div>
 <?php
	include "inc/footer.php";
?>