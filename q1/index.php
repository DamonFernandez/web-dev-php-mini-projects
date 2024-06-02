<?php


$fileContent = [];

$errors = [];
if (isset($_POST["submitButton"]) && isset($_FILES["filePicker"])) {

    $fileContent = getFileContentInArrayForm();
} else {
    $fileContent = [];
}




function getFileContentInArrayForm()
{
    $file = $_FILES["filePicker"] ?? null;
    if ($file && $file['tmp_name']) {
        $errors['file'] = true;
        $fileContentStringForm = file_get_contents($file['tmp_name']);
        $fileContentArrayForm = explode("\n", $fileContentStringForm);
        $fileContentArrayForm =  array_filter($fileContentArrayForm, function ($line) {
            return trim($line) !== "";
        });
        return $fileContentArrayForm;
    }
    return []; // Return an empty array if the file isn't set or theres no tmp_name
}

function countNumberOfWordsPerLine($fileContent)
{
    $lineCounter = 1;
    foreach ($fileContent as $currentLine) {
        $amountOfWordsInCurrentLine = count(explode(" ", $currentLine));
        echo "Amount of words in line $lineCounter: $amountOfWordsInCurrentLine<br>";
        $lineCounter++;
    }
}

function countNumberOfACharacters($fileContent)
{
    $lineCounter = 1;

    foreach ($fileContent as $currentLine) {
        $numberOfACharactersCounter = 0;

        $numberOfACharactersCounter += substr_count($currentLine, "a");
        $numberOfACharactersCounter += substr_count($currentLine, "A");

        echo "Amount of a's and A's in line $lineCounter: $numberOfACharactersCounter<br>";

        $lineCounter++;
    }
}


// for simplicity, we'll consider them to be characters with an ascii value between 32-47) You could certainly accomplish this with regular expressions, but it can also be done fairy easily with basic php functions.
// Counts spaces
function countNumberOfCommonPunctuationChars($fileContent)
{
    $lineCounter = 1;

    foreach ($fileContent as $currentLine) {
        $numberOfCommonPunctuationCharacters = 0;
        $characters = str_split($currentLine);

        foreach ($characters as $char) {
            $asciiValue = ord($char);
            if ($asciiValue >= 32 && $asciiValue <= 47) {
                $numberOfCommonPunctuationCharacters++;
            }
        }


        echo "Amount of common punctuation in line $lineCounter: $numberOfCommonPunctuationCharacters<br>";

        $lineCounter++;
    }
}


// irrespective of case).
function sortFileStringsDescAlphabetical($fileContent)
{
    $lineCounter = 1;

    foreach ($fileContent as $currentLine) {
        $modifiedCurrentLine = explode(" ", $currentLine);
        natcasesort($modifiedCurrentLine);
        $modifiedCurrentLine = array_reverse($modifiedCurrentLine);
        var_dump($modifiedCurrentLine);
        $modifiedCurrentLine = implode(" ", $modifiedCurrentLine);


        echo "Line $lineCounter: $modifiedCurrentLine <br>";

        $lineCounter++;
    }
}
// The middle-third characters of the string, if the string isn't evenly divisible by three, you should take the lower value. Example: if the string is 15 characters long, you would output characters 6-10, if it's 16 or 17 characters, you would still output character 6-10
function printMiddleThirdCharacters($fileContent)
{
    $lineCounter = 1;

    foreach ($fileContent as $currentLine) {
        $currentLineLength = strlen($currentLine);
        $startingPoint =  intval($currentLineLength / 3);
        $endPoint = intval(2 * $currentLineLength / 3);
        $portionToSliceTo = $endPoint - $startingPoint;
        $slicedString = substr($currentLine, $startingPoint, $portionToSliceTo);

        echo "Line $lineCounter: $slicedString <br>";
        $lineCounter++;
    }
}


function filterStrings($fileContent)
{

    if (isset($_POST["textBox"]) && trim($_POST["textBox"]) != "") {
        $searchTerm = $_POST["textBox"];

        $stringsToPrint = [];
        $numOfStringsToNotPrint = 0;
        $lineCounter = 0;



        foreach ($fileContent as $currentLine) {
            if (str_contains($currentLine, $searchTerm)) {
                $currentLine = str_ireplace($searchTerm, "<span class=\"highLight\"> $searchTerm </span>", $currentLine);
                echo "Line $lineCounter: $currentLine <br>";
            } else {
                $numOfStringsToNotPrint++;
            }
            $lineCounter++;
        }

        echo "Number of Strings omitted due to missing search term: $numOfStringsToNotPrint";
    }
}

function printBaseFileContent($fileContent)
{
    $lineCounter = 1;

    if (isset($fileContent)) {
        foreach ($fileContent as $currentLine) {
            echo "Line $lineCounter: $currentLine <br>";
            $lineCounter++;
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment One - Question One</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <h1>Assignment One - Question One</h1>
    <main>
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <label for="textBox">Search</label>
                <input name="textBox" id="textBox" type="text">
            </fieldset>
            <fieldset>
                <label for="filePicker">File Picker</label>
                <input name="filePicker" id="filePicker" type="file">
            </fieldset>
            <button name="submitButton" type="submit">Submit</button>
            <span class="error">
                <?php
                if (isset($errors['file'])) {
                    echo "Please select a file";
                }
                ?>
            </span>
        </form>

        <?php if (isset($_POST["submitButton"]) && $_FILES["filePicker"]['tmp_name']) : ?>
            <section>
                <h2>Base File Content</h2>
                <output>
                    <?= printBaseFileContent($fileContent) ?>
                </output>
            </section>

            <section>
                <h2>Number of words per line</h2>
                <output> <?= countNumberOfWordsPerLine($fileContent) ?> </output>
            </section>

            <section>
                <h2>Number of A's and a's per line</h2>
                <output> <?= countNumberOfACharacters($fileContent) ?></output>
            </section>



            <section>
                <h2>Number of Common Punctuation Characters per line</h2>
                <output> <?= countNumberOfCommonPunctuationChars($fileContent) ?></output>
            </section>

            <section>
                <h2> Middle Third Characters per line</h2>
                <output> <?= printMiddleThirdCharacters($fileContent) ?></output>
            </section>

            <section>
                <h2>Searching section</h2>
                <output> <?= filterStrings($fileContent) ?></output>
            </section>
        <?php endif ?>
    </main>
</body>


</html>