<?php 

$score=0;
$per=0.0;
$comment="";
session_start();
foreach($_SESSION["feedback"] as $result)
{
    if(str_contains($result, "Incorrect") || str_contains($result, "You did not"))
    {
        continue;
    }
    else
    {
        $score+=1;
    }
}

if($score===5)
{
    $comment="Excellent! You scored full marks! Keep it up.";
    $per=100.0;
}
else if($score===4)
{
    $comment="Very good! You scored 4 out of 5.";
    $per=80.0;
}
else if($score===3)
{
    $comment="Satisfactory! You scored 3 out of 5.";
    $per=60.0;
}
else if($score===2)
{
    $comment="Needs Improvement! You scored 2 out of 5.";
    $per=40.0;
}
else if($score===1)
{
    $comment="Better luck next time! You scored 1 out of 5.";
    $per=20.0;
}
else if($score===0)
{
    $comment="You need to work hard! You scored 0 out of 5.";
    $per=0.0;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 2</title>
    <link rel="stylesheet" href="../styles/q2results.css">
</head>
<body>
    <header>
        <?php include "../includes/navbar.php"; ?>
    </header>
    <main>
        <div>
            <h1>You have completed the quiz!</h1>
            <p>You achieved the following result:</p>
            <p><?= $per ?>.0%</p>
            <p><?= $comment ?></p>
            <a class="button" href="./ques2p1.php">Retake the quiz</a>
        </div>
        <br/>
        <br/>
        <div class="results">
        <br/>
        <h1>Here are your choices:</h1>
        <br/>
        <?php foreach($_SESSION["feedback"] as $result){ ?>
        <div class="<?= str_contains($result, 'Incorrect') || str_contains($result, 'You did not') ? 'red' : 'green' ?>">
        <p><?= $result ?></p><span><b><?= str_contains($result, 'Incorrect') ? " (0 points)" : " (1 point)"?></b></span>
        </div>
        <br/>
        <?php } ?>
        </div>
    </main>
</body>
</html>
