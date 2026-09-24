<?php
require_once "db.php";
$q = trim($_GET['q'] ?? '');
$category = (int)($_GET['category'] ?? 0);
$sql="SELECT b.*, c.name category_name FROM books b LEFT JOIN categories c ON b.category_id=c.id WHERE 1";
$params=[]; $types="";
if($q!==""){ $sql.=" AND (b.title LIKE ? OR b.author LIKE ? OR c.name LIKE ?)"; $like="%$q%"; $params=[$like,$like,$like]; $types="sss"; }
if($category){ $sql.=" AND b.category_id=?"; $params[]=$category; $types.="i"; }
$sql.=" ORDER BY b.title";
$stmt=$conn->prepare($sql); if($params)$stmt->bind_param($types,...$params); $stmt->execute(); $books=$stmt->get_result();
$fallbackImg = "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80";
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Books | Fakir Chand</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navbar">
  <a class="logo" href="index.php">📚 Fakir Chand</a>
  <nav>
    <a href="index.php">Home</a>
    <a class="active" href="books.php">Books</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
    <a href="cart.php">Cart</a>
  </nav>
</header>

<section class="section page">
  <p class="eyebrow">BOOK CATALOGUE</p>
  <h1>All books</h1>
  <form class="search wide" method="get">
    <input name="q" value="<?=htmlspecialchars($q)?>" placeholder="Search by title, author or category">
    <button>Search</button>
  </form>

  <div class="grid">
    <?php while($b=$books->fetch_assoc()): 
      $img = !empty($b['image_url']) ? $b['image_url'] : $fallbackImg;
    ?>
    <article class="book-card">
      <div class="cover-wrapper">
        <img 
          src="<?= htmlspecialchars($img) ?>" 
          alt="<?= htmlspecialchars($b['title']) ?>" 
          loading="lazy"
          onerror="this.onerror=null; this.src='<?= $fallbackImg ?>';"
        >
      </div>
      <div class="book-info">
        <small><?=htmlspecialchars($b['category_name']??'General')?></small>
        <h3><?=htmlspecialchars($b['title'])?></h3>
        <p><?=htmlspecialchars($b['author'])?></p>
        <div class="card-footer">
          <strong>₹<?=number_format($b['price'],2)?></strong>
          <a class="mini-btn" href="cart.php?add=<?=$b['id']?>">Add to cart</a>
        </div>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
</section>

<footer>
  <p>© <?=date('Y')?> Fakir Chand Book Store</p>
</footer>
</body>
</html>