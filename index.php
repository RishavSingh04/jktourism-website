<?php
require_once "db.php";
$books = $conn->query("SELECT b.*, c.name AS category_name FROM books b LEFT JOIN categories c ON b.category_id=c.id ORDER BY b.id DESC LIMIT 8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fakir Chand Book Store</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navbar">
  <a class="logo" href="index.php">📚 Fakir Chand</a>
  <nav>
    <a class="active" href="index.php">Home</a>
    <a href="books.php">Books</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="cart.php">Cart</a>
  </nav>
</header>

<section class="hero">
  <div class="hero-content">
    <p class="eyebrow">EST. 1985 • NEIGHBOURHOOD BOOKSTORE</p>
    <h1>Find your next<br><span>great read.</span></h1>
    <p>Explore curated titles across computer science, engineering, competitive exams, fiction, and foundational learning.</p>
    <form action="books.php" method="get" class="search">
      <input name="q" placeholder="Search by title, author, or category...">
      <button type="submit">Search</button>
    </form>
  </div>
</section>

<section class="section">
  <div class="section-head">
    <div>
      <p class="eyebrow">EXPLORE</p>
      <h2>Shop by Category</h2>
    </div>
    <a class="link-btn" href="books.php">View all →</a>
  </div>
  <div class="categories">
    <?php $cats=$conn->query("SELECT * FROM categories ORDER BY name"); while($c=$cats->fetch_assoc()): ?>
    <a class="category" href="books.php?category=<?= (int)$c['id'] ?>">
      <span class="cat-icon"><?= htmlspecialchars($c['icon']) ?></span>
      <b><?= htmlspecialchars($c['name']) ?></b>
    </a>
    <?php endwhile; ?>
  </div>
</section>

<section class="section">
  <div class="section-head">
    <div>
      <p class="eyebrow">COLLECTION</p>
      <h2>Popular Books</h2>
    </div>
    <a class="link-btn" href="books.php">See collection →</a>
  </div>

  <div class="grid">
    <?php while($b = $books->fetch_assoc()): 
      $has_img = !empty($b['image_url']) && strpos($b['image_url'], 'http') === 0;
    ?>
    <article class="book-card">
      <div class="cover-wrapper">
        <?php if($has_img): ?>
          <img src="<?= htmlspecialchars($b['image_url']) ?>" alt="<?= htmlspecialchars($b['title']) ?>" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
          <div class="svg-cover-fallback" style="display:none;">
            <div class="book-spine"></div>
            <span class="fallback-emoji"><?= htmlspecialchars($b['emoji'] ?? '📖') ?></span>
            <div class="fallback-title"><?= htmlspecialchars($b['title']) ?></div>
          </div>
        <?php else: ?>
          <div class="svg-cover-fallback">
            <div class="book-spine"></div>
            <span class="fallback-emoji"><?= htmlspecialchars($b['emoji'] ?? '📖') ?></span>
            <div class="fallback-title"><?= htmlspecialchars($b['title']) ?></div>
          </div>
        <?php endif; ?>
      </div>
      <div class="book-info">
        <small><?= htmlspecialchars($b['category_name'] ?? 'General') ?></small>
        <h3><?= htmlspecialchars($b['title']) ?></h3>
        <p><?= htmlspecialchars($b['author']) ?></p>
        <div class="card-footer">
          <strong>₹<?= number_format($b['price'], 2) ?></strong>
          <a class="mini-btn" href="cart.php?add=<?= (int)$b['id'] ?>">Add to cart</a>
        </div>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
</section>

<footer>
  <b>📚 Fakir Chand Book Store</b>
  <p>© <?= date('Y') ?> Your neighbourhood destination for books of every kind.</p>
</footer>

</body>
</html>