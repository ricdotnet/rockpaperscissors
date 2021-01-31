<?php

    //require("functions.php");
    // if(isset($_POST['win'])) {
    //     $_SESSION['wins']++;
    //     header("Location: index.php");
    // }

    session_start(); //start session

    //session logic to check wins
    if(empty($_SESSION['wins'])) {
        $winsMessage = "You don't have any wins yet."; //if $_SESSION['wins'] is 0 or empty.
    } else {
        if($_SESSION['wins'] == 1) {
            $winsMessage = "You have " . $_SESSION['wins'] . " win."; //override $winsMessage to always be updated without refresh
        } else {
            $winsMessage = "You have " . $_SESSION['wins'] . " wins."; //override $winsMessage to always be updated without refresh
        }
    }

    //reset win score
    if(isset($_POST['reset'])) {
        session_destroy();
        header("Location: index.php");
    }

    //default strat message
    $matchResult = "Please click one option below to play.";

    //create choices array and get a random selector
    $cpuChoices = array("rock", "paper", "scissors");
    $cpu = $cpuChoices[rand(0,2)];

    //run button rock
    if(isset($_POST['rock'])) {

        $matchResult = "You chose Rock.<br>" . play("rock", $cpu);

        //only set this message if there are wins
        if($_SESSION['wins'] > 0) {
            if($_SESSION['wins'] > 1) {
                $winsMessage = "You have " . $_SESSION['wins'] . " win."; //override $winsMessage to always be updated without refresh
            } else {
                $winsMessage = "You have " . $_SESSION['wins'] . " wins."; //override $winsMessage to always be updated without refresh
            }
        }

        //header("Location: index.php"); //refresh page

    //run button paper
    } else if(isset($_POST['paper'])) {

        $matchResult = "You chose Paper.<br>" . play("paper", $cpu);

        //only set this message if there are wins
        if($_SESSION['wins'] > 0) {
            if($_SESSION['wins'] == 1) {
                $winsMessage = "You have " . $_SESSION['wins'] . " win."; //override $winsMessage to always be updated without refresh
            } else {
                $winsMessage = "You have " . $_SESSION['wins'] . " wins."; //override $winsMessage to always be updated without refresh
            }
        }

        //header("Location: index.php"); //refresh page

    //run button scissors
    } else if(isset($_POST['scissors'])) {

        $matchResult = "You chose Scissors.<br>" . play("scissors", $cpu);
        
        //only set this message if there are wins
        if($_SESSION['wins'] > 0) {
            if($_SESSION['wins'] == 1) {
                $winsMessage = "You have " . $_SESSION['wins'] . " win."; //override $winsMessage to always be updated without refresh
            } else {
                $winsMessage = "You have " . $_SESSION['wins'] . " wins."; //override $winsMessage to always be updated without refresh
            }
        }

        //header("Location: index.php"); //refresh page

    }
    
    #function to play the game
    #using nested case switches to avoid a massive elseif
    function play($userChoice, $cpuChoice) {

        switch($userChoice) {

            //user chooses rock
            case "rock":
                switch($cpuChoice) {

                    //cpu chooses rock = tie
                    case "rock":
                        return "The cpu chose Rock.<br><b>Its a Tie.</b>";
                        break;

                    //cpu chooses paper = loss
                    case "paper":
                        return "The cpu chose Paper.<br><b>You Lose.</b>";
                        break;

                    //cpu chooses scissors = win
                    case "scissors":
                        $_SESSION['wins']++;
                        return "The cpu chose Scissors.<br><b>You Win.</b>";
                        break;
                }
                break;

            //user chooses paper
            case "paper":
                switch($cpuChoice) {

                    //cpu chooses rock = win
                    case "rock":
                        $_SESSION['wins']++;
                        return "The cpu chose Rock.<br><b>You Win.</b>";
                        break;
                    
                    //cpu chooses paper = tie
                    case "paper":
                        return "The cpu chose Paper.<br><b>Its a Tie.</b>";
                        break;

                    //cpu chooses scissors = loss
                    case "scissors":
                        return "The cpu chose Scissors.<br><b>You Lose.</b>";
                        break;
                }
                break;

            //user chooses scissors
            case "scissors":
                switch($cpuChoice) {

                    //cpu chooses rock = loss
                    case "rock":
                        return "The cpu chose Rock.<br><b>You Lose.</b>";
                        break;

                    //cpu chooses paper = win
                    case "paper":
                        $_SESSION['wins']++;
                        return "The cpu chose Paper.<br><b>You Win.</b>";
                        break;

                    //cpu chooses scissors = tie
                    case "scissors":
                        return "The cpu chose Scissors.<br><b>Its a Tie.</b>";
                        break;
                }
                break;
        } //end switch($userChoice)

    } //end function play

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Rock, Paper, Scissors</title>

        <link rel="stylesheet" href="resources/styles.css">
    </head>
    <body>

        <div class="container">

            <div class="matchResult"><?=$matchResult?></div>

            <form action="" method="post">
                <button class="rock" name="rock">rock</button>
                <button class="paper" name="paper">paper</button>
                <button class="scissors" name="scissors">scissors</button>
                <br><br>
                <div class="winsMessage"><?=$winsMessage?></div>
                <!-- <button name="win">win</button> -->
                <button name="reset">reset</button>
            </form>

            

        </div>

    </body>
</html>