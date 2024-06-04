<?php

// Initialize an empty array to hold file content
$fileContent = [];

// Initialize an array to hold errors
$errors = [];

// Check if the form was submitted and a file was uploaded
if (isset($_POST["submitButton"]) && isset($_FILES["filePicker"])) {

    $fileContent = getFileContentInArrayForm();
} else {
    $fileContent = []; // Set file content to an empty array if not submitted
}

/**
 * Function to get the content of the uploaded file in array form
 * This function reads the uploaded file and converts its content into an array of lines.
 */
function getFileContentInArrayForm()
{
    // Get the uploaded file from the global $_FILES array
    $file = $_FILES["filePicker"] ?? null;

    // Check if the file is valid and has been uploaded
    if ($file && $file['tmp_name']) {
        global $errors; // Use the global $errors array to record errors
        $errors['file'] = true; // Set an error if no file is uploaded
        $fileContentStringForm = file_get_contents($file['tmp_name']); // Get file content as a string
        $fileContentArrayForm = explode("\n", $fileContentStringForm); // Split the content into lines
        // Remove empty lines from the array
        $fileContentArrayForm = array_filter($fileContentArrayForm, function ($line) {
            return trim($line) !== "";
        });
        return $fileContentArrayForm; // Return the file content as an array
    }
    return []; // Return an empty array if the file isn't set or there's no tmp_name
}

/**
 * Function to count the number of words per line
 * This function iterates over each line in the file content array and counts the words in each line.
 */
function countNumberOfWordsPerLine($fileContent)
{
    $lineCounter = 1; // Initialize line counter
    foreach ($fileContent as $currentLine) {
        // Count words in the current line by splitting it by spaces and counting the resulting elements
        $amountOfWordsInCurrentLine = count(explode(" ", $currentLine));
        echo "Amount of words in line $lineCounter: $amountOfWordsInCurrentLine<br>";
        $lineCounter++; // Increment line counter
    }
}

/**
 * Function to count the number of 'a' and 'A' characters per line
 * This function iterates over each line in the file content array and counts the occurrences of 'a' and 'A'.
 */
function countNumberOfACharacters($fileContent)
{
    $lineCounter = 1; // Initialize line counter

    foreach ($fileContent as $currentLine) {
        $numberOfACharactersCounter = 0; // Initialize counter for 'a' and 'A' characters

        // Count 'a' characters in the current line
        $numberOfACharactersCounter += substr_count($currentLine, "a");
        // Count 'A' characters in the current line
        $numberOfACharactersCounter += substr_count($currentLine, "A");

        echo "Amount of a's and A's in line $lineCounter: $numberOfACharactersCounter<br>";

        $lineCounter++; // Increment line counter
    }
}

/**
 * Function to count common punctuation characters (ASCII values 32-47) per line
 * This function iterates over each line in the file content array and counts common punctuation characters.
 */
function countNumberOfCommonPunctuationChars($fileContent)
{
    $lineCounter = 1; // Initialize line counter

    foreach ($fileContent as $currentLine) {
        $numberOfCommonPunctuationCharacters = 0; // Initialize counter for common punctuation characters
        $characters = str_split($currentLine); // Split the line into individual characters

        foreach ($characters as $char) {
            $asciiValue = ord($char); // Get ASCII value of the character
            // Check if the character is a common punctuation character (ASCII values 32-47)
            if ($asciiValue >= 32 && $asciiValue <= 47) {
                $numberOfCommonPunctuationCharacters++; // Count common punctuation characters
            }
        }

        echo "Amount of common punctuation in line $lineCounter: $numberOfCommonPunctuationCharacters<br>";

        $lineCounter++; // Increment line counter
    }
}

/**
 * Function to sort strings in descending alphabetical order irrespective of case
 * This function sorts each line of the file content array in descending alphabetical order.
 */
function sortFileStringsDescAlphabetical($fileContent)
{
    $lineCounter = 1; // Initialize line counter

    foreach ($fileContent as $currentLine) {
        $modifiedCurrentLine = explode(" ", $currentLine); // Split line into words
        natcasesort($modifiedCurrentLine); // Sort words case-insensitively
        $modifiedCurrentLine = array_reverse($modifiedCurrentLine); // Reverse the order to get descending order
        var_dump($modifiedCurrentLine); // Output the sorted line for debugging purposes
        $modifiedCurrentLine = implode(" ", $modifiedCurrentLine); // Join words back into a line

        echo "Line $lineCounter: $modifiedCurrentLine <br>";

        $lineCounter++; // Increment line counter
    }
}

/**
 * Function to print the middle third characters of each line
 * This function extracts and prints the middle third characters of each line in the file content array.
 */
function printMiddleThirdCharacters($fileContent)
{
    $lineCounter = 1; // Initialize line counter

    foreach ($fileContent as $currentLine) {
        $currentLineLength = strlen($currentLine); // Get the length of the current line
        $startingPoint = intval($currentLineLength / 3); // Calculate the starting point of the middle third
        $endPoint = intval(2 * $currentLineLength / 3); // Calculate the ending point of the middle third
        $portionToSliceTo = $endPoint - $startingPoint; // Calculate the length of the middle third
        $slicedString = substr($currentLine, $startingPoint, $portionToSliceTo); // Get the middle third characters

        echo "Line $lineCounter: $slicedString <br>";
        $lineCounter++; // Increment line counter
    }
}

/**
 * Function to filter strings based on a search term and highlight it
 * This function filters lines in the file content array that contain a search term and highlights the term.
 */
function filterStrings($fileContent)
{
    // Check if the search term is set and not empty
    if (isset($_POST["textBox"]) && trim($_POST["textBox"]) != "") {
        $searchTerm = $_POST["textBox"]; // Get the search term

        $stringsToPrint = [];
        $numOfStringsToNotPrint = 0; // Initialize counter for strings not containing the search term
        $lineCounter = 0; // Initialize line counter

        foreach ($fileContent as $currentLine) {
            // Check if the current line contains the search term
            if (str_contains($currentLine, $searchTerm)) {
                // Highlight the search term in the current line
                $currentLine = str_ireplace($searchTerm, "<span class=\"highLight\">$searchTerm</span>", $currentLine);
                echo "Line $lineCounter: $currentLine <br>";
            } else {
                $numOfStringsToNotPrint++; // Increment counter if the search term is not found
            }
            $lineCounter++; // Increment line counter
        }

        echo "Number of Strings omitted due to them missing search term: $numOfStringsToNotPrint";
    }
}

/**
 * Function to print the base file content
 * This function prints each line of the file content array.
 */
function printBaseFileContent($fileContent)
{
    $lineCounter = 1; // Initialize line counter

    // Check if the file content is set
    if (isset($fileContent)) {
        foreach ($fileContent as $currentLine) {
            echo "Line $lineCounter: $currentLine <br>"; // Print each line of the file content
            $lineCounter++; // Increment line counter
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
                // Display an error message if the file is not selected
                if (!isset($errors['file'])) {
                    echo "<span class=\"error\">Please select a file </span>";
                }
                ?>
            </span>
        </form>

        <?php
        // Check if the form was submitted and a file was uploaded
        if (isset($_POST["submitButton"]) && $_FILES["filePicker"]['tmp_name']) :
        ?>
            <section>
                <h2>Base File Content</h2>
                <output>
                    <?= printBaseFileContent($fileContent) ?>
                </output>
            </section>

            <section>
                <h2>Number of Words er Line</h2>
                <output> <?= countNumberOfWordsPerLine($fileContent) ?> </output>
            </section>

            <section>
                <h2>Number of A's and a's Per Line</h2>
                <output> <?= countNumberOfACharacters($fileContent) ?></output>
            </section>
            <section>
                <h2>Number of Common Punctuation Characters Per Line</h2>
                <output> <?= countNumberOfCommonPunctuationChars($fileContent) ?></output>
            </section>

            <section>
                <h2>Middle Third Characters Per Line</h2>
                <output> <?= printMiddleThirdCharacters($fileContent) ?></output>
            </section>

            <section>
                <h2>Searching Section</h2>
                <output> <?= filterStrings($fileContent) ?></output>
            </section>
        <?php endif ?>
    </main>
</body>

</html>