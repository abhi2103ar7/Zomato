<?php
session_start();
if(empty($_SESSION)){
    header('Location:index.php');
}
?>
<html>
<head>
    <title>
        Profile Page
    </title>
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
<div class="container ">
    <div class="row mt-50">
        <div class="col-7">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body ">
                          <h2>All Orders</h2>
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                                
                                                $connection=mysqli_connect("localhost","root","","zomato");
                                                $query2="SELECT * FROM `order_detail`

                                                $result2=mysqli_query($connection,$query2);
                                                
                                        while($row=mysqli_fetch_array($result2)){
                                           
                                            echo '<div class="col-12">
                                                      <div class="row mt-20">
                                                          <div class="col-7">
                                                               <h5><b>'.$row['menu_name'].'</b></h5>
                                                               <p class="text-grey">Rs. '.$row['menu_price'].'</p>
                                                          </div>
                                                          <div class="col-3">
                                                              <button type="submit" class="btn btn-success btn-large" name="add">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                                                              <input type="hidden" name="menu_id" value="'.$row['menu_id'].'">
                                                          </div>
                                                      </div>
                                                      </form>
                                                  </div>';
                                        }

                                        ?>

                                    </div>
                        </div>>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="lead">Addresses</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="lead">Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>

