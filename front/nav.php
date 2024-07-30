<?php

// Determine the current file to fetch the relevant data
$currentFile = basename($_SERVER['PHP_SELF']);
$title = "";
$logoPath = "";

if ($currentFile == 'index.php') {
    // Fetch general settings for the home page
    $sql = "SELECT site_name, logo_path FROM general_settings WHERE id = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $settings = $result->fetch_assoc();
        $title = $settings['site_name'];
        $logoPath = 'uploads/' . $settings['logo_path'];
    }
} elseif ($currentFile == 'calculatorPage.php' && isset($_GET['slug'])) {
    // Fetch calculator settings for the calculator page
    $slug = $_GET['slug'];
    $sql = "SELECT calculator_name FROM calculators_settings WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $calculator = $result->fetch_assoc();
        $title = $calculator['calculator_name'];
    }

    // Use the same logo for the calculator page
    $sql = "SELECT logo_path FROM general_settings WHERE id = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $settings = $result->fetch_assoc();
        $logoPath = $domainwithhttps.'/uploads/' . $settings['logo_path'];
    }
}
?>

<header class="header">
    <div class="container-fluid">
        <div class="flex-align header-wrap">
            <button class="btnroot" aria-label="Open/Close sidebar">
                <svg class="btnroot-icon" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                    <path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" d="M21 4C21.5523 4 22 3.55229 22 3C22 2.44772 21.5523 2 21 2L5 2C4.44772 2 4 2.44772 4 3C4 3.55228 4.44772 4 5 4L21 4ZM3.53 16.0438L8.6432 12.848C9.26987 12.4563 9.26987 11.5437 8.6432 11.152L3.53 7.95625C2.86395 7.53997 2 8.01881 2 8.80425V15.1958C2 15.9812 2.86395 16.46 3.53 16.0438ZM21 13C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11L13 11C12.4477 11 12 11.4477 12 12C12 12.5523 12.4477 13 13 13L21 13ZM22 21C22 21.5523 21.5523 22 21 22L5 22C4.44771 22 4 21.5523 4 21C4 20.4477 4.44771 20 5 20L21 20C21.5523 20 22 20.4477 22 21Z"></path>
                </svg>
            </button>
            <a href="/" class="header-logo" title="Home">
                <img src="<?php echo htmlspecialchars($logoPath); ?>" title="<?php echo htmlspecialchars($title); ?> logo" alt="<?php echo htmlspecialchars($title); ?> logo" width="100px" height="50px"/>
            </a>
        </div>
    </div>
</header>
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar-game">
                <div class="navbar-wrap">
                    <div class="navbar-list">
                        <div class="navbar-menu">
                            <ul class="navbar-menu-ul">
                                <li class="navbar-menu-li current">
                                    <a href="/" class="navbar-menu-link" title="Home">Home</a>
                                </li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/about" class="navbar-menu-link" title="About Us">About Us</a></li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/contact" class="navbar-menu-link" title="Contact Us">Contact Us</a></li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/privacy-policy" class="navbar-menu-link" title="Privacy Policy">Privacy Policy</a></li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/terms" class="navbar-menu-link" title="Terms &amp; Conditions">Terms &amp; Conditions</a></li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/disclaimer" class="navbar-menu-link" title="Disclaimer">Disclaimer</a></li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/dmca" class="navbar-menu-link" title="DMCA Policy">DMCA Policy</a></li>
                                <li class="navbar-menu-li"><a href="<?php echo $domainwithhttps;?>/p/copyright" class="navbar-menu-link" title="Copyright Infringement Notice Procedure">Copyright Infringement Notice Procedure</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="main-game">
                <div class="container main-game-wrap">
                    <div class="px-3">
                        <div class="infor-web my-bread">
                            <div class="text">
                                <ul class="my-breadcrumb">
                                    <li>
                                        <a class="my-breadcrumb_name" href="<?php echo $domainwithhttps;?>" title="Home">
                                            <svg fill="#b6e1ef" height="40px" width="40px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                                <g>
                                                    <polygon class="st0" points="434.162,293.382 434.162,493.862 308.321,493.862 308.321,368.583 203.682,368.583 203.682,493.862 77.841,493.862 77.841,293.382 256.002,153.862 	"/>
                                                    <polygon class="st0" points="0,242.682 256,38.93 512,242.682 482.21,285.764 256,105.722 29.79,285.764 	"/>
                                                    <polygon class="st0" points="439.853,18.138 439.853,148.538 376.573,98.138 376.573,18.138 	"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="my-breadcrumb_name" title="<?php echo htmlspecialchars($title); ?>"><?php echo htmlspecialchars($title); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
