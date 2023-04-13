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
                session_unset();
                // destroy the session
                session_destroy();
                echo "<script>window.open('index.php','_self')</script>";
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
            <p style="margin-bottom: 30px; margin: auto;" class="titleContent">Profile</p>
            <div class="cartBookDetail">





                <form style="margin-left: 30%; margin-top: 50px; margin-bottom: 10px;" action="profile.php" method="post">
                    <?php
                    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
                    if ($connect) {
                        echo "";
                    }
                    //Step 2: Write query to load limit 10 books to home screen.
                    // session_start();
                    $id = $_SESSION['username'];;
                    $sql = "SELECT * FROM user WHERE UserName='$id'";
                    //Step 3: Execute query and save result to var $result
                    $result = mysqli_query($connect, $sql);
                    //display books to screen

                    while ($row_product = mysqli_fetch_array($result)) {
                        $us_id = $row_product['UserID'];
                        $us_name = $row_product['UserName'];
                        $fullname = $row_product['UserFullName'];
                        $pass = $row_product['UserPassword'];




                        echo "

                    <label>User name</label>
                    <div class='form-group'>
                        <p style='color: red;' id='err'></p>
                        <input style='width: 500px; height: 40px; outline: none; margin-bottom: 30px;' type='text' id='username'
                        name='username' value='$us_name' disabled>
                    </div>
                    <label>Full name</label>
                    <div class='form-group'>
                        <input style='width: 500px; height: 40px; outline: none; margin-bottom: 30px;' type='text' id='password' 
                        name='fullname' value='$fullname' required placeholder='Full name'>
                    </div>

                    <label>Old Password</label>
                    <div class='form-group'>
                        <input style='width: 500px; height: 40px; outline: none; margin-bottom: 30px;' type='password' id='password' 
                        name='oldpass' placeholder='Old Password'>
                        <input style='width: 500px; height: 40px; outline: none; margin-bottom: 30px;' type='password' id='password' 
                        name='passP' value='$pass' hidden>
                    </div>
                    <label>New Password</label>
                    <div class='form-group'>
                        <input style='width: 500px; height: 40px; outline: none; margin-bottom: 30px;' type='password'
                        id='newpass' name='password'  placeholder='New Password'>
                    </div>
                    <label>Confirm Password</label>
                    <div class='form-group'>
                        <input style='width: 500px; height: 40px; outline: none; margin-bottom: 30px;' type='password' id='password'
                        name='cfpass'  placeholder='Confirm Password'>
                    </div>
                    <button class='lgin' name='save' type='submit'>Save</button>";
                    }
                    ?>
                </form>

            </div>
        </div>
    </div>


    <?php
    // session_start();
    // B1 Kết nối đến CSDL theo hướng thủ tục
    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');

    //B2: Xây dựng câu truy vấn
    if (isset($_POST['save'])) {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $cfpass = $_POST['cfpass'];
        $passP = $_POST['passP'];
        if (!empty($oldpass) && !empty($newpass) && !empty($cfpass)) {
            if ($oldpass == $passP && $newpass == $cfpass) {
                if (!empty($fullname)) {
                    $sql = "UPDATE user SET UserFullName = '$fullname', UserPassword = '$newpass' WHERE user.UserName = '$us_name'";
                } else {
                    $sql = "UPDATE user SET  UserPassword = '$newpass' WHERE user.UserName = '$us_name'";
                }
            } else {
                echo "<script>
                const err = document.getElementById('err');
                err.innerHTML = 'Password invalid!';
                </script>";
            }
        } else if (empty($oldpass) && empty($newpass) && empty($cfpass)) {

            if (!empty($fullname)) {
                $sql = "UPDATE user SET UserFullName = '$fullname' WHERE user.UserName = '$us_name'";
            }
        } else {
            echo "<script>
                const err = document.getElementById('err');
                err.innerHTML = 'Password invalid!';
                </script>";
        }


        //B3: Thực thi truy vấn
        $resulCheckDuplicate = mysqli_query($connect, $sql);
        //B4: Nhận được kết quả và xử lý
        echo "<script>window.open('profile.php','_self')</script>";
    }
    ?>
</body>

</html>