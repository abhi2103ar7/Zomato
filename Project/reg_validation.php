<?php

//connect to database
$connection=mysqli_connect("localhost","root","","zomato");

$name=$_POST['user_ka_name'];
$email=$_POST['user_ka_email'];
$password=$_POST['user_ka_password'];
$phone=$_POST['user_ka_number'];

$query1="SELECT * FROM `users` WHERE `email` LIKE '$email'";

$result=mysqli_query($connection,$query1);

$result=mysqli_fetch_assoc($result);

if(count($result)==5){
    header('Location:index.php?msg=3');//if same email is given then md
}else{
    $query="INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`) VALUES (NULL, '$name', '$email', '$password', '$phone')";

    if(mysqli_query($connection,$query)){
        header('Location:index.php?msg=4');
    }else{
        //echo "Some error occured!";
        header('Location:index.php?msg=2');//if some occur happen the msg=2 page will open
    }

}



?>
