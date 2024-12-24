<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS -->
</head>

<body>
    
<?php
    $host = 'localhost';
    $username = 'root'; 
    $password = ''; 
    $db_name = 'registration and login';

    
    $conn = new mysqli($host, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if the email field is set
        if (isset($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];

            // Query to retrieve user data
            $query = "SELECT * FROM registration WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                // Verify the password
                if (password_verify($password, $user['password'])) {
                    echo "<p class='success'>Login successful!</p>";
                    // Redirect to dash.php
                    header("Location: dash.php");
                    exit();
                } else {
                    echo "<p class='error'>Invalid password. Please try again.</p>";
                }
            } else {
                echo "<p class='error'>No account found with that email. Please register.</p>";
            }
        } 
         else {
            echo "<p class='error'>Please enter your email.</p>";
        }
    }
    ?>







    <div class="login-container">
        <!-- <p class="welcome-message">Welcome ! Please log in to continue.</p> -->
        <h2>Login to Your Account</h2>

        <form action="dash.php" method="POST">
            <div class="input-group">
            <i class="fas fa-envelope"></i>
                <!-- <label for="username">Email</label> -->
                <input type="text" id="username" name="username" required placeholder="Enter your email">
            </div>

            <div class="input-group">
            <i class="fas fa-lock"></i>
                <!-- <label for="password">Password</label> -->
                <input type="password" id="password" name="password" required placeholder="Enter your password">
                            <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility('password')"></i>

            </div>
            <button type="submit" action="dash.php">Login</button>
        </form>

        <div class="link-container">
            <a href="forgot_password.php">Forgot Password?</a>
           <p><a href="reg.php">Create an Account</a></p>
        </div>
    </div>

</body>

</html>