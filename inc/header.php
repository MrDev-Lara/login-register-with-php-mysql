<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/session.php';
	session::init();
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Login-Register system with php by Moni Uddin</title>
	<link rel="stylesheet" href="inc/bootstrap.min.css" />
	<script type="text/javascript" src="inc/jquery.min.js"></script>
	<script type="text/javascript" src="inc/bootstrap.min.js"></script>
	<link rel="stylesheet" href="inc/style.css" />
</head>

<?php 
	if(isset($_GET['action']) && $_GET['action'] == 'logout'){
		session::destroy();
	}
?>

<body>
	<div class="container-fluid">
		<div class="row">
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<button class="btn btn-default navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse">
					<h4 class="navbar-left head">Login-Register System by Moni Uddin </h4>
					<ul class="nav navbar-nav navbar-right">
						
						
						<?php
							$id = session::get('id');
							$userlogin = session::get('login');
								if($userlogin == true){
						?>
									<li><a href="?action=logout">Logout</a></li>
									<li><a href="<?php echo "profile.php?id=".$id; ?>">Profile</a></li>
								<?php } else{ ?>
									<li><a href="<?php echo "login.php"; ?>">Login</a></li>
									<li><a href="<?php echo "register.php"; ?>">Register</a></li>
								<?php } ?>
						
						
						
					</ul>
				</div>
			</nav>
		</div>
	</div>