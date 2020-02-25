<?php
session_start();
if(empty($_SESSION)){
    header('Location:index.php');
}
?>
<html>

<head>
    <title>Zomato Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--Bootstrap CDNs-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>

<nav class="navbar navbar-dark bg-nav">
    <div class="row">
        <div class="col-4">
            <img src="https://www.flaticon.com/premium-icon/icons/svg/1820/1820305.svg" style="width: 150px;height: 150px">
        </div>
        <div class="col-md-8 padding-30">
            <h1 style="text-align: center;margin-top: 50px"><b>Zomato</b></h1>

        </div>
    </div>
    <div class="float-right" style="margin-top: 100px">
        <p class="text-light" >
            <a href="cart.php" class="btn btn-lg">
                    <h5 class="px-5 cart">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <?php
                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                        }
                        ?>
                    </h5>
                </a>
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa fa-fw fa-user"></i>
            </button>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="home.php">Home</a>
                <a href="logout.php">Logout</a>
            </div>
            <b><?php echo $_SESSION['name'] ; ?></b>
        </div>


        </p>
    </div>

    </nav>
    

<div class="container">
    <div class="row mt-50">
        <div class="col-12">
            <div class="row">
                <div class="col-3">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <h1 class="text-light">Discount 1</h1>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <h1 class="text-light">Discount 2</h1>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-info">
                        <div class="card-body">
                            <h1 class="text-light">Discount 3</h1>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-success">
                        <div class="card-body">
                            <h1 class="text-light">Discount 4</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row mt-50">
                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        $connection=mysqli_connect("localhost","root","","zomato");
                                        $query="SELECT * FROM `restaurant`";
                                        $result=mysqli_query($connection,$query);

                                        while ($row=mysqli_fetch_array($result)){
                                            echo '<div class="col-4 mt-20">
                                            <div class="card">
                                                <img src="image/'.$row['r_bg'].'" class="card-img-top" style="width: 100%;height: 100px;">
                                                <div class="card-body">
                                                    <h4 class="card-title">'.$row['r_name'].'</h4>
                                                    <p class="card-text text-grey">
                                                         '.$row['r_cusine'].'
                                                    </p>
                                                    <h4 >Rating :'.$row['r_rating'].'</h4>
                                                    <a href="menu.php?id='.$row['r_id'].'" class="btn btn-block bg-nav">View Menu</a>
                                                </div>
                                            </div>
                                        </div>';
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card bg-nav">
                        <div class="card-body">
                            <h1 class="text-light">Stupid Ads</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>


</html>