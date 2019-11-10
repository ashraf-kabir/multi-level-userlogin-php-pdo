<?php
session_start();
include('config.php');
//$conn=mysqli_connect('localhost','root','','codenair');
//Getting Input value
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $passwordmd5 = md5($password);
    
    if (empty($username) && empty($password)) {
        $error= 'Fields are Mandatory';
    } else {
        //Checking login detail
        $result = mysqli_query($con,"SELECT * FROM `user` WHERE `username`='$username' AND `password`='$passwordmd5'");
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);

        if ($count==1) {
            $_SESSION['user']=array(
                'username'=>$row['username'],
                'password'=>$row['password'],
                'role'=>$row['role']
            );
            $role=$_SESSION['user']['role'];
            //Redirecting user based on role
            switch ($role) {
                case 'user':
                header('location:user.php');
                break;
                case 'moderator':
                header('location:moderator.php');
                break;
                case 'admin':
                header('location:admin.php');
                break;
            }
        } else {
            $error='Your PassWord or UserName is not Found';
        }
        
    }
}
?>
<html>
<head>
<title>PHP MySQL Role Based Access Control</title>
</head>
<div align="center">
    <h3>PHP MySQL Role Based Access Control</h3>
    <form method="POST" action="">
        <table>
            <tr>
                <td>UserName:</td>
                <td><input type="text" name="username"/></td>
            </tr>
            <tr>
                <td>PassWord:</td>
                <td><input type="password" name="password"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login"/></td>
            </tr>
        </table>
    </form>
    <?php if(isset($error)){ echo $error; }?>
</div>
</html>