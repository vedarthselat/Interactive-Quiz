<?php
session_start();

$answer = $_POST["answer"] ?? "";
$errors = [];
$timeLeft = $_POST["time_left"] ?? 30;

if (isset($_POST["submit"]) || isset($_POST["auto_submit"])) {
    if (empty($answer)) {
        if (isset($_POST["auto_submit"])) {
            $_SESSION["feedback"][2] = "3) You did not choose any option! The correct option is Photosynthesis";
            header("Location: ./ques2p4.php");
            exit();
        } else {
            $errors["answer"] = true;
        }
    }
    if (empty($errors)) {
        $_SESSION["feedback"][2] = ($answer === "Photosynthesis") ? "3) Correct! The answer is Photosynthesis." : "3) Incorrect! The correct answer is Photosynthesis.";
        header("Location: ./ques2p4.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2 Ques 3</title>
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
        <legend>Question 3: What process do plants use to make their food?</legend>
        <p id="timer" style="color: red; font-weight: bold;">Time Left: <?= $timeLeft ?> seconds</p>

        <form method="POST" action="./ques2p3.php" onsubmit="timerRunning = true;">
            <input type="hidden" id="time_left" name="time_left" value="<?= $timeLeft ?>">

            <label>
                <input type="radio" name="answer" value="Respiration"> A) Respiration
            </label><br>
            <label>
                <input type="radio" name="answer" value="Photosynthesis"> B) Photosynthesis
            </label><br>
            <label>
                <input type="radio" name="answer" value="Fermentation"> C) Fermentation
            </label><br>
            <label>
                <input type="radio" name="answer" value="Digestion"> D) Digestion
            </label><br>

            <button type="submit" name="submit">Submit</button>
            <br/>
            <span class="error <?= isset($errors["answer"]) ? '' : 'hidden' ?>">You must select an option</span>
            <button type="submit" id="auto_submit" name="auto_submit" hidden></button>
        </form>
    </fieldset>

    <img src="../includes/images/plants.jpeg" alt="Plant image" width="1440" height="500"/>
</main>
</body>

</html>
