<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_name = $_POST['site_name'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $logo_path = $_FILES['logo_path']['name'];
    $favicon_path = $_FILES['favicon_path']['name'];

    move_uploaded_file($_FILES['logo_path']['tmp_name'], '../uploads/' . $logo_path);
    move_uploaded_file($_FILES['favicon_path']['tmp_name'], '../uploads/' . $favicon_path);

    // Save settings to the database
    $sql = "UPDATE general_settings SET site_name = ?, meta_title = ?, meta_description = ?, logo_path = ?, favicon_path = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $site_name, $meta_title, $meta_description, $logo_path, $favicon_path);
    $stmt->execute();
}

// Fetch settings from the database
$sql = "SELECT * FROM general_settings WHERE id = 1";
$result = $conn->query($sql);
$settings = $result->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="site_name">Site Name:</label>
        <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo $settings['site_name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="meta_title">Meta Title:</label>
        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo $settings['meta_title']; ?>" required>
    </div>
    <div class="form-group">
        <label for="meta_description">Meta Description:</label>
        <textarea class="form-control" id="meta_description" name="meta_description" required><?php echo $settings['meta_description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="logo_path">Logo:</label>
        <input type="file" class="form-control-file" id="logo_path" name="logo_path">
        <?php if ($settings['logo_path']) { ?>
            <img src="../uploads/<?php echo $settings['logo_path']; ?>" alt="Logo" style="max-width: 100px; margin-top: 10px;">
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="favicon_path">Favicon:</label>
        <input type="file" class="form-control-file" id="favicon_path" name="favicon_path">
        <?php if ($settings['favicon_path']) { ?>
            <img src="../uploads/<?php echo $settings['favicon_path']; ?>" alt="Favicon" style="max-width: 50px; margin-top: 10px;">
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Save Settings</button>
</form>
