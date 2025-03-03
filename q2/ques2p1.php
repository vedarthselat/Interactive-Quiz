<?php
session_start();

$answer = $_POST["answer"] ?? "";
$errors = [];
$timeLeft = $_POST["time_left"] ?? 30;

if (isset($_POST["submit"]) || isset($_POST["auto_submit"])) {
    if (empty($answer)) {
        if (isset($_POST["auto_submit"])) {
            $_SESSION["feedback"][0] = "1) You did not choose any option! The correct answer is Rainforest.";
            header("Location: ./ques2p2.php");
            exit();
        } else {
            $errors["answer"] = true;
        }
    }
    if (empty($errors)) {
        $_SESSION["feedback"][0] = ($answer === "Rainforest") ? "1) Correct! The answer is Rainforest." : "1) Incorrect! The correct answer is Rainforest.";
        header("Location: ./ques2p2.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2 Ques 1</title>
    <link rel="stylesheet" href="../styles/ques2p1.css"/>
    <script>
        let timeLeft = <?= $timeLeft ?>;
        let timerRunning = false;
        function startTimer() {
            if (!timerRunning) {
                timerRunning = true;
                const timerInterval = setInterval(() => {
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        document.getElementById("auto_submit").click();
                    } else {
                        document.getElementById("timer").textContent = `Time Left: ${timeLeft} seconds`;
                        timeLeft--;
                        document.getElementById("time_left").value = timeLeft;
                    }
                }, 1000);
            }
        }
        window.onload = startTimer;
    </script>
</head>
<body>
<header>
    <?php include "../includes/navbar.php" ?>
</header>
<main>
    <br/><br/><br/>
    <fieldset>
        <legend>Question 1: Which ecosystem is known for having the highest biodiversity?</legend>
        <p id="timer" style="color: red; font-weight: bold;">Time Left: <?= $timeLeft ?> seconds</p>
        <form method="post" action="./ques2p1.php" onsubmit="timerRunning = true;">
            <input type="hidden" id="time_left" name="time_left" value="<?= $timeLeft ?>">
            <label><input type="radio" name="answer" value="Desert"> A) Desert</label><br>
            <label><input type="radio" name="answer" value="Tundra"> B) Tundra</label><br>
            <label><input type="radio" name="answer" value="Rainforest"> C) Rainforest</label><br>
            <label><input type="radio" name="answer" value="Grassland"> D) Grassland</label><br>
            <button type="submit" name="submit">Submit</button>
            <br/>
            <span class="error <?= isset($errors["answer"]) ? '' : 'hidden' ?>">You must select an option</span>
            <button type="submit" id="auto_submit" name="auto_submit" hidden></button>
        </form>
    </fieldset>
    <img src="../includes/images/biodiversity.jpg" alt="Nature image" width="1440" height="500"/>
</main>
</body>
</html>
