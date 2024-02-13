<?php
include 'connect.php';

$login = $pass = $invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $password = $_POST['Password'];

    $sql = "SELECT * FROM registration WHERE Username = '$username'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die(mysqli_error($con));
    }

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['Password'];

        if (password_verify($password, $storedPassword)) {
            $login = 1;
            session_start();
            $_SESSION['Username'] = $username;
            header('location: home.php');
            exit;
        } else {
            $pass = 1;
        }
    } else {
        $invalid = 1;
    }
}
?>
<?php
include 'connect.php';

$sucess = $user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['Username']);
    $password = mysqli_real_escape_string($con, $_POST['Password']);

    $sql = "SELECT * FROM registration WHERE Username='$username'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die(mysqli_error($con));
    }

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $user = 1;
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO registration (Username, Password) VALUES ('$username', '$hashedPassword')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $sucess = 1;
            header('location: login.php');
            exit;
        } else {
            die(mysqli_error($con));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>

        <form action="#" class="search-bar">
            <input type="text" placeholder="Search...">
            <button type="submit"><i class='bx bx-search'></i></button>
        </form>
    </header>

    <div class="background"></div>

    <div class="container">
        <div class="content">
            <h2 class="logo">
                <i class='bx bx-book-bookmark'></i>INDUS
                <span>LIBRARY</span>
            </h2>

            <div class="text-sci">
                <h2>Welcome!<br><span>To Our Library.</span></h2>
                <p>
                    "Discover, Learn, Explore: Your Gateway to Knowledge,
                    Where Stories Unfold and Ideas Take Flight"
                </p>

                <div class="social-icon">
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional content for your homepage goes here -->
    <div class="logreg-box">
            <div class="form-box login">
                <form action="index.php" method="post">
                    <h2>Sign In</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user-pin'></i></span>
                        <input type="text" placeholder="" name="Username" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock' ></i></span>
                        <input type="password" placeholder="" name="Password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" >Remember me</label>
                        <a href="#">Forgot password</a>
                    </div>
                    <button type="submit" class="btn"><a href="home.php"></a>Sign In</button>

                    <div class="login-register">
                        <p>Don't have an account? <a href="#" class="register">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>

        <?php
    if ($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are Successfully Login.
      </div>';
    }

    if ($pass) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Invalid Password!</strong> Try Again.
      </div>';
    }

    if ($invalid) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Invalid User!</strong> User Not Found.
      </div>';
    }?>
    </div>

    <div class="form-box register">
                <form action="index.php" method="post">
                    <h2>Sign Up</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user'></i></i></span>
                        <input type="tel" placeholder="" name="FullName" required>
                        <label>Name</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-phone-call' ></i></span>
                        <input type="number" placeholder="" name="Number" required>
                        <label>Mobile No</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxl-gmail' ></i></span>
                        <input type="email" placeholder="" name="Email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user-pin'></i></span>
                        <input type="text" placeholder="" name="Username" required>
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock' ></i></span>
                        <input type="password" placeholder="" name="Password" required>
                        <label>Password</label>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" >I agree to the terms & conditions</label>
                       
                    </div>
                    <button type="submit" class="btn">Sign Up</button>

                    <div class="login-register">
                        <p>Already have an account? 
                            <a href="#" class="login-link">Sign In</a></p>

                    </div>
                </form>
           </div>
         </div>
<?php
if ($user) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry! </strong> This User Already Exists.
  </div>';
}

if ($sucess) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> You are Successfully Sign Up.
  </div>';
}
?>
        </div>
    
    <script src="script.js"></script>
</body>
</html>
