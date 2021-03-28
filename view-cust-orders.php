<?php
    session_start();

    if(!isset($_SESSION['customer_name'])){
        echo "You are logged out";
        header("location:customer-login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view-orders.css" />
    <link rel="stylesheet" href="css/utils.css" />
    <title> Home</title>
</head>
<body>
    <?php include("logo.html") ?>

    <!-- Database connection -->
    <?php include("config/db-connect.php") ?>


    <section class="container">
        
        <div class="box2">
            <!-- <h2>Hey, <?php echo $_SESSION['customer_name']; ?></h2> -->
            <h2>Hey, <a href = "customer.php" class="user-name"><?php echo $_SESSION['customer_name']; ?></a></h2>
            <h2>Orders</h2>
            <div class="logout"><a href="customer-logout.php">Logout</a></div>
        </div>
             <!-- Query data from database  -->
        <?php
            $customer_id = $_SESSION['customer_id'];
            $query_food = "SELECT order_id, customer_id, item_name, quantity, total_price, restaurant_name FROM order_details WHERE customer_id = '$customer_id'";
            $result_food = mysqli_query($conn, $query_food);
            $result_food_count = mysqli_num_rows($result_food);
            
            if($result_food_count > 0){
                while($row = mysqli_fetch_assoc($result_food)){

                    echo '
                    <div class="table">

                        <table>
                            <tr>
                                <td>'.$row["item_name"].'</td>
                                <td>'.$row["restaurant_name"].'</td>
                                <td>'.$row["quantity"].'</td>
                                <td>&#x20B9;'.$row["total_price"].'</td>
                            </tr>
                        </table>
                    </div>';
                    // echo $row["customer_name"]; 
                }
            }
        ?>
           
    </section>
    <?php include("footer.html") ?>
</body>
</html>