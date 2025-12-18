<?php
$host     = "localhost";
$db_user  = "root";
$db_pass  = "root"; 
$db_name  = "users";

$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connect to database
    $conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $user  = $_POST["username"];
    $email = $_POST["email"];
    $pass  = $_POST["password"];

    // Check for empty fields
    if (empty($user) || empty($email) || empty($pass)) {
        $message = "<p style='color:red;'>Please fill all fields.</p>";
    } else {

        // Insert data into database 
        $sql = "INSERT INTO users (username, email, password)
                VALUES ('$user', '$email', '$pass')";

        if (mysqli_query($conn, $sql)) {
            // if successful, go to next page
            header("Location: home2.html");
            exit();
        } else {
            $message = "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Book Reviewing Website</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head> 
<body>

    <form action="signup.php" method="POST">
      <div class="log"></div>
      <h2>Create an account</h2> 

      <?php echo $message; ?>

      <label for="username">Username</label>
      <input type="text" name="username" required placeholder="enter your name"><br><br>

      <label for="email">Email</label>
      <input type="email" name="email" required placeholder="enter your email"><br><br>

      <label for="password">Password</label>
      <input type="password" name="password" required placeholder="enter your password" minlength="6"><br><br>

      <button type="submit">sign up</button>
      <br><br>   
      <a href="login.php">already have an account?</a>
  </form>

</body>
</html>