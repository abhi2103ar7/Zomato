<?php

session_start();
//echo $_SESSION['name'];
include "includes/dbhelper.php";

if(empty($_SESSION)){
    header('Location:index.php');
}
if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["menu_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}

?>
<html>

<head>
    <title>Cart</title>
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
    $(document).ready(function(){
        $('.mybtn').click(function(){
            alert('Items Will be delivered in few Minutes ...!');
            window.location = "home.php";
        });
    })
</script>
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

    

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart mt-50">
                <h6>My Cart</h6>
                <hr>

                <?php
                $total = 0;
                    if (isset($_SESSION['cart'])){
                        $menu_id = array_column($_SESSION['cart'], 'menu_id');
                        $query="SELECT * FROM `menu`";

                                $result=mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($menu_id as $id){
                                if ($row['menu_id'] == $id){
                                    echo '<form action="cart.php?action=remove&id='.$row['menu_id'].'" method="post" class="cart-items">
                    <div class="border rounded">
                        <div class="row bg-white">
                            <div class="col-md-6">
                                <h5 class="pt-2">'.$row['menu_name'].'</h5>
                                <h5 class="pt-2">Rs.'.$row['menu_price'].'</h5>
                                <button type="submit" class="btn btn-warning">Save for Later</button>
                                <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                            </div>
                            <div class="col-md-3 py-5">
                                <div>
                                    <button type="button" class="btn bg-light border rounded-circle"><i class="fa fa-minus"></i></button>
                                    <input type="text" value="1" class="form-control w-25 d-inline">
                                    <button type="button" class="btn bg-light border rounded-circle"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
                    $total = $total + (int)$row['menu_price'];
                                }
                            }
                        }
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }
                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>Rs.<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>Rs.<?php
                            echo $total;
                            ?></h6>
                        
                    </div>
                    <div class="mt-50">
                    <button class=" mybtn btn btn-success btn-lg">Checkout</button>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
    </div>
    </body>
</html>