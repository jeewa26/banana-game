<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$difficulty = $_GET['difficulty'] ?? 'easy';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Game - Puzzle</title>
  <link rel="stylesheet" href="style.css">
  <script>
    let difficulty = "<?php echo $difficulty; ?>";
  </script>
  <script src="game.js"></script>
</head>
<body onload="startGame()">
  <h2>Puzzle Game - Difficulty: <?php echo ucfirst($difficulty); ?></h2>
  <p id="timer">Time: 60</p>
  <div id="puzzle"></div>
  <input type="text" id="answer" placeholder="Your Answer">
  <button onclick="submitAnswer()">Submit</button>
  <p id="message"></p>
</body>
</html>
