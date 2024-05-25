<?php 

$submitButton = $_POST[]



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <fieldset>
            <label for="textBox"></label>
            <input id="textBox"type="text">
        </fieldset>

        <fieldset>
            <label for="filePicker"></label>
            <input id="filePicker" type="file">
        </fieldset>

        <button type="submit">Submit</button>
    </form>

    <output></output>
</body>
</html>