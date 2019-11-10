<?php
session_start();
//Checking user logged or not
if (empty($_SESSION['user'])) {
    header('location: index.php');
}
//Restrict user to access Admin.php page
if ($_SESSION['user']['role']=='user') {
    header('location: user.php');
}
//Restrict moderator to access Admin.php page
if ($_SESSION['user']['role']=='moderator') {
    header('location: moderator.php');
}
?>
<h1>Welcome to <?php echo $_SESSION['user']['username'];?> Page</h1>

<link rel="stylesheet" href="style.css" type="text/css"/>
<div id="profile">
    <h2>User name is: <?php echo $_SESSION['user']['username'];?> and Your Role is :<?php echo $_SESSION['user']['role'];?></h2>
<div id="logout"><a href="logout.php">Please Click To Logout</a></div>
</div>