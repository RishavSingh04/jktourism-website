<?php
session_start(); require_once "db.php";
if(isset($_GET['add'])){ $id=(int)$_GET['add']; $_SESSION['cart'][$id]=($_SESSION['cart'][$id]??0)+1; header("Location:cart.php"); exit; }
if(isset($_GET['remove'])){unset($_SESSION['cart'][(int)$_GET['remove']]); header("Location:cart.php");exit;}
$cart=$_SESSION['cart']??[]; $items=[]; $total=0;
if($cart){$ids=implode(',',array_map('intval',array_keys($cart)));$r=$conn->query("SELECT * FROM books WHERE id IN ($ids)");while($b=$r->fetch_assoc()){$b['qty']=$cart[$b['id']];$b['subtotal']=$b['qty']*$b['price'];$total+=$b['subtotal'];$items[]=$b;}}
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Cart | Fakir Chand</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navbar">
  <a class="logo" href="index.php">📚 Fakir Chand</a>
  <nav>
    <a href="index.php">Home</a>
    <a href="books.php">Books</a>
    <a href="cart.php" class="active">Cart</a>
  </nav>
</header>
<main class="section page">
  <p class="eyebrow">YOUR CART</p>
  <h1>Shopping cart</h1>
  <?php if(!$items):?>
    <div class="empty">Your cart is empty. <a href="books.php">Browse books →</a></div>
  <?php else: ?>
    <div class="cart">
      <?php foreach($items as $i):?>
      <div class="cart-row">
        <div class="cart-cover">
          <img src="<?=htmlspecialchars($i['image_url'] ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=500&auto=format&fit=crop&q=80')?>" alt="<?=htmlspecialchars($i['title'])?>">
        </div>
        <div>
          <h3><?=htmlspecialchars($i['title'])?></h3>
          <p><?=htmlspecialchars($i['author'])?> · Qty <?=$i['qty']?></p>
        </div>
        <strong>₹<?=number_format($i['subtotal'],2)?></strong>
        <a href="cart.php?remove=<?=$i['id']?>" style="color:#ef4444;text-decoration:none;">Remove</a>
      </div>
      <?php endforeach;?>
      <div class="total" style="display:flex;justify-content:space-between;padding:1.5rem 0;font-size:1.25rem;">
        <b>Total</b>
        <b>₹<?=number_format($total,2)?></b>
      </div>
      <a class="btn" href="register.php">Proceed to checkout</a>
    </div>
  <?php endif;?>
</main>
</body>
</html>