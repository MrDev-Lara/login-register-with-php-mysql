<?php
	include "inc/header.php";
	include "lib/user.php";
	session::checklogin();
 ?>
 <div class="container">
	<div class="row">
		<div class="well well-lg"> 
			<h1 class="text-center">Registration Form</h1>
			
			<?php
				$user = new user();
				if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
					$name = $_POST['name'];
					$username = $_POST['username'];
					$email = $_POST['email'];
					$password =$_POST['password'];
					
					$user->setName($name);
					$user->setUsername($username);
					$user->setEmail($email);
					$user->setPassword($password);
					
					$result = $user->registersuccess();
				}
			?>
			
			<form action="" method="post">
			<div class="">
			
			<?php
				if (isset($result)){
					echo $result;
				}
			?>
				<div class="form-group">
					<label for="username">Name :</label>
					<input type="text" placeholder="Your Name" name="name" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password">Username :</label>
					<input type="text" placeholder="Your username" name="username" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password">E-mail :</label>
					<input type="mail" placeholder="Your email" name="email" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="password">Password :</label>
					<input type="password" placeholder="Your password" name="password" class="form-control"/>
				</div>
				<button class="btn btn-primary" name="register" type="submit">register</button>
			</div>
			</form>
			
			
		</div>
	</div>
 </div>
  <?php
	include "inc/footer.php";
?>