<?php
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    include 'edit_calculator.php';
} elseif (isset($_GET['action']) && $_GET['action'] == 'add') {
    include 'add_calculator.php';
} else {
    // Fetch all calculators from the database
    $sql = "SELECT * FROM calculators_settings";
    $result = $conn->query($sql);
    ?>
    <a href="dashboard.php?tab=calculator&action=add" class="btn btn-primary mb-3">Add New Calculator</a>
    <div class="row">
        <?php while ($calculator = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $calculator['calculator_name']; ?></h5>
                        <p class="card-text"><?php echo $calculator['meta_description']; ?></p>
                        <a href="dashboard.php?tab=calculator&action=edit&id=<?php echo $calculator['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_calculator.php?id=<?php echo $calculator['id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
}
?>
