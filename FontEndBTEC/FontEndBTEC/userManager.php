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
    border-radius: 8px; background-color: #498374; color: white; border: none">List User</button>
    <div style="margin-bottom: 50px;" id="content">
    <table>
                <thead>
                    <tr>
                        <th style="background-color: #498374; color: white;">Username</th>
                        <th style="background-color: #498374; color: white;">Full name</th>
                        <th style="background-color: #498374; color: white;">Roles</th>
                        <th style="background-color: #498374; color: white;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to the database
                    $connect = mysqli_connect('localhost', 'root', '', 'bookstore');

                    // Query the database for the products
                    $sql = "SELECT * FROM user";
                    //Step 3: Execute query and save result to var $result
                    $result = mysqli_query($connect, $sql);
                    //display books to screen
                    $sqlCate = 'SELECT * FROM category';
                    //Step 3: Execute query and save result to var $result
                    $resultCate = mysqli_query($connect, $sqlCate);

                    while ($row_product = mysqli_fetch_array($result)) {
                        $user_id = $row_product['UserID'];
                        $user_name = $row_product['UserName'];
                        $fullname = $row_product['UserFullName'];
                        $roles = $row_product['UserRole'];

                        if ($roles == -1) {
                            echo "
                            <tr>
                            <td style='width: 15%'>$user_name</td>
                            <td>$fullname</td>
                            <td style='width: 40%;'>$roles</td>
                            <td style='width: 5%;'>
                            <form action='userManager.php' method='post'>
                            <input type='text' name='dis' value='$user_id' hidden>
                            <input type='text' name='role' value='$roles' hidden>
                            <button name='disable' type='submit'>Enable</button></td>
                            </form>
                            </tr>
                        ";
                        }
                        if ($roles == 0) {
                            // Print the product details and category name in the same loop
                            echo "
                            <tr>
                            <td style='width: 15%'>$user_name</td>
                            <td>$fullname</td>
                            <td style='width: 40%;'>$roles</td>
                            <td style='width: 5%;'>
                            <form action='userManager.php' method='post'>
                            <input type='text' name='dis' value='$user_id' hidden>
                            <input type='text' name='role' value='$roles' hidden>
                            <button name='disable' type='submit'>Disable</button></td>
                            </form>
                            </tr>
                        ";
                        }
                        if ($roles == 1) {
                            echo "
                            <tr>
                            <td style='width: 15%'>$user_name</td>
                            <td>$fullname</td>
                            <td style='width: 40%;'>$roles</td>
                            <td style='width: 5%;'>
                            </tr>";
                        }
                    }

                    ?>
                </tbody>
            </table>

            <?php
            $connect = mysqli_connect('localhost', 'root', '', 'bookstore');
            if (!$connect) {
                echo "";
            }
            if (isset($_POST['disable'])) {
                $id = $_POST['dis'];
                $role = $_POST['role'];
                if ($role == '0') {
                    $sql1 = "UPDATE user
                SET UserRole = '-1'
                WHERE UserID = '$id';";
                    $result1 = mysqli_query($connect, $sql1);
                    //display books to screen

                    echo "<script>window.open('userManager.php','_self')</script>";
                } else {
                    $sql1 = "UPDATE user
                SET UserRole = '0'
                WHERE UserID = '$id';";
                    $result1 = mysqli_query($connect, $sql1);
                    //display books to screen

                    echo "<script>window.open('userManager.php','_self')</script>";
                }
            }
            ?>
    </div>
    </div>
    


    
</body>

</html>