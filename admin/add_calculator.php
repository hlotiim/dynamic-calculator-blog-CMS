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

    $sql = "INSERT INTO calculators_settings (calculator_name, meta_title, meta_description, calculator_html, calculator_javascript, article_title, article_content, slug) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $calculator_name, $meta_title, $meta_description, $calculator_html, $calculator_javascript, $article_title, $article_content, $slug);
    $stmt->execute();
    header("Location: dashboard.php?tab=calculator");
    exit();
}
?>

<form method="post">
    <div class="form-group">
        <label for="calculator_name">Calculator Name:</label>
        <input type="text" class="form-control" id="calculator_name" name="calculator_name" required>
    </div>
    <div class="form-group">
        <label for="meta_title">Meta Title:</label>
        <input type="text" class="form-control" id="meta_title" name="meta_title" required>
    </div>
    <div class="form-group">
        <label for="meta_description">Meta Description:</label>
        <textarea class="form-control" id="meta_description" name="meta_description" required></textarea>
    </div>
    <div class="form-group">
        <label for="calculator_html">Calculator HTML:</label>
        <textarea class="form-control" id="calculator_html" name="calculator_html" required></textarea>
    </div>
    <div class="form-group">
        <label for="calculator_javascript">Calculator JavaScript:</label>
        <textarea class="form-control" id="calculator_javascript" name="calculator_javascript" required></textarea>
    </div>
    <div class="form-group">
        <label for="article_title">Article Title:</label>
        <input type="text" class="form-control" id="article_title" name="article_title" required>
    </div>
    <div class="form-group">
        <label for="article_content">Article Content:</label>
        <textarea class="form-control" id="article_content" name="article_content" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Calculator</button>
</form>
