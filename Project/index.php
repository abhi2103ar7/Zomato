<?php
session_start();
if(!empty($_SESSION)){
    header('Location:profile.php');
}
if(!empty($_GET)){
    $error=1;
    //echo $error;
}else{
    $error=0;
}
?>

<html>
<head>
    <title>Zomato Home</title>
    <!--Project CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--Bootstrap CDNs-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<script type="text/javascript">

    $(document).ready(function () {
        var error='<?php echo $error ?>';
        if(error==1){
            var errorCode='<?php echo $_GET['msg']?>';
            if(errorCode==1){
                $('#errorMsg').html('<p style="color:red">Incorrect Email/password</p>');
            }else if(errorCode==2){
                $('#regError').html('<p style="color:red">Some error ocuured. Try again</p>');
                $('#myModal').modal('show');
            }else if(errorCode==3){
                $('#regError').html('<p style="color:red">This is email already exist</p>');
                $('#myModal').modal('show');
            }else{
                $('#errorMsg').html('<p style="color:green">Registered Successfully</p>');
            }

        }
    })
</script>
<body class="bg-nav">
<nav class="navbar navbar-dark bg-nav">
    <div class="row">
        <div class="col-4">
            <img src="https://www.flaticon.com/premium-icon/icons/svg/1820/1820305.svg" style="width: 100%;height: 100%">
        </div>
        <div class="col-md-8 padding-30">
            <h1 style="text-align: center;margin-top: 50px"><b>Zomato</b></h1>
        </div>
    </div>
    <!--<h3>Never have a bad meal!!</h3>-->
</nav>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image/kfc.jpg" class="d-block mw-100" style="width: 100%">
                    </div>
                    <div class="carousel-item">
                        <img src="image/dominos.jpg" class="d-block w-100" style="width: 100%">
                    </div>
                    <div class="carousel-item">
                        <img src="image/coffee.jpg" class="d-block w-100" style="width: 100%">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-50">
        <div class="col-8">
            <h1 class="text-light display-4 text-center">Welcome to the delicious world of indian Cuisines</h1>
            <p class=" text-light text-center lead">The Offical Partner of Cricket World Cup 2019</p>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="text text-center">
                        <img src="https://www.flaticon.com/premium-icon/icons/svg/1144/1144709.svg" class="card-img-top rounded-left" style="width: 256px;height: 256px">
                    </div>

                    <form class="form" action="login_validator.php" method="post">
                        <div id="errorMsg"></div>
                        <label> Email</label><br>
                        <input type="email" class="form-control" name="user_ka_email"><br>
                        <label>Password</label><br>
                        <input type="password" class="form-control" name="user_ka_password"><br>
                        <input type="submit" value="Login" class="btn btn-block bg-nav">
                    </form>
                </div>
            </div>
            <p class="text-center text-light"><a href="#" data-toggle="modal" data-target="#myModal">Not a member? Sign Up</a></p>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register Here</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div id="regError"></div>
                <form class="form" action="reg_validation.php"  method="post">
                    <label>Name</label><br>
                    <input type="text" id="name" class="form-control" name="user_ka_name" required><br>

                    <label>Email</label><br>
                    <input type="email" id="email" class="form-control" name="user_ka_email" required><br>

                    <label>Password</label><br>
                    <input type="password" id="pass" class="form-control" name="user_ka_password" required><br>

                    <label>Contact Number</label><br>
                    <input type="number" id="phone" class="form-control" name="user_ka_number" required ><br><br>

                    <input type="submit" value="REGISTER" class="btn btn-primary btn-block">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
