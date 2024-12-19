 <?php
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
            }
        }
        ?>
