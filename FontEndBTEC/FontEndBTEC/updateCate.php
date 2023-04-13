<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/index.css">
    <title>Gac Xep Book Store</title>
    <style>
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1200px;
            padding: 20px 0 50px 0;
            background-color: #fff;
            box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;
            z-index: 9999;
        }

        #popup h2 {
            margin-top: 0;
        }

        #close-btn {
            display: block;
            margin-top: 20px;
        }

        /* form */
        .formAdd {
            display: flex;
            flex-direction: column;
            max-width: 900px;
            margin: 0 auto;
        }

        /* div {
            display: none;
            flex-direction: column;
            margin-bottom: 10px;
        } */



        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="url"],
        textarea,
        select,
        #close-btn,
        #close-btnAdmin {
            width: 100%;
            height: 50px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }



        button[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0069d9;
        }


        /* dajkhdad */
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

        .adminBtn {
            margin-right: 20px;
            margin-left: 20px;
            background-color: #498374;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #090909;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div id="header">
        <div class="logo">
            <a href="admin.php">
                <img src="IMG/logo.webp" width="200px" alt="">
            </a>
        </div>
        <div class="search">
            <a class="adminBtn" href="admin.php">Book Manager</a>
            <a class="adminBtn" href="userManager.php">User Manager</a>
            <a class="adminBtn" href="categoryManager.php">Category Manager</a>
            <!-- <form action="search.php" method="get">
                <input class="inputSearch" type="search" name="query" id="" placeholder="Search...">
                <input class="btnSearch" type="submit" value="Search">
            </form> -->
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
                echo "
                <form method='post'>
                    <button style='border: none; background-color: white;' name='logout' type='submit'><a>Log out</a></button>
                </form>
                ";
            }
            ?>
            <?php
            if (isset($_POST['logout'])) {
                session_unset();

                session_destroy();
                echo "<script>window.open('index.php','_self')</script>";
            }
            ?>

            <a class="cartLogo" href="Cart.php">
            </a>
        </div>
    </div>
    <div class="imgTitle">
        <img src="IMG/bg_breadcrumb.jpg" alt="">
        <h2>All Books</h2>
    </div>
    <div style="margin-bottom: 50px;" id="content">

        <?php
        $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
        if ($connect) {
            echo "";
        }
        //Step 2: Write query to load limit 10 books to home screen.
        $id = $_GET["key"];
        $sql = "SELECT * FROM category WHERE CategoryID = $id";
        //Step 3: Execute query and save result to var $result
        $result = mysqli_query($connect, $sql);
        //display books to screen

        while ($row_product = mysqli_fetch_array($result)) {
            $cate_id = $row_product['CategoryID'];
            $cate_name = $row_product['CategoryName'];
            echo "
                <div style='display: block; margin-left:20%'>
                    <div style='text-align: center;'>
                        <h2>Update book</h2>
                    </div>
                    <form method='post' enctype='multipart/form-data'>
                        <div style='margin-top: 30px'>
                            <label for='name'>Name:</label>
                            <input style='width: 500px' type='text' id='name' name='name' value='$cate_name' requireD>
                        </div>
                        <button style='margin-left: 40%; margin-top: 20px' name='submit' type='submit'>Update Product</button>
                    </form>
                </div>";
        }
        ?>
        <?php
        if (isset($_POST['logout'])) {
            // Unset the session variable
            unset($_SESSION['username']);
            // Redirect the user to the login page
            echo "<script>window.open('login.php','_self')</script>";
        }
        ?>
        <?php
        $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
        if (!$connect) {
            echo "";
        }
        if (isset($_POST['submit'])) {
            $id = $_GET["key"];
            $name = $_POST['name'];

            if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
                $sql = "UPDATE category SET CategoryName = '$name' WHERE category.CategoryID = $id";
                $result = mysqli_query($connect, $sql);
                echo "<script>window.open('categoryManager.php','_self')</script>";
            } else {
                echo "<script>window.open('login.php','_self')</script>";
                exit();
            }
        }
        ?>
    </div>
    </div>


</body>

</html>