<?php 


if(isset($_POST["submitButton"]) && isset($_FILES["filePicker"])){
    
    $textBoxValue = $_POST["textBox"] ?? "";
    
    // Checking for an error
    if($file['error'] == 0){

    $fileContent = getFileContentInArrayForm();

    $numberOfWordsP

}

}

function countNumberOfWordsPerLine(fileContent){

}

function getFileContentInArrayForm(){
    $file = $_FILES["filePicker"] ?? null;
    $fileContentStringForm = file_get_contents($file['tmp_name']);
    $fileContentArrayForm = explode("\n", $fileContentArrayForm)
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment One - Question One</title>
</head>
<body>
    <h1>Assignment One - Question One</h1>
    <form method="post" enctype="multipart/form-data>
        <fieldset>
            <label for="textBox"></label>
            <input name="textBox" id="textBox"type="text">
        </fieldset>

        <fieldset>
            <label for="filePicker"></label>
            <input name="filePicker" id="filePicker" type="file">
        </fieldset>

        <button name="submitButton" type="submit">Submit</button>
    </form>

    <output> 
    
    <p> Base File Content:
    <?php if(isset($fileContent)):?>
    <?php
        $foreach($currentLine as $fileContent): ?>
            <?= $currentLine ?>
  
    <?php endforeach; ?>
    <?php endif; ?>
    </p>
    </output>
</body>
</html>