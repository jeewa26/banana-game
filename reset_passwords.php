<?php
include("db.php");

echo "<h2>Password Reset Script</h2>";

$users = [
    ["username" => "student1", "password" => "pass123"],
    ["username" => "student2", "password" => "1234"]
];

foreach ($users as $user) {
    $username = $user['username'];
    $plainPassword = $user['password'];

    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashedPassword, $username);
    
    if ($stmt->execute()) {
        echo "✅ Password updated for <strong>$username</strong> (password: $plainPassword)<br>";
        echo "New hash: $hashedPassword<br><br>";
    } else {
        echo "❌ Error updating $username: " . $conn->error . "<br><br>";
    }
    
    $stmt->close();
}

$conn->close();

echo "<hr>";
echo "<p>✅ All passwords have been reset!</p>";
echo "<p>You can now login with:</p>";
echo "<ul>";
echo "<li><strong>student1</strong> / pass123</li>";
echo "<li><strong>student2</strong> / 1234</li>";
echo "</ul>";
echo "<p><a href='index.php'>Go to Login Page</a></p>";
?>