<?php
session_start(); require_once "db.php"; $error="";
if($_SERVER['REQUEST_METHOD']==='POST'){
$name=trim($_POST['name']); $email=trim($_POST['email']); $pass=$_POST['password'];
if($name && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($pass)>=6){
$hash=password_hash($pass,PASSWORD_DEFAULT); $s=$conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)"); $s->bind_param("sss",$name,$email,$hash);
if($s->execute()){ $_SESSION['user_id']=$conn->insert_id; $_SESSION['user_name']=$name; header("Location: index.php"); exit; } $error="Email already registered.";
}else $error="Enter valid details. Password must be at least 6 characters.";
}
?><!doctype html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Register</title><link rel="stylesheet" href="css/style.css"></head><body><header class="navbar"><a class="logo" href="index.php">📚 Fakir Chand</a><nav><a href="index.php">Home</a><a href="books.php">Books</a><a href="login.php">Login</a></nav></header><main class="form-wrap"><div class="form-card"><p class="eyebrow">CREATE ACCOUNT</p><h1>Join our readers.</h1><?php if($error):?><div class="error"><?=htmlspecialchars($error)?></div><?php endif;?><form method="post"><label>Name<input name="name" required></label><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" minlength="6" required></label><button class="btn full">Create account</button></form><p>Already registered? <a href="login.php">Login</a></p></div></main></body></html>