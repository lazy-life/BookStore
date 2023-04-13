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
            <p style="margin-bottom: 30px;" class="titleContent">Pay</p>
            <div style='border: 1px solid black; border-radius: 8px;' class="cartBookDetail">

                <?php
                // Connect to the database
                $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
                $us = $_SESSION['username'];
                $sql1 = "select UserID from user where UserName = '$us'";
                $result1 = mysqli_query($connect, $sql1);
                while ($row_product = mysqli_fetch_array($result1)) {
                    $usId = $row_product['UserID'];
                }
                // Query the database for the products
                // session_start();
                if (isset($_SESSION['username'])) {
                    $totalPrice = $_GET['total'];
                    $idCart = $_GET['id'];
                    echo "
                    <div style='margin-bottom: 20px;margin-top: 20px; margin-right: 20px;margin-left: 20px;'  class='cartBook'>
                        <div style='display:flex; justify-content: space-between;' class='bookDetailCart'>
                        <form action='payCart.php?id=$idCart&total=$totalPrice' method='post'>
                        <div style='text-align: center;margin-top: 30px;' class='detailInfor'>
                                <input style='width: 800px; height:40px; border: 2px solid green; 
                                font-size: 18px; text-align: center; border-radius: 8px;
                                margin-left: 30%' type='text' name='address' id='' placeholder='Your Address' required>
                                </div>
                                </div>
                                <div class='actionCart'>
                                <input name='idCart' id='' value='$idCart' hidden>
                                <button style='padding: 10px 40px; font-size: 20px; background-color: #498374; 
                                width: fit-content; border-radius: 8px; margin-left:40%; margin-bottom: 20px; margin-top: 30px; color: white'
                                name='delete' type='submit' class='delete'>Pay $totalPrice VND</button>
                                </div>
                                </form>
                        </div>
                    </div>";
                } else {
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
                $id = $_POST['idCart'];
                $add = $_POST['address'];
                $sql1 = "INSERT INTO `order` (CartID, UserID, `Address`, TotalPrice) VALUES ('$id', '$usId', '$add', '$totalPrice')";
                $result1 = mysqli_query($connect, $sql1);
                $sql = "UPDATE cart SET UserID = '1' WHERE cart.UserID  = $usId";
                //Step 3: Execute query and save result to var $result
                $result = mysqli_query($connect, $sql);
                //display books to screen

                echo "<script>window.open('index.php','_self')</script>";
            }
            ?>
        </div>
    </div>



</body>

</html>