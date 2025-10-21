let timeLeft = 30;
let timerInterval;
let currentPuzzle = {};
let score = 0;

function startGame() {
    score = 0;

    if (difficulty === "easy") timeLeft = 60;
    else if (difficulty === "medium") timeLeft = 40;
    else if (difficulty === "hard") timeLeft = 20;

    document.getElementById("timer").innerText = "Time: " + timeLeft;
    document.getElementById("message").innerText = "";
    getPuzzle();

    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        timeLeft--;
        document.getElementById("timer").innerText = "Time: " + timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            endGame();
        }
    }, 1000);
}

function getPuzzle() {
    fetch("https://marcconrad.com/uob/banana/api.php")
        .then(res => res.json())
        .then(data => {
            currentPuzzle = data;
            document.getElementById("puzzle").innerHTML =
                `<img src="${data.question}" alt="puzzle" width="200">`;
        });
}

function submitAnswer() {
    let userAnswer = document.getElementById("answer").value;
    if (userAnswer == currentPuzzle.solution) {
        score += 10;
        timeLeft += 5;
        document.getElementById("message").innerText = "✅ Correct! +5s";
    } else {
        timeLeft -= 5;
        document.getElementById("message").innerText = "❌ Wrong! -5s";
    }
    document.getElementById("answer").value = "";
    getPuzzle();
}

function endGame() {
    alert("Game Over! Your score: " + score);

    fetch("save_score.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "score=" + score + "&difficulty=" + difficulty
    }).then(() => {
        window.location.href = "scoreboard.php";
    });
}
