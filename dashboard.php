<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT difficulty, score, created_at FROM scores WHERE user_id=? ORDER BY created_at DESC LIMIT 5");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['username']; ?> 🎉</h2>
  <h3>Select Game Difficulty:</h3>
  <form action="game.php" method="get">
    <select name="difficulty">
      <option value="easy">Easy</option>
      <option value="medium">Medium</option>
      <option value="hard">Hard</option>
    </select>
    <button type="submit">Start Game</button>
  </form>

  <h3>Your Past Scores</h3>
  <ul>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <li><?php echo $row['difficulty'] . " - " . $row['score'] . " points (" . $row['created_at'] . ")"; ?></li>
    <?php } ?>
  </ul>

  <a href="scoreboard.php">View Leaderboard</a> | 
  <a href="index.php">Logout</a>
</body>
</html>
