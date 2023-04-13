<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Gac Xep Book Store</title>
    <style>
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

    <div id="content">
        <?php
        $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
        if ($connect) {
            echo "";
        }
        $id = $_GET["id"];
        $sql = "SELECT * FROM book WHERE BookID={$id}";
        $result = mysqli_query($connect, $sql);

        while ($row_product = mysqli_fetch_array($result)) {
            $book_id = $row_product['BookID'];
            $book_name = $row_product['BookName'];
            $book_detail = $row_product['BookDetail'];
            $book_price = $row_product['BookPrice'];
            $book_image = $row_product['BookImage'];
            $book_cate = $row_product['CategoryID'];
            echo " 
        <div style='width: 20%; border:none' class='left>
            <p class='titleContent'></p>
            <div style='margin-top: 70px' class='cateList'>
                <div class='imgTim'>
                    <img src='IMG/$book_image' alt=''>
                </div>
                </ul>
            </div>
        </div>
        <div class='right'>
            <p class='titleContent'>Detail Books</p>
            <div class='listBook'>
                <!-- 1 -->
                
                <div class='bookDet'>
                    <div class='inforBookDe'>
                        <p style='font-size: 28px;'>$book_name</p>
                        <div class='detailDetail'>
                            <div class='cateDetail'>
                                <p class='chP'>Category: </p>
                                <p>$book_cate</p>
                            </div>
                            <div class='cateDetail'>
                                <p class='chP'>Author: </p>
                                <p>Howard Kissel</p>
                            </div>
                        </div>
                        <div class='priceDetail'>
                            <p>$book_price VND</p>
                        </div>

                        <div class='listDetailBook'>
                            <ul>
                                <li>Language: English</li>
                                <li>Dimensions: 6.36 x 1.01 x 9.25 inches</li>
                            </ul>
                        </div>
                    </div>
                    <div class='buyBtnBook'>
                    <p class='inforAddCart'>$book_name - $book_price VND</p>
                    <form action='' method='POST'>
                    <input type='hidden' name='product_id' value='$book_id'>
                    <button class='BtnAddCartDetail' name='addCart' type='submit'>Add to Cart</button>
                </form>
                    </div>
                    
                </div>
                </div>";
        }
        ?>





        <p class="txtRe">Recommend</p>
        <div class="recomend listBook">
            <?php
            //Step 1: Connect to database: bookstore.
            $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
            if ($connect) {
                echo "";
            }
            $sql = "SELECT * FROM book ORDER BY RAND() LIMIT 4";
            $result = mysqli_query($connect, $sql);

            while ($row_product = mysqli_fetch_array($result)) {
                $book_id = $row_product['BookID'];
                $book_name = $row_product['BookName'];
                $book_detail = $row_product['BookDetail'];
                $book_price = $row_product['BookPrice'];
                $book_image = $row_product['BookImage'];
                echo "
                <div class='book'>
                    <a href='detail.php?id=$book_id'>
                        <div class='borderImg'>
                            <img width='100%'' height=' 350px' src='IMG/$book_image' alt=''>
                        </div>
                        <div class='inforBook'>
                            <p>$book_name</p>
                            <p>$book_price VND</p>
                        </div>
                    </a>
                    <div class='check'>
                        <form action='' method='POST'>
                            <input type='hidden' name='product_id' value='$book_id'>
                            <button class='addCartHome' name='addCart' type='submit'>Add to Cart</button>
                        </form>

                    </div>
                </div>
                           
                ";
            }
            ?>


        </div>
    </div>
    <?php
    // session_start();

    if (isset($_POST['addCart'])) {
        // get the product ID and quantity from the form submission
        if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
            // Hide all content in HTML
            echo "<script>window.open('login.php','_self')</script>";
            exit();
        } else {
            $product_id = $_POST['product_id'];
            $quantity = 1;

            $usID = $_SESSION['username'];
            //get usID
            $sqlUsID = "SELECT UserID FROM user where UserName = '$usID'";
            //Step 3: Execute query and save result to var $result
            $resultUsID = mysqli_query($connect, $sqlUsID);
            $row_book = mysqli_fetch_array($resultUsID);
            $uID = $row_book['UserID'];
            //display books to screen

            $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
            $sql = "INSERT INTO cart (UserID, BookID, OrderNumber) VALUES ('$uID', '$product_id', '$quantity')";
            //B3: Thực thi truy vấn
            $resulCheckDuplicate = mysqli_query($connect, $sql);
            // $result = mysqli_num_rows($resulCheckDuplicate);
            echo "<script>alert('Add Success');</script>";
        }
    }
    ?>
</body>

</html>