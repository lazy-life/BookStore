<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Gac Xep Book Store</title>
    <style>
        .delete {
            border: none;
            padding: 5px;
        }

        .delete:hover {
            background-color: red;
            border: 1px solid yellow;
            border-radius: 8px;
        }

        .cartLogo {
            position: relative;
        }

        .cartLogo p {
            position: absolute;
            top: -10px;
            right: 0;
            margin: 0;
        }

        .cartLogo img {
            position: relative;
        }
    </style>
</head>

<body>
    <div id="header">
        <div class="logo">
            <a href="index.php">
                <img src="IMG/logo.webp" width="200px" alt="">
            </a>
        </div>
        <div class="search">
            <form action="search.php" method="get">
                <input class="inputSearch" type="search" name="query" id="" placeholder="Search...">
                <input class="btnSearch" type="submit" value="Search">
            </form>
        </div>
        <div class="actionUser">
            <?php
            session_start();

            // session_start();
            if (!isset($_SESSION['username'])) {
                echo "
                <a href='login.php'>Log in</a>
                <p>|</p>
                <a href='signup.php'>Sign up</a>";
            }
            if (isset($_SESSION['username'])) {
                $us = $_SESSION['username'];
                echo "<a href='profile.php'>$us</a>
                <p>|</p>
                <form method='post'>
                    <button style='border: none; background-color: white;' name='logout' type='submit'><a>Log out</a></button>
                </form>
                ";
            }
            ?>
            <?php
            if (isset($_POST['logout'])) {
                // if (isset($_SESSION['username'])) {
                // session_start();

                // unset all session variables
                session_unset();

                // destroy the session
                session_destroy();
                echo "<script>window.open('index.php','_self')</script>";
                // }
            }
            ?>

            <a class="cartLogo" href="Cart.php">
                <div class="cartLogo">
                    <img src="IMG/cart.png" alt="" height="40px">
                    <?php
                    // session_start();
                    // Connect to the database
                    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');

                    if (isset($_SESSION['username'])) {
                        $usn = $_SESSION['username'];
                        // Query the database for the products
                        $sql = "SELECT * FROM cart WHERE UserID= (select UserID from user where UserName = '$usn')";
                        //Step 3: Execute query and save result to var $result
                        $result = mysqli_query($connect, $sql);
                        $total = mysqli_num_rows($result);
                        //display books to screen
                        //Step 3: Execute query and save result to var $result

                        //$resultCate = mysqli_query($connect, $sqlCate);
                        if ($total > 0) {
                            echo "<p style='color: white;background-color: red; border-radius: 40%;padding: 5px 5px;' aria-colcount='totalCart' class='total'>$total</p>";
                        }

                        // Print the product details and category name in the same loop
                    } else {
                        echo "<p aria-colcount='totalCart' class='total'></p>";
                    }


                    ?>


                </div>






            </a>
        </div>
    </div>
    <div class="imgTitle">
        <img src="IMG/bg_breadcrumb.jpg" alt="">
        <h2>All Books</h2>
    </div>

    <div style="margin-bottom: 50px;" id="content">

        <div style="width: 90%;" class="right">
            <p style="margin-bottom: 30px;" class="titleContent">Your Cart</p>
            <div style='border: 1px solid black; border-radius: 8px;' class="cartBookDetail">

                <?php
                // Connect to the database
                $connect = mysqli_connect('localhost', 'root', '', 'bookstore');

                // Query the database for the products
                // session_start();
                if (isset($_SESSION['username'])) {
                $usn = $_SESSION['username'];
                
                $sql = "select * from cart where UserID = (select UserID from user where UserName = '$usn')";
                //Step 3: Execute query and save result to var $result
                $result = mysqli_query($connect, $sql);
                //display books to screen
                //Step 3: Execute query and save result to var $result

                //$resultCate = mysqli_query($connect, $sqlCate);
                $totalPrice = 0;
                while ($row_product = mysqli_fetch_array($result)) {
                    $book_id = $row_product['BookID'];
                    $order_number = $row_product['OrderNumber'];
                    $cart_id = $row_product['CartID'];

                    // Fetch the category name for the current product
                    $sql_cate = "select * from book where BookID = '$book_id'";
                    $result_cate = mysqli_query($connect, $sql_cate);
                    $row_cate = mysqli_fetch_array($result_cate);
                    $book_name = $row_cate['BookName'];
                    $book_detail = $row_cate['BookDetail'];
                    $book_price = $row_cate['BookPrice'];
                    $book_image = $row_cate['BookImage'];
                    $totalPrice += $book_price * $order_number;

                    // Print the product details and category name in the same loop
                    echo "
                    <div style='margin-bottom: 20px;margin-top: 20px; margin-right: 20px;margin-left: 20px; border-bottom: 1px solid black'  class='cartBook'>
                        <div style='display:flex; justify-content: space-between;' class='bookDetailCart'>
                            <img src='IMG/$book_image' width='80px' style='margin-bottom: 10px' alt=''>
                            <div style='text-align: center' class='detailInfor'>
                                <p style='font-size: 24px' class='cartBookName'>$book_name</p>
                                <p style='color: red; font-size: 20px' class='cartBookPrice'>$book_price đ</p>
                                <input style='width: 80px; height:30px; border: 2px solid green; font-size: 18px; text-align: center; border-radius: 8px' type='number' name='' id='' value='$order_number'>
                            </div>
                            <div class='actionCart'>
                                
                                <form action='Cart.php' method='post'>
                            <input type='text' name='del' value='$cart_id' hidden>
                            <button name='delete' type='submit' class='delete'><img src='IMG/trash.png' width='20px' alt=''></button>
                            </form>
                            </div>
                        </div>
                    </div>
                        ";
                }
                if(!empty($cart_id)){
                    echo "<div style='padding: 10px 20px; background-color: #498374; width: fit-content; border-radius: 8px; margin: auto; margin-bottom: 20px;' class='btnTotal'>
                    <a style='color: white;' href='payCart.php?id=$cart_id&total=$totalPrice'>Pay: $totalPrice VND</a>
                    </div>";
                }
            }else{
                echo "<script>window.open('login.php','_self')</script>";
            }
                ?>

            </div>
            <?php
            $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
            if (!$connect) {
                echo "";
            }
            if (isset($_POST['delete'])) {
                $id = $_POST['del'];
                $sql1 = "UPDATE book
                SET CategoryID = '25'
                WHERE CategoryID = '$id';";
                $result1 = mysqli_query($connect, $sql1);
                $sql = "DELETE FROM cart WHERE CartID='$id';";
                //Step 3: Execute query and save result to var $result
                $result = mysqli_query($connect, $sql);
                //display books to screen

                echo "<script>window.open('Cart.php','_self')</script>";
            }
            ?>
        </div>
    </div>



</body>

</html>