<?php

session_start();
//echo $_SESSION['name'];
$id=$_GET['id'];
$uskaname=$_SESSION['name'];
if(empty($_SESSION)){
    header('Location:index.php');
}
else{
    $id=$_GET['id'];
    include "includes/dbhelper.php";

    $query1="SELECT * FROM `restaurant` WHERE `r_id` LIKE '$id'";

    $result=mysqli_query($connection,$query1);

    $result=mysqli_fetch_assoc($result);
}
if(isset($_POST['add'])){
    //print_r($_POST['menu_id']);
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'], "menu_id");
            if(in_array($_POST['menu_id'], $item_array_id)){
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo '<script>window.location = "menu.php?id='.$id.'"</script>';
            }else{
                    $count = count($_SESSION['cart']);
                    $item_array = array(
                    'menu_id' => $_POST['menu_id']
                    );
                    $_SESSION['cart'][$count] = $item_array;
                    $menuid=$_POST['menu_id'];
                    $query3="SELECT * FROM `menu` WHERE `menu_id` LIKE '$menuid'";
                    $result3=mysqli_query($connection,$query3);
                    $result3=mysqli_fetch_assoc($result3);
                    if(count($result)==5){
                        $name=$result3['menu_name'];
                        $price=$result3['menu_price'];
                        $rest=$result3['r_id'];
                        
                        $query4="INSERT INTO `order_detail` (`cart_id`, `user_name`, `r_id`, `menu_name`, `menu_price`) VALUES (NULL, '$uskaname', '$rest', '$name', '$price')";
                    
                    if(mysqli_query($connection,$query4)){
                        header('Location:menu.php?id='.$result3['r_id'].'');
                    }else{
                        echo "Some error occured!";
                        
                    }
                }
                
            }
            
    }else{
            
            $item_array = array(
                'menu_id' => $_POST['menu_id']
        );
        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        
           
    }
}
?>

<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--Bootstrap CDNs-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>



<body style="background-color: #f2f2f2">
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
    <div class="row">
        <div class="col-12">
            <img src="image/<?php echo $result['r_bg']; ?>" style="width: 100%;height: 300px;margin-top: 50px">
            <h1 class="text-light" style="z-index: 10000;margin-top: -100px"><?php echo $result['r_name']; ?></h1>
        </div>

        <div class="col-12">
            <div class="row mt-100">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <?php
                                $query2="SELECT * FROM `menu` WHERE `r_id` LIKE '$id'";

                                $result2=mysqli_query($connection,$query2);
                                $counter=0;
                                while($row=mysqli_fetch_array($result2)){
                                    $counter++;
                                    echo '<div class="col-12">
                                     <form action="menu.php?id='.$result['r_id'].'" method="post">
                                              <div class="row mt-20">
                                                  <div class="col-2 text-center">';
                                    if($row['menu_type']=="Veg"){
                                        echo '<i class="fa fa-minus-circle fa-2x text-success"></i>';

                                    }else{
                                        echo '<i class="fa fa-minus-circle fa-2x text-danger"></i>';

                                    }
                                                  echo '</div>
                                                 
                                                  <div class="col-7">
                                                       <h5><b id="item'.$counter.'">'.$row['menu_name'].'</b></h5>
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
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div id="cart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>