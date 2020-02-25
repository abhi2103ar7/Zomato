<?php



/*echo "Email is ".$email."<br>";
echo "Password is ".$password."<br>";

if($email=="admin@gmail.com" && $password=="1234"){
    //echo "Login Successful";
    header('Location:Basics.php');
}else{
    //echo "Login failed";
    header('Location:index.php');//used to link or send to php file mention in location
}*/
 session_start();
//connect to our database
$connection=mysqli_connect("localhost","root","","zomato");
$email=$_POST['user_ka_email']; //to post the data to this variable syntax and if u want to get it then $email=$_GET
$password=$_POST['user_ka_password'];
$query="SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
$result=mysqli_query($connection,$query);
$result=mysqli_fetch_assoc($result);

//print_r($result);
if (count($result)==5){
    $x=$result['user_id'];
    $_SESSION['name']=$result['name'];
    header('Location:home.php');
}else{
    header('Location:index.php?msg=1');
}
?>