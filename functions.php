<?php

function getWins() {

    session_start();

    if(empty($_SESSION['wins'])) {
        return "You don't have any wins yet.";
    } else {
        return "You have " . $_SESSION['wins'] . " wins.";
    }
}


function addWin($session) {

    $session++;

}

function resetWins() {
    session_destroy();
    header("location: index.php");
}


?>