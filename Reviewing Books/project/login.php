<?php
// For Start Connection to database:
$conn = mysqli_connect("localhost", "root", "root", "users");
// For Check the Connection:
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$message = "";
//if user clicks login button
if (isset($_POST['login'])) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    //To check if the username fild or password fild is empty:
    if (empty($username) || empty($password)) {
        $message = "Please fill all fields.";
    } else {
        // Simple query without prepared statements
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {//if atleast one row matches
            // Login success
            header("Location: home2.html");
            exit();
        } else {
            $message = "Invalid username or password.";
        }
    }
}
// For closing  Connection :
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Reviewing Website</title>
<link rel="stylesheet" href="register.css"><!--Links to css file for styling -->
</head>
<body>

<form action="login.php" method="POST"><!--Links to php file we ussed POST To hide sinistive data(username amd Password)-->
</head>
    <div class="log"></div>
    <h2>Login</h2>
     <!--Is a PHP Code means:If the message variable is not empty, it will be displayed to the user in red-->
    <?php if(!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>

    <label>Username:</label><!--Lable shown to the user to specify what is required -->
    <input type="text" name="username" placeholder="Enter your username" required><br><br><!--Input for lable to allow the user to enter -->

    <label>Password:</label>
    <input type="password" name="password" placeholder="Enter your password" required><br><br>

    
    <button type="submit" name="login">Login</button><!-- button to login-->
    <br><br>
    <a href="signup.php">Don't have an account?</a><!--Link to sign up page -->
</form>

</body>
</html>
