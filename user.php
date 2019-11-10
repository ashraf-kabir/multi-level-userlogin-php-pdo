<?php
session_start();
// checking user logged or not
if (empty($_SESSION['user'])) {
    header('location: index.php');
}
// restrict admin to access user.php page
if ($_SESSION['user']['role']=='admin') {
    header('location: admin.php');
} else {
?>
<h1>Welcome to <?php echo $_SESSION['user']['username'];?> Page</h1>

<link rel="stylesheet" href="style.css" type="text/css"/>
<div id="profile">
    <h2>username is: <?php echo $_SESSION['user']['username'];?> and Your Role is :<?php echo $_SESSION['user']['role'];?></h2>
<div id="logout"><a href="logout.php">Please Click To Logout</a></div>
</div>
<?php } ?>