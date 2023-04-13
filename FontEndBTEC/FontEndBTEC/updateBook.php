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
            </a>
        </div>
    </div>
    <div class="imgTitle">
        <img src="IMG/bg_breadcrumb.jpg" alt="">
        <h2>All Books</h2>
    </div>

    <?php
        $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
        if ($connect) {
            echo "";
        }
        //Step 2: Write query to load limit 10 books to home screen.
        $id = $_GET["key"];
        $sql = "SELECT * FROM book WHERE BookID=$id";
        //Step 3: Execute query and save result to var $result
        $result = mysqli_query($connect, $sql);
        //display books to screen

        while ($row_product = mysqli_fetch_array($result)) {
            $book_id = $row_product['BookID'];
            $book_name = $row_product['BookName'];
            $book_detail = $row_product['BookDetail'];
            $book_price = $row_product['BookPrice'];
            $book_image = $row_product['BookImage'];
            $book_cate = $row_product['CategoryID'];
            echo "
                <div style='display: block; position: static;'>
        <div style='text-align: center;'>
            <h2>Update book</h2>
        </div>
        <form class='formAdd' method='post' enctype='multipart/form-data'>
            <div>
                <label for='name'>Name:</label>
                <input type='text' id='name' name='name' value='$book_name' requireD>
            </div>
            <div>
                <label for='price'>Price:</label>
                <input type='number' id='price' name='price' step='0.01' value='$book_price' requireD>
            </div>
            <div>
                <label for='image'>Image:</label>
                <input type='file' id='image' name='image'>
            </div>
            <div>
                <label for='detail'>Detail:</label>
                <textarea id='detail' name='detail' value='' requireD>$book_detail</textarea>
            </div>
            <div>
                <label for='category'>Category:</label>
                <!-- php -->
                <select id='category' name='category' requireD>";


            $sql = "SELECT * FROM category";
            //Step 3: Execute query and save result to var $result
            $result = mysqli_query($connect, $sql);
            //display books to screen

            while ($row_product = mysqli_fetch_array($result)) {
                $cate_id = $row_product['CategoryID'];
                $cate_name = $row_product['CategoryName'];
                if ($cate_id == $book_cate) {
                    echo "
                    <option value='$cate_id' selected>$cate_name</option>";
                } else {
                    echo "
                    <option value='$cate_id'>$cate_name</option>";
                }
            }
            echo "
                    </select>
            </div>
            <button name='submit' type='submit'>Update Product</button>
        </form>
    </div>";
        }
        ?>

    






    <!-- update -->





    <!-- php insert new book to database -->
    <?php
    // session_start();
    // Check if the button is clicked
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
        $price = $_POST['price'];
        $detail = $_POST['detail'];
        $category = $_POST['category'];
        // change path image

        if (!empty($_FILES["image"]["name"])) {
            // An image was uploaded, handle the upload and update the database
            $target_dir = "IMG/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $random_name = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . "$random_name." . $imageFileType)) {
                // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                $image = $random_name . "." . $imageFileType;
            } else {
                // echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            // No image was uploaded, update the database without the image
            $sql = "SELECT * FROM book WHERE BookID={$id}";
            //Step 3: Execute query and save result to var $result
            $result = mysqli_query($connect, $sql);
            //display books to screen

            while ($row_product = mysqli_fetch_array($result)) {
                $image = $row_product['BookImage'];
            }
        }

        if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
            $sql = "UPDATE book SET BookName = '$name', BookPrice = '$price', BookDetail = '$detail', BookImage = '$image', CategoryID = '$category' WHERE book.BookID = $id";
            $result = mysqli_query($connect, $sql);
            echo "<script>window.open('admin.php','_self')</script>";
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