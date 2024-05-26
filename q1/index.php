<?php 



   
    $fileContent = getFileContentInArrayForm() ?? [];


    




if(isset($_POST["submitButton"]) && isset($_FILES["filePicker"])){
    
    $textBoxValue = $_POST["textBox"] ?? "";

}

else{
    $fileContent = [];
}


function getFileContentInArrayForm() {
    $file = $_FILES["filePicker"] ?? null;
    if ($file !== null && isset($file['tmp_name'])) {
        $fileContentStringForm = file_get_contents($file['tmp_name']);
        $fileContentArrayForm = explode("\n", $fileContentStringForm);
        return $fileContentArrayForm;
    }
    return []; // Return an empty array if the file isn't set or theres no tmp_name
}

function countNumberOfWordsPerLine($fileContent){
    $lineCounter = 1;
    foreach($fileContent as $currentLine){
        $amountOfWordsInCurrentLine = count(explode(" ", $currentLine));
        echo "Amount of words in line $lineCounter: $amountOfWordsInCurrentLine<br>";
        $lineCounter++;
    }
}

function countNumberOfACharactersPerLine($fileContent){
    $lineCounter = 1;

    foreach($fileContent as $currentLine){
        $numberOfACharactersCounter = 0;

        $numberOfACharactersCounter += substr_count($currentLine, "a");
        $numberOfACharactersCounter += substr_count($currentLine, "A");

        echo "Amount of a's and A's in line $lineCounter: $numberOfACharactersCounter<br>";

        $lineCounter++;
    }
}


// for simplicity, we'll consider them to be characters with an ascii value between 32-47) You could certainly accomplish this with regular expressions, but it can also be done fairy easily with basic php functions.
function countNumberOfCommonPunctuationCharactersPerLine($fileContent){

}


// irrespective of case).
function sortStringDescAlphabeticalPerLine($fileContent){

}
// The middle-third characters of the string, if the string isn't evenly divisible by three, you should take the lower value. Example: if the string is 15 characters long, you would output characters 6-10, if it's 16 or 17 characters, you would still output character 6-10
function printMiddleThirdCharacterPerLine($fileContent){

}


function filterStrings($fileContent){

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
    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="textBox">Search:</label>
            <input name="textBox" id="textBox"type="text">
        </fieldset>

        <fieldset>
            <label for="filePicker">File Picker:</label>
            <input name="filePicker" id="filePicker" type="file">
        </fieldset>

        <button name="submitButton" type="submit">Submit</button>
    </form>

  
    
    <h2> Base File Content:</h2>
    <output> 
    <?php if(isset($fileContent)):?>
    <?php
        foreach($fileContent as $currentLine): ?>
            <?= $currentLine ?>
  
    <?php endforeach; ?>
    <?php endif; ?>
    </output>


    <h2> Number of words per line </h2>
    <output> <?= countNumberOfWordsPerLine($fileContent)?> </output>
  

    <h2>Number of A's and a's per line</h2>
    <output> <?= countNumberOfACharactersPerLine($fileContent)?></output>


</body>
</html>