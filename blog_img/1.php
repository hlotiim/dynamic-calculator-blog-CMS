<?php

// Get the parameters from the query string
$size = isset($_GET['size']) ? $_GET['size'] : '120';
$bg = isset($_GET['bg']) ? $_GET['bg'] : 'f67280';
$fontColor = isset($_GET['fontcolor']) ? $_GET['fontcolor'] : 'ffffff';
$sizeAndName = isset($_GET['sizeandname']) ? $_GET['sizeandname'] : '1200x900';
$text = isset($_GET['text']) ? $_GET['text'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Function to slugify text
function slugify($text) {
    $text = str_replace('%20', ' ', $text); // Replace "%20" with spaces
    $text = str_replace(' ', '-', strtolower($text)); // Convert spaces to hyphens and make lowercase
    return $text;
}

// Check if the text parameter is slugified
if (strpos($text, '-') === false) {
    // Text is not slugified, slugify it
    $text = slugify($text);

    // Remove hyphens from both the starting and ending positions
    $text = trim($text, '-');

    // Redirect to the URL with slugified text
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $domain = $_SERVER['HTTP_HOST'];
    $baseUrl = "$protocol://$domain";
    
    $newUrl = "$baseUrl/images/$size/$bg/$fontColor/$sizeAndName/$text.png";
    header("Location: $newUrl");
    exit;
}

// Text is already slugified, capitalize the first letter of each word
$text = ucwords(str_replace('-', ' ', $text));

$text = wordwrap($text, 30, "\n", true);

// Extract the width and height from sizeAndName parameter
$sizeParts = explode('x', $sizeAndName);
$width = isset($sizeParts[0]) ? (int)$sizeParts[0] : 1200;
$height = isset($sizeParts[1]) ? (int)$sizeParts[1] : 900;

// Set the content type to image/png
header('Content-Type: image/png');

// Create a blank image with the specified width and height
$image = imagecreatetruecolor($width, $height);

// Convert the background color from hexadecimal to RGB values
$bgColor = sscanf($bg, "%2x%2x%2x");

// Allocate the background color for the image
imagefill($image, 0, 0, imagecolorallocate($image, ...$bgColor));

// Convert the font color from hexadecimal to RGB values
$fontColor = sscanf($fontColor, "%2x%2x%2x");

// Set the font file path
$fontFile = __DIR__ . '/../assets/fonts/Arial_Bold.ttf'; // Update the path based on the font file location

// Set the font size
$fontSize = $size;

// Calculate scaling factor based on the size of the image
$scalingFactor = $width / 1200; // 1200 is the base width of your original image size

// Scale font size
$scaledFontSize = $fontSize * $scalingFactor;

// Calculate the text box dimensions for the scaled font size
$textBox = imagettfbbox($scaledFontSize, 0, $fontFile, urldecode($text));
$textWidth = $textBox[2] - $textBox[0];
$textHeight = $textBox[3] - $textBox[5];

// Calculate the text position (centered) for the scaled font size
$textX = ($width - $textWidth) / 2;
$textY = ($height - $textHeight + 110 * $scalingFactor) / 2;

// Allocate the font color for the text
$textColor = imagecolorallocate($image, ...$fontColor);

// Write the scaled text on the image
imagettftext($image, $scaledFontSize, 0, $textX, $textY, $textColor, $fontFile, urldecode($text));

// Output the image as PNG
imagepng($image);

// Free up memory
imagedestroy($image);
?>