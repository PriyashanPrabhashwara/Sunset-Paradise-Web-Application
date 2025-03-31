<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=form_db', 'root', '');

// Get the post ID from the URL
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the selected blog post
$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = :id AND status = 'published'");
$stmt->execute(['id' => $post_id]);
$post = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $post['title']; ?> - FitZone Blog</title>
    <link rel="stylesheet" href="blog.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- Blog Post Content -->
    <section class="blog-post-content">
        <h1><?= $post['title']; ?></h1>
        <p style="color:beige"><strong>Posted by:</strong> <?= $post['author']; ?> on <?= date('F j, Y', strtotime($post['post_date'])); ?></p>
        <img src="<?= $post['image_url']; ?>" alt="<?= $post['title']; ?>">
        <div class="content">
            <?= nl2br($post['content']); ?>
        </div>
    </section>

</body>
</html>
