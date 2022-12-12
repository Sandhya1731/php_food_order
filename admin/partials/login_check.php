<?php 
// check whether user is login or not
//authorization access control
if(!isset($_SESSION['user']))// if user session is not set 
{
// user is not logged in
//redirect to login page with message
$_SESSION['no login message']="Please login to access admin panel ";
header('location:'.SITEURL.'admin/login.php');
}
?>