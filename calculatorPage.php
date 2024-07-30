<?php
include 'front/header.php';

// Check if slug is set
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];

    // Fetch calculator details based on slug
    $sql = "SELECT * FROM calculators_settings WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $calculator = $result->fetch_assoc();
    } else {
        // Redirect or show an error if the calculator is not found
        header("Location:".$domainwithhttps);
        exit();
    }
} else {
    // Redirect or show an error if no slug is provided
    header("Location:".$domainwithhttps);
    exit();
}
?>

<div class="infor-web play-game ads_new">
    <?php echo $calculator['calculator_html']; ?>

    <script>
        <?php echo $calculator['calculator_javascript']; ?>
    </script>
</div>
<div class="infor-web excerpt">
    <div class="container-fluid">
        <div class="row flex-align">
            <div class="col-md-5 col-lg-2">
                <div class="excerpt-img">
                    <img class="w-100 h-auto" src="<?php echo $domainwithhttps;?>/uploads/pp.png" width="164" height="164" alt="Author profile picture" title="Author profile picture">
                </div>
            </div>
            <div class="col-md-7 col-lg-10 excerpt-text">
                <h1>Author: <a href="https://roktimsaha.com" title="author's website">Roktim Saha</a></h1>
                <div class="excerpt-text-main"></div>
                <div class="excerpt-text-info">
                    <p>RoKTiM Saha is a skilled Web Manager, Python Bot Developer, and PHP Expert with over 7 years of experience in creating and managing innovative web solutions. He has developed over 100 websites, showcasing his expertise in PHP, Python, and complex backend logic. Connect with RoKTiM and explore his work at www.roktimsaha.com.</p>
                </div>
                <div class="excerpt-text-main"></div>
                <div class="excerpt-text-info">
                    Address: Assam, India (Planet: Earth, Milkyway Galaxy 😉)
                </div>
                <div class="excerpt-text-main"></div>
                <section class="social">
                    <ul class="social-set">
                        <li><a class="sociali" href="https://x.com/hlotiim" target="_blank" aria-label="Twitter">
                            <i class="fa fa-twitter fa-fw" title="Twitter"></i></a>
                        </li>
                        <li><a class="sociali" href="https://github.com/hlotiim" target="_blank" aria-label="GitHub">
                            <i class="fa fa-github-square fa-fw" title="GitHub"></i></a>
                        </li>
                        <li><a class="sociali" href="https://instagram.com/hlotiim" target="_blank" aria-label="Instagram">
                            <i class="fa fa-instagram fa-fw" title="Instagram"></i></a>
                        </li>
                        <li><a class="sociali" href="https://linkedin.com/hlotiim" target="_blank" aria-label="LinkedIn">
                            <i class="fa fa-linkedin fa-fw" title="LinkedIn"></i></a>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>
<div class="infor-web content">
    <center>
        <img class="w-100 h-auto rounded-3" src="<?php echo $domainwithhttps;?>/images/45/001d75/ffffff/800x250.png/<?php echo htmlspecialchars($calculator['meta_title']); ?>.png" width="158" height="158" title="<?php echo htmlspecialchars($calculator['meta_title']); ?>" alt="<?php echo htmlspecialchars($calculator['meta_title']); ?>">
    </center>
    <h2><?php echo htmlspecialchars($calculator['meta_title']); ?></h2>
    <div class="flex flex-grow flex-col max-w-full">
        <?php echo nl2br(htmlspecialchars($calculator['article_content'])); ?>
    </div>
</div>
<div class="game-more">
    <a href="/" class="game-more-title" title="Latest Blog Posts">Related Calculators</a>
    <main class="container mt-4">
        <div class="row">
            <?php
            // Fetch related calculators from the database
            $sql = "SELECT calculator_name, slug FROM calculators_settings WHERE slug != ? LIMIT 9";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $result = $stmt->get_result();
            $relatedCalculators = [];
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $relatedCalculators[] = $row;
                }
            }

            // Split related calculators into 3 columns
            $chunks = array_chunk($relatedCalculators, ceil(count($relatedCalculators) / 3));
            
            foreach ($chunks as $chunk) {
                echo '<div class="col-lg-4"><ul>';
                foreach ($chunk as $calculator) {
                    echo '<li><a href="'.$domainwithhttps.'/calculator/' . htmlspecialchars($calculator['slug']) . '">' . htmlspecialchars($calculator['calculator_name']) . '</a></li>';
                }
                echo '</ul></div>';
            }
            ?>
        </div>
    </main>
</div>

<?php include 'front/footer.php'; ?>
