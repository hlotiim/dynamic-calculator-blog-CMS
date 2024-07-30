<?php
function slugify($text) {
    // Replace non-letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // Transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // Trim
    $text = trim($text, '-');

    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // Lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calculator_name = $_POST['calculator_name'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $calculator_html = $_POST['calculator_html'];
    $calculator_javascript = $_POST['calculator_javascript'];
    $article_title = $_POST['article_title'];
    $article_content = $_POST['article_content'];
    $slug = slugify($calculator_name);

    $sql = "UPDATE calculators_settings SET calculator_name = ?, meta_title = ?, meta_description = ?, calculator_html = ?, calculator_javascript = ?, article_title = ?, article_content = ?, slug = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $calculator_name, $meta_title, $meta_description, $calculator_html, $calculator_javascript, $article_title, $article_content, $slug, $_GET['id']);
    $stmt->execute();
    header("Location: dashboard.php?tab=calculator");
    exit();
}

$sql = "SELECT * FROM calculators_settings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$calculator = $result->fetch_assoc();
?>

<form method="post">
    <div class="form-group">
        <label for="calculator_name">Calculator Name:</label>
        <input type="text" class="form-control" id="calculator_name" name="calculator_name" value="<?php echo $calculator['calculator_name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="meta_title">Meta Title:</label>
        <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo $calculator['meta_title']; ?>" required>
    </div>
    <div class="form-group">
        <label for="meta_description">Meta Description:</label>
        <textarea class="form-control" id="meta_description" name="meta_description" required><?php echo $calculator['meta_description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="calculator_html">Calculator HTML:</label>
        <textarea class="form-control" id="calculator_html" name="calculator_html" required><?php echo $calculator['calculator_html']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="calculator_javascript">Calculator JavaScript:</label>
        <textarea class="form-control" id="calculator_javascript" name="calculator_javascript" required><?php echo $calculator['calculator_javascript']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="article_title">Article Title:</label>
        <input type="text" class="form-control" id="article_title" name="article_title" value="<?php echo $calculator['article_title']; ?>" required>
    </div>
    <div class="form-group">
        <label for="article_content">Article Content:</label>
        <textarea class="form-control" id="article_content" name="article_content" required><?php echo $calculator['article_content']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Calculator</button>
</form>
