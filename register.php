<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "✅ Registration successful. <a href='index.php'>Login</a>";
        exit();
    } else {
        echo "❌ Username already exists!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - Puzzle Game</title>
</head>
<body>
  <h2>Register</h2>
  <form method="post">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
  </form>
</body>
</html>
