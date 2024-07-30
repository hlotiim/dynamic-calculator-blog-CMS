<?php 
include __DIR__ . "../../config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Determine the current file to fetch the relevant data
$currentFile = basename($_SERVER['PHP_SELF']);

// Initialize variables
$title = $metaTitle = $metaDescription = $faviconPath = $logoPath = $canonicalUrl = "";

if ($currentFile == 'index.php') {
    // Fetch general settings for the home page
    $sql = "SELECT site_name, meta_title, meta_description, logo_path, favicon_path FROM general_settings WHERE id = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $settings = $result->fetch_assoc();
        $title = $metaTitle = $settings['meta_title'];
        $metaDescription = $settings['meta_description'];
        $faviconPath = 'uploads/' . $settings['favicon_path'];
        $logoPath = 'uploads/' . $settings['logo_path'];
    }
    $canonicalUrl = $domainwithhttps;
} elseif ($currentFile == 'calculatorPage.php' && isset($_GET['slug'])) {
    // Fetch calculator settings for the calculator page
    $slug = $_GET['slug'];
    $sql = "SELECT calculator_name, meta_title, meta_description FROM calculators_settings WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $calculator = $result->fetch_assoc();
        $title = $metaTitle = $calculator['meta_title'];
        $metaDescription = $calculator['meta_description'];
    }
    $canonicalUrl = $domainwithhttps . '/calculator/' . $slug;
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="external" content="true">
    <meta name="distribution" content="Global">
    <meta http-equiv="audience" content="General">
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta name="title" content="<?php echo htmlspecialchars($metaTitle); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="keywords" content="addition, calculator, simple calculator">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <link rel="icon" href="<?php echo htmlspecialchars($faviconPath); ?>"/>
    <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($faviconPath); ?>"/>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo htmlspecialchars($faviconPath); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo htmlspecialchars($faviconPath); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo htmlspecialchars($faviconPath); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($metaTitle); ?>" itemprop="headline"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" itemprop="url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo htmlspecialchars($faviconPath); ?>"/>
    <meta property="og:description" content="<?php echo htmlspecialchars($metaDescription); ?>" itemprop="description"/>
    <meta property="og:site_name" content="Addition Calculator"/>
    <meta name="twitter:title" content="<?php echo htmlspecialchars($metaTitle); ?>"/>
    <meta name="twitter:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($faviconPath); ?>"/>
    <meta name="twitter:description" content="<?php echo htmlspecialchars($metaDescription); ?>">
    <meta name="twitter:card" content="summary"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($domainwithhttps); ?>/assets/css/style.css">
</head>
<body>
<?php include "front/nav.php"; ?>
