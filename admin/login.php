<?php
session_start(); require "../config/koneksi.php";
if(isset($_SESSION['admin'])) header("Location:index.php");
$error="";
if($_SERVER['REQUEST_METHOD']==='POST'){
 $username=$_POST['username']; $password=$_POST['password'];
 $stmt=$koneksi->prepare("SELECT * FROM admin WHERE username=? LIMIT 1"); $stmt->bind_param("s",$username); $stmt->execute(); $r=$stmt->get_result()->fetch_assoc();
 if($r && password_verify($password,$r['password'])){$_SESSION['admin']=$r['username'];header("Location:index.php");exit;}
 $error="Username atau password salah.";
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login Admin</title><link rel="stylesheet" href="../assets/css/style.css"><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet"></head><body class="login"><div class="login-box"><div class="logo" style="text-align:center;margin-bottom:25px"><span>L</span> Luna Beauty</div><h1>Admin Login</h1><?php if($error): ?><div class="alert error"><?= $error ?></div><?php endif; ?><form method="post"><div class="form-group"><label>Username</label><input name="username" required></div><div class="form-group"><label>Password</label><input type="password" name="password" required></div><button class="btn" style="width:100%" type="submit">Masuk</button></form><p style="text-align:center;margin-top:18px"><a href="../index.php">← Kembali ke website</a></p></div></body></html>