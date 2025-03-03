<?php
session_start();

$answer = $_POST["answer"] ?? "";
$errors = [];
$timeLeft = $_POST["time_left"] ?? 30;

if (isset($_POST["submit"]) || isset($_POST["auto_submit"])) {
    if (empty($answer)) {
        if (isset($_POST["auto_submit"])) {
            $_SESSION["feedback"][3] = "4) You did not choose any option! The correct answer is Solar Energy.";
            header("Location: ./ques2p5.php");
            exit();
        } else {
            $errors["answer"] = true;
        }
    }
    if (empty($errors)) {
        $_SESSION["feedback"][3] = ($answer === "Solar Energy") ? "4) Correct! The answer is Solar Energy." : "4) Incorrect! The correct answer is Solar Energy.";
        header("Location: ./ques2p5.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2 Ques 4</title>
    <link rel="stylesheet" href="../styles/ques2p1.css">
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
    <br/>
    <br/>
    <br/>
    <fieldset>
        <legend>Question 4: Which of the following is a renewable resource?</legend>
        <p id="timer" style="color: red; font-weight: bold;">Time Left: <?= $timeLeft ?> seconds</p>

        <form method="post" action="./ques2p4.php" onsubmit="timerRunning = true;">
            <input type="hidden" id="time_left" name="time_left" value="<?= $timeLeft ?>">

            <label>
                <input type="radio" name="answer" value="Oil"> A) Oil
            </label><br>
            <label>
                <input type="radio" name="answer" value="Natural Gas"> B) Natural Gas
            </label><br>
            <label>
                <input type="radio" name="answer" value="Solar Energy"> C) Solar Energy
            </label><br>
            <label>
                <input type="radio" name="answer" value="Coal"> D) Coal
            </label><br>

            <button type="submit" name="submit">Submit</button>
            <br/>
            <span class="error <?= isset($errors["answer"]) ? '' : 'hidden' ?>">You must select an option</span>
            <button type="submit" id="auto_submit" name="auto_submit" hidden></button>
        </form>
    </fieldset>

    <img src="../includes/images/Renewable.jpeg" alt="Renewable Sources Of Energy image" width="1440" height="500"/>
</main>
</body>

</html>
