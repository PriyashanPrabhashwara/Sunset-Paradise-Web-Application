<?php
$category='';
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=form_db', 'root', '');

// Get category from URL, if set
if(isset($_GET['category'])){
    $category =$_GET['category'];
}


// Fetch blog posts based on category or all posts if no category is set
if ($category) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE category = :category AND status = 'published' ORDER BY post_date DESC");
    $stmt->execute(['category' => $category]);
} else {
    $stmt = $pdo->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY post_date DESC");
}

// Display blog posts
$posts = $stmt->fetchAll();
if ($posts) {
    foreach ($posts as $post) {
        echo '
        <div class="post">
            <img src="' . $post['image_url'] . '" alt="' . $post['title'] . '">
            <h2>' . $post['title'] . '</h2>
            <p>' . $post['short_description'] . '</p>
            <a href="blog-post.php?id=' . $post['id'] . '" class="read-more">Read More</a>
        </div>';
    }
} else {
    echo '<p>No posts found in this category.</p>';
}
?>
