<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';


// Function to check if the user is logged in
function checkLogin() {
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
}


checkLogin();

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?php if ($tab == 'general') echo 'active'; ?>" href="dashboard.php?tab=general">
                <i class="bi bi-gear-fill me-2"></i>
                General Settings
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($tab == 'calculator') echo 'active'; ?>" href="dashboard.php?tab=calculator">
                <i class="bi bi-calculator-fill me-2"></i>
                Calculator Settings
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($tab == 'user') echo 'active'; ?>" href="dashboard.php?tab=user">
                <i class="bi bi-person-fill me-2"></i>
                User Settings
            </a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link" href="<?php echo $domainwithhttps;?>">
                <i class="bi bi-box-arrow-up-right me-2"></i>
                View Website
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </a>
        </li>
    </ul>
</div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h2 class="mt-4"><?php echo ucfirst($tab); ?> Settings</h2>
            <?php
            if ($tab == 'general') {
                include 'general_settings.php';
            } elseif ($tab == 'calculator') {
                include 'calculator_settings.php';
            } elseif ($tab == 'user') {
                include 'user_settings.php';
            }
            ?>
        </main>
    </div>
</div>
</body>
</html>
