<?php
if (isset($_GET['restart'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
if (isset($_GET["highscore"])) {
    session_destroy();
    header("Location: highscores.php");
    exit();
}
?>
<header>
    <nav>
        <form method="get">
            <button type="submit" name="highscore" id="highscore">High Scores</button>
            <button type="submit" name="restart" id="restart">Restart Game</button>
        </form>
    </nav>
</header>