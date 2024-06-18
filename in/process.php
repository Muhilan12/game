<?php
session_start();

// Sample users data for demonstration (normally fetched from a database)
$users = [
    ['email' => 'user@example.com', 'password' => 'password123'],
    ['email' => 'admin@example.com', 'password' => 'admin123']
];

// Function to authenticate user
function authenticate($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

// Function to check if the email is already registered
function is_email_registered($email, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return true;
        }
    }
    return false;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = $_POST['formType'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($formType === 'login') {
        if (authenticate($email, $password, $users)) {
            $_SESSION['email'] = $email;
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    } elseif ($formType === 'signup') {
        $confirmPassword = $_POST['confirmPassword'];
        if ($password !== $confirmPassword) {
            $error = 'Passwords do not match.';
        } elseif (is_email_registered($email, $users)) {
            $error = 'Email is already registered.';
        } else {
            // In a real application, you'd save the new user to a database here
            $users[] = ['email' => $email, 'password' => $password];
            $_SESSION['email'] = $email;
            header('Location: dashboard.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login/Signup</title>
</head>
<body>
<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>
</body>
</html>
