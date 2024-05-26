<?php
include 'header.php';
require_once 'User.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $loggedInUser = $user->login($_POST['username'], $_POST['password']);

    if ($loggedInUser) {
        $_SESSION['user'] = $loggedInUser;
        header('Location: index.php');
    } else {
        echo "<p>Invalid username or password</p>";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include 'footer.php'; ?>
