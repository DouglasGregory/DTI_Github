<?php

if(isset($_REQUEST['login'])) {

// get username from form
$username = clean_input($dbconnect, $_REQUEST['username']);
$options = ['cost' => 9,];

// Get username and hashed password from database
$login_sql="SELECT * FROM `Users` WHERE `username` = '$username'";
$login_query=mysqli_query($dbconnect,$login_sql);
$login_rs = mysqli_fetch_assoc($login_query);

// hash password and compare with password in database
if (password_verify($_REQUEST['password'], $login_rs['password'])) {

// password matches
echo 'password is valid';
$_SESSION['admin'] = $login_rs['username'];
header("Location: index.php?page=all_results&search=all");

}   // end valid password if

else {

echo 'invalid password';
unset($_SESSION);
$login_error = "Wrong login. Please try again.";
header("Location: index.php?page=../admin/login&error=$login_error");


} // end invalid password else

} // end of login button has been pushed

?>