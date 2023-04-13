<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Gac Xep Book Store</title>
    <style>
        .lgin {
            width: 500px;
            height: 50px;
            background-color: #498374;
            color: white;
            font-size: 20px;
            border: none;
        }

        .lgin:hover {
            background-color: #007c5b;
            border: 1px solid yellow;
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
            <p style="margin-bottom: 30px; margin: auto;" class="titleContent">Log in</p>
            <div class="cartBookDetail">

                <form style="margin-left: 30%; margin-top: 50px; margin-bottom: 10px;" action="login.php" method="post">
                    <div class="form-group">
                        <p style="color: red;" id="err"></p>
                        <input style="width: 500px; height: 40px; outline: none; margin-bottom: 30px;" type="text" id="username" name="username" required placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input style="width: 500px; height: 40px; outline: none; margin-bottom: 30px;" type="password" id="password" name="password" required placeholder="Password">
                    </div>
                    <button class="lgin" name="submit" type="submit">Log In</button>
                </form>
                <a style="margin-left: 30%; margin-top: 50px;" href="signup.php">Sign Up</a>

            </div>
        </div>
    </div>


    <?php
    // session_start();
    // B1 Kết nối đến CSDL theo hướng thủ tục
    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');

    //B2: Xây dựng câu truy vấn
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user  WHERE UserName ='$username' AND UserPassword ='$password'";

        //B3: Thực thi truy vấn
        $resulCheckDuplicate = mysqli_query($connect, $sql);
        $result = mysqli_num_rows($resulCheckDuplicate);
        //B4: Nhận được kết quả và xử lý
        //Đếm số dòng
        $count = mysqli_num_rows($resulCheckDuplicate);
        if ($count == 0) {
            echo "<script>
            const err = document.getElementById('err');
            err.innerHTML = 'Username or password invalid!';
            </script>";
        } else {
            $row_product = mysqli_fetch_array($resulCheckDuplicate);
            if ($row_product['UserRole'] == 1) {
                $_SESSION['username'] = $username;
                echo "<script>window.open('admin.php','_self')</script>";
            } else {
                $_SESSION['username'] = $username;
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    }
    ?>
</body>

</html>