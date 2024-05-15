<?php
session_start();
require_once '../config/Database.php';
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->username = $_POST['username'];
    $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user->email = $_POST['email'];

    if ($user->create()) {
        echo "User registered successfully.";
    } else {
        echo "User registration failed.";
    }
}
?>

<?php include_once '../templates/header.php'; ?>

<h2>Register</h2>
<form action="register.php" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php include_once '../templates/footer.php'; ?>
