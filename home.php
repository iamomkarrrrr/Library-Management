<?php
session_start();
if(!isset($_SESSION['Username'])){
    header('location:login.php');
}




?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    .btn {
        opacity: 0.6;
    }

    .btn {
        background-color: #5d54d8;
        width: 400px;
        color: rgb(248, 248, 248);
        padding: 10px;
        margin: 10px 0px;
        border: none;
        cursor: pointer;
    }
</style>
</head>
<body>
    <div class="container text-center"> <!-- Added the 'text-center' class to center-align elements -->
        <h1 class="text-center text-warning mt-5">Welcome
            <?php
                echo $_SESSION['Username'];
            ?>
        </h1>

        <a href="logout.php" class="btn btn-primary mt-5">Logout</a> <!-- Removed 'align="center"' as it's not needed -->
    </div>
</body>
</html>

