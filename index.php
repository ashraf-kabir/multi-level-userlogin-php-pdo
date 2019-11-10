<?php
session_start();
include('config.php');
//$conn=mysqli_connect('localhost','root','','codenair');
//Getting Input value
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    if (empty($username) && empty($password)) {
        $error= 'Fields are Mandatory';
    } else {
        //Checking login detail
        //$result = mysqli_query($con,"SELECT * FROM `user` WHERE `username`='$username' AND `password`='$passwordmd5'");
        $sql = "SELECT * FROM `user` WHERE `username`=:username AND `password`=:password";
        $query = $dbh->prepare($sql);

        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        $query->execute();
        $results = $query->fetch(PDO::FETCH_ASSOC);
        //$row = 

        //$row = mysqli_fetch_assoc($result);
        //$count = mysqli_num_rows($result);

        if ($query->rowCount()>0) {
            $_SESSION['user']=array(
                'username'=>$results['username'],
                'password'=>$results['password'],
                'role'=>$results['role']
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