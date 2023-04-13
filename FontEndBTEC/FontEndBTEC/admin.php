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

    <button id="popup-btn" style="width: 300px; height: 50px; margin-left: 45%; margin-top: 50px;
    border-radius: 8px; background-color: #498374; color: white; border: none">Add book</button>
    <div style="margin-bottom: 50px;" id="content">
        <table>
            <thead>
                <tr>
                    <th style="background-color: #498374; color: white;">Name</th>
                    <th style="background-color: #498374; color: white;">Price</th>
                    <th style="background-color: #498374; color: white;">Detail</th>
                    <th style="background-color: #498374; color: white;">Image</th>
                    <th style="background-color: #498374; color: white;">Category</th>
                    <th style="background-color: #498374; color: white;"></th>
                    <th style="background-color: #498374; color: white;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database
                $connect = mysqli_connect('localhost', 'root', '', 'bookstore');

                // Query the database for the products
                $sql = "SELECT * FROM book";
                //Step 3: Execute query and save result to var $result
                $result = mysqli_query($connect, $sql);
                //display books to screen
                $sqlCate = 'SELECT * FROM category';
                //Step 3: Execute query and save result to var $result
                $resultCate = mysqli_query($connect, $sqlCate);

                while ($row_product = mysqli_fetch_array($result)) {
                    $book_id = $row_product['BookID'];
                    $book_name = $row_product['BookName'];
                    $book_detail = $row_product['BookDetail'];
                    $book_price = $row_product['BookPrice'];
                    $book_image = $row_product['BookImage'];
                    $catebook_id = $row_product['CategoryID'];

                    // Fetch the category name for the current product
                    $sql_cate = "SELECT CategoryName FROM category WHERE CategoryID = '$catebook_id'";
                    $result_cate = mysqli_query($connect, $sql_cate);
                    $row_cate = mysqli_fetch_array($result_cate);
                    $cate_name = $row_cate['CategoryName'];

                    // Print the product details and category name in the same loop
                    echo "
                            <tr>
                            <td style='width: 15%'>$book_name</td>
                            <td>$book_price đ</td>
                            <td style='width: 40%;'>$book_detail</td>
                            <td style='width: 5%;'><img src='IMG/$book_image' alt=''></td>
                            <td>$cate_name</td>
                            <td style='width: 5%;'>
                            <form action='admin.php' method='post'>
                            <input type='text' name='del' value='$book_id' hidden>
                                <button style='padding: 10px;
                                background-color: #007bff;
                                color: #fff;
                                border: none;
                                border-radius: 3px;
                                cursor: pointer;' name='delete' type='submit'>Delete</button></td>
                            </form>
                            <td style='width: 5%;'><a 
                            style='padding: 10px;
                            background-color: #007bff;
                            color: #fff;
                            border: none;
                            border-radius: 3px;
                            cursor: pointer;' href='updateBook.php?key=$book_id' type='submit'>Update</a></td>
                            </tr>
                        ";
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <?php
    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
    if (!$connect) {
        echo "";
    }
    if (isset($_POST['delete'])) {
        $id = $_POST['del'];
        $sql1 = "DELETE FROM cart WHERE BookID = '$id'";
        $result1 = mysqli_query($connect, $sql1);
        $sql = "DELETE FROM book WHERE BookID = '$id'";
        //Step 3: Execute query and save result to var $result
        $result = mysqli_query($connect, $sql);
        //display books to screen

        echo "<script>window.open('admin.php','_self')</script>";
    }
    ?>

    <div style="border-radius: 8px;" id="popup">
        <div style="text-align: center;">
            <h2>Add book</h2>
        </div>
        <form class="formAdd" method="post" enctype="multipart/form-data">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01">
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <div>
                <label for="detail">Detail:</label>
                <textarea id="detail" name="detail"></textarea>
            </div>
            <div>
                <label for="category">Category:</label>
                <!-- php -->
                <select id="category" name="category">
                    <?php
                    //Step 1: Connect to database: bookstore.
                    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
                    if ($connect) {
                        echo "";
                    }
                    //Step 2: Write query to load limit 10 books to home screen.
                    $sql = "SELECT * FROM category";
                    //Step 3: Execute query and save result to var $result
                    $result = mysqli_query($connect, $sql);
                    //display books to screen

                    while ($row_product = mysqli_fetch_array($result)) {
                        $cate_id = $row_product['CategoryID'];
                        $cate_name = $row_product['CategoryName'];
                        echo "
                    <option value='$cate_id'>$cate_name 1</option>
                ";
                    }
                    ?>
                </select>
            </div>
            <button style="margin-top: 20px;" name="submit" type="submit">Add Product</button>
            <button id="close-btn">Close</button>
        </form>
    </div>

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
        $name = $_POST['name'];
        $price = $_POST['price'];
        $detail = $_POST['detail'];
        $category = $_POST['category'];
        // change path image
        $target_dir = "IMG/"; // Directory where the uploaded image will be stored
        $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path of the uploaded image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Get the file extension of the uploaded image
        $random_name = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
        // Move the uploaded image to the target directory with a new name
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . "$name$random_name." . $imageFileType)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        //storage name image to database
        $image = $name . $random_name . "." . $imageFileType;
        if (isset($_SESSION['username']) || !empty($_SESSION['username'])) {
            $sql = "INSERT INTO book (BookName, BookPrice, BookDetail, BookImage, CategoryID) VALUES ('$name', '$price', '$detail', '$image', '$category');";
            $result = mysqli_query($connect, $sql);
            echo "<script>window.open('admin.php','_self')</script>";
        } else {
            echo "<script>window.open('login.php','_self')</script>";
            exit();
        }
    }

    ?>



    <script>
        var popup = document.getElementById("popup");
        var popupBtn = document.getElementById("popup-btn");
        var closeBtn = document.getElementById("close-btn");

        popupBtn.onclick = function() {
            popup.style.display = "block";
        }

        closeBtn.onclick = function() {
            popup.style.display = "none";
        }

        // update
        var popupAdmin = document.getElementById("popupAdmin");
        var popupBtnAdmin = document.getElementById("popup-btnAdmin");
        var closeBtnAdmin = document.getElementById("close-btnAdmin");

        popupBtnAdmin.onclick = function() {
            popupAdmin.style.display = "block";
        }

        closeBtnAdmin.onclick = function() {
            popupAdmin.style.display = "none";
        }
    </script>
</body>

</html>