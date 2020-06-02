<?php
    include_once "session.php";
	include "database.php";
	class user{
		private $db;
		private $name;
		private $username;
		private $email;
		private $password;
		private $oldpass;
		private $newpass;
		
		public function __construct(){
			$this->db = new database();
		}
		
		public function setOldpass($oldpass){
			$this->oldpass = $oldpass;
		}
		
		public function setNewpass($newpass){
			$this->newpass = $newpass;
		}
		
		public function setName($name){
			$this->name = $name;
		}
		public function setUsername($username){
			$this->username = $username;
		}
		public function setEmail($email){
			$this->email = $email;
		}
		public function setPassword($password){
			$this->password = $password;
		}
		
		public function emailalreadytaken(){
			$sql ="select email from table_lr where email= :email";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':email',$this->email);
			$stmt->execute();
			if($stmt->rowCount() >0){
				return true;
			}else{
				return false;
			}
		}
		
		private function insertdata(){
			$sql = "insert into table_lr(name,username,email,password) values(:name, :username, :email, :password)";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':name',$this->name);
			$stmt->bindParam(':username',$this->username);
			$stmt->bindParam(':email',$this->email);
			$stmt->bindParam(':password',$this->password);
			$result = $stmt->execute();
			if($result){
				$nameerr = "<div class='alert alert-success'><strong>Thank You!</strong>You have been registered</div>";
				return $nameerr;
			}else{
				$nameerr = "<div class='alert alert-danger'>Sorry,you have not been registered.Please try again!</div>";
				return $nameerr;
			}
		}
		
		public function registersuccess(){
			if(empty($this->name)){
				$nameerr = "<span class='alert alert-danger'>Name is Required</span>";
				return $nameerr;
			}
			
			if (!preg_match("/^[a-zA-Z ]*$/",$this->name)) {
				$nameerr = "<span class='alert alert-danger'>Only letters and white space allowed</span>";
				return $nameerr;
			}
			
			if(empty($this->username)){
				$nameerr = "<span class='alert alert-danger'>Username is Required</span>";
				return $nameerr;
			}
			
			if (!preg_match("/^[a-zA-Z ]*$/",$this->username)) {
				$nameerr = "<span class='alert alert-danger'>Only letters and white space allowed</span>";
				return $nameerr;
			}
			
			if(empty($this->email)){
				$nameerr = "<span class='alert alert-danger'>Email is Required</span>";
				return $nameerr;
			}
			if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
				$nameerr = "<span class='alert alert-danger'>Invalid email format</span>";
				return $nameerr;
			}
		
			$emailtaken = $this->emailalreadytaken();
			if($emailtaken == true){
				$nameerr = "<span class='alert alert-danger'>Email already exist</span>";
				return $nameerr;
			}
		
			if(empty($this->password)){
				$nameerr = "<span class='alert alert-danger'>Password is Required</span>";
				return $nameerr;
			}
			if(strlen($this->password)<6){
				$nameerr = "<span class='alert alert-danger'>Password should me more than 6 word</span>";
				return $nameerr;
			}
			
			echo $this->insertdata();
			
			
		}
		
		public function loginvalidate(){
			$sql = "select * from table_lr where username = :username and password = :password";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':username',$this->username);
			$stmt->bindParam(':password',$this->password);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		
		public function loginsuccess(){
			if(empty($this->username)){
				$nameerr = "<span class='alert alert-danger'>Username cannot be empty</span>";
				return $nameerr;
			}
			if(empty($this->password)){
				$nameerr = "<span class='alert alert-danger'>Password cannot be empty</span>";
				return $nameerr;
			}
			$result = $this->loginvalidate();
			if($result){
				session::init();
				session::set("login", true);
				session::set("id", $result->id);
				session::set("name", $result->name);
				session::set("username", $result->username);
				session::set("email", $result->email);
				session::set("loginmsg", "<span class='alert alert-success'><strong>Success!</strong> Yoy are logged in.</span>");
				header("Location: index.php");
			}else{
				$nameerr = "<span class='alert alert-danger'>Username and password is not matched.</span>";
				return $nameerr;
			}
			
		}
		
		public function showdatabyid($id){
			$sql ="select * from table_lr where id= :id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updatedata($id){
			if(empty($this->name)){
				$nameerr = "<span class='alert alert-danger'>Name is Required</span>";
				return $nameerr;
			}
			
			if (!preg_match("/^[a-zA-Z ]*$/",$this->name)) {
				$nameerr = "<span class='alert alert-danger'>Only letters and white space allowed</span>";
				return $nameerr;
			}
			
			if(empty($this->username)){
				$nameerr = "<span class='alert alert-danger'>Username is Required</span>";
				return $nameerr;
			}
			
			if (!preg_match("/^[a-zA-Z ]*$/",$this->username)) {
				$nameerr = "<span class='alert alert-danger'>Only letters and white space allowed</span>";
				return $nameerr;
			}
			
			if(empty($this->email)){
				$nameerr = "<span class='alert alert-danger'>Email is Required</span>";
				return $nameerr;
			}
			if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
				$nameerr = "<span class='alert alert-danger'>Invalid email format</span>";
				return $nameerr;
			}
	
			$sql = "update table_lr set name= :name, username= :username, email= :email where id= :id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':name',$this->name);
			$stmt->bindParam(':username',$this->username);
			$stmt->bindParam(':email',$this->email);
			$result = $stmt->execute();
			if($result){
				$nameerr = "<div class='alert alert-success'><strong>DATA UPDATED SUCCESSFULLY</div>";
				return $nameerr;
			}else{
				$nameerr = "<div class='alert alert-danger'>Sorry, data not updated.</div>";
				return $nameerr;
			}
		}
		private function validateoldpass(){
			$sql ="select password from table_lr where password= :password";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':password',$this->oldpass);
			$stmt->execute();
			if($stmt->rowCount() >0){
				return true;
			}else{
				return false;
			}
		}
		
		public function changepassword($id){
			if(empty($this->oldpass)){
				$nameerr = "<span class='alert alert-danger'>Your old password cannot be empty!</span>";
				return $nameerr;
			}
			if(empty($this->newpass)){
				$nameerr = "<span class='alert alert-danger'>Your new password cannot be empty!</span>";
				return $nameerr;
			}
			$pass = $this->validateoldpass();
			if($pass == false){
				$nameerr = "<span class='alert alert-danger'>Old password do not exist</span>";
				return $nameerr;
			}
			if(strlen($this->newpass)<6){
				$nameerr = "<span class='alert alert-danger'>Your new password should be more than six character!</span>";
				return $nameerr;
			}
			$sql = "update table_lr set password= :password where id= :id";
			$stmt = $this->db->PDO->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':password',$this->newpass);
			$result = $stmt->execute();
			if($result){
				$nameerr = "<div class='alert alert-success'><strong>PASSWORD UPDATED SUCCESSFULLY</div>";
				return $nameerr;
				header('location: index.php');
			}else{
				$nameerr = "<div class='alert alert-danger'>Sorry, PASSWORD not updated.</div>";
				return $nameerr;
			}
		}
	}
?>