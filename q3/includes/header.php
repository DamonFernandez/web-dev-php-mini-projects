<?php
if (isset($_GET['restart']) || isset($_POST['restart'])) {
    session_destroy();
    $_SESSION['currentGame'] = 0;
    $_SESSION['numberWins'] =  0;
    $_SESSION['numberLosses'] = 0;
    header("Location: index.php");
    exit();
}
if (isset($_GET["highscore"])) {
    header("Location: highscore.php");
    exit();
}
?>
<header>
    <nav>
        <form method="get">
            <button type="sumit" name="restart" id="restart">Restart Game</button>
            <button type="button" name="highscore" id="highscore">High Scores</button>
        </form>
    </nav>
</header>