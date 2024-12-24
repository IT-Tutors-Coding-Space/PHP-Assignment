<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="container">
        <h2>Register Here </h2>
        <?php

// database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'Registration and login';

// create a connection
$conn = new mysqli($host, $username, $password, $db_name);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// registration script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = htmlspecialchars($_POST['first_name']);
    $middle_name = htmlspecialchars($_POST['middle_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO registration (first_name, middle_name, last_name, email, password) VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<p class='success'>Registration successful!</p>";
    } else {
        echo "<p class='error'>Registration failed. Please try again.</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstName = htmlspecialchars($_POST['first_name']);
             $middleName = htmlspecialchars($_POST['middle_name']);
             $lastName = htmlspecialchars($_POST['last_name']);
             $email = htmlspecialchars($_POST['email']);
             $password = $_POST['password'];
             $confirmPassword = $_POST['confirm_password'];
            
            // Validate inputs


            
            if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
                echo "<p class='error'>Please fill in all required fields.</p>";
            } else if ($password !== $confirmPassword) {
                echo "<p class='error'>Passwords do not match.</p>";
            } else {
                echo "<p class='success'>Registration successful. Please proceed to the <a href='login.php'>login page</a>.</p>";
                header('Location: login.php');
                exit();
            }
        }
        ?>

        <form method="post" action="">
             <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" id="first_name" placeholder="First Name" name="first_name" required>
            </div>

             <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" id="middle_name" placeholder="Middle Name" name="middle_name">
            </div>

            <div class="input-group">
            <i class="fas fa-user"></i>

            <input type="text" id="last_name" placeholder="Last Name" name="last_name" required>
            </div>

            <div class="input-group">
            <i class="fas fa-envelope"></i>
            <!-- <label for="email">Email Address:</label> -->
            <input type="email" id="email" placeholder="Email Address" name="email" required>
            <!-- <input type="email" id="email" name="email" required> -->
            </div>

            <div class="input-group">
            <i class="fas fa-lock"></i>
            <!-- <label for="password">Password:</label> -->
             <input type="password" id="password" placeholder="Password" name="password" required>
            <!-- <input type="password" id="password" name="password" required> -->
            </div>

            <div class="input-group">
            <i class="fas fa-lock"></i>
            <!-- <label for="confirm_password">Confirm Password:</label> -->
            <input type="password" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required><br><br>
            <!-- <input type="password" id="confirm_password" name="confirm_password" required> -->
            </div>
            <button type="submit">Submit</button>
        </form>
        <div class="link-container">
            <p>Already have an Account?<a href="login.php">Login</a></p>
        </div>
    </div>
    
</body>
</html>