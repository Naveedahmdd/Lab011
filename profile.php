<?php
session_start();
require_once "settings.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
$username = $_SESSION['username'];

$query = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

    <h3>Edit Profile</h3>
    <form method="post" action="update_profile.php">
        <label for="email">New Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br><br>
        <input type="submit" value="Update Email">
    </form>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php mysqli_close($conn); ?>
