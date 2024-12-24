<?php
// Include database connection
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'registration and login';

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    
    // Check if the email exists
    $query = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expiration = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token valid for 1 hour
        
        // Update the user record with the token and expiration
        $updateQuery = "UPDATE registration SET reset_token='$token', token_expiration='$expiration' WHERE email='$email'";
        mysqli_query($conn, $updateQuery);
        
        // Send email with reset link
        $resetLink = "hedmonachacha@gmail.com/reset_password.php?token=$token"; // Change to your domain
        $subject = "Password Reset Request";
        $message = "Click the link to reset your password: $resetLink";
        mail($email, $subject, $message);
        
        echo "<p>A reset link has been sent to your email.</p>";
    } else {
        echo "<p>No account found with that email.</p>";
    }
}
?>