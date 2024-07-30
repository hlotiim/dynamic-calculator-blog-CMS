<?php include 'front/header.php';?>




<main class="container mt-4">
    <h1>Popular Calculators</h1>
    <div class="row">
        <?php
        // Fetch calculators from the database
        $sql = "SELECT calculator_name, slug FROM calculators_settings";
        $result = $conn->query($sql);
        $calculators = [];
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $calculators[] = $row;
            }
        }
        
        // Split calculators into 3 columns
        $chunks = array_chunk($calculators, ceil(count($calculators) / 3));
        
        foreach ($chunks as $chunk) {
            echo '<div class="col-lg-4"><ul>';
            foreach ($chunk as $calculator) {
               echo '<li><a href="' . $domainwithhttps . '/calculator/' . htmlspecialchars($calculator['slug']) . '">' . htmlspecialchars($calculator['calculator_name']) . '</a></li>';
}
            echo '</ul></div>';
        }
        ?>
    </div>
</main>





<?php include 'front/footer.php';?>