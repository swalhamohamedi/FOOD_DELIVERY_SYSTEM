<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery Tanzania - Chakula Nyumbani</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h1>🍕 FOOD DELIVERY TANZANIA</h1>
        <p>Chakula kitamu nyumbani kwako | Delivery bure</p>
    </div>
    
    <div class="container">
        <div class="menu-section">
            <div class="menu-grid">
                <?php
                $menu = [
                    1 => ['name' => 'Wali Na Maharage', 'price' => 1500, 'icon' => '🍚'],
                    2 => ['name' => 'Ugali Na Dagaa', 'price' => 1000, 'icon' => '🍚'],
                    3 => ['name' => 'Nyama Choma', 'price' => 2000, 'icon' => '🥩'],
                    4 => ['name' => 'Biriyani', 'price' => 8000, 'icon' => '🍛'],
                    5 => ['name' => 'Pilau', 'price' => 3000, 'icon' => '🍚'],
                    6 => ['name' => 'Samaki Wa Kukaanga', 'price' => 2000, 'icon' => '🐟'],
                    7 => ['name' => 'Chai Na Mandazi', 'price' => 1000, 'icon' => '☕'],
                    8 => ['name' => 'Chipsi Mayai', 'price' => 3000, 'icon' => '🍟'],
                    9 => ['name' => 'Vitumbua', 'price' => 3000, 'icon' => '🥞'],
                    10 => ['name' => 'Mshikaki', 'price' => 1000, 'icon' => '🍢'],
                    11 => ['name' => 'Zenzero', 'price' => 1000, 'icon' => '🥤'],
                    12 => ['name' => 'Maji Safi', 'price' => 1000, 'icon' => '💧']
                ];
                
                foreach ($menu as $id => $item) {
                    echo "
                    <div class='food-item'>
                        <div class='food-icon'>{$item['icon']}</div>
                        <div class='food-name'>{$item['name']}</div>
                        <div class='food-price'>TZS " . number_format($item['price'], 0) . "</div>
                        <form method='POST' action=''>
                            <input type='hidden' name='add_to_cart' value='{$id}'>
                            <input type='hidden' name='item_name' value='{$item['name']}'>
                            <input type='hidden' name='item_price' value='{$item['price']}'>
                            <button type='submit' class='add-btn'>+ Ongeza Kwenye Order</button>
                        </form>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
        
        <div class="cart-section">
            <div class="cart-title">🛒 ORDER YAKO</div>
            <?php
            // Add to cart
            if (isset($_POST['add_to_cart'])) {
                $id = $_POST['add_to_cart'];
                $name = $_POST['item_name'];
                $price = $_POST['item_price'];
                
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity']++;
                } else {
                    $_SESSION['cart'][$id] = [
                        'name' => $name,
                        'price' => $price,
                        'quantity' => 1
                    ];
                }
                echo "<script>window.location.href='index.php';</script>";
            }
            
            // Remove from cart
            if (isset($_GET['remove'])) {
                $id = $_GET['remove'];
                unset($_SESSION['cart'][$id]);
                echo "<script>window.location.href='index.php';</script>";
            }
            
            if (empty($_SESSION['cart'])) {
                echo "<div class='empty-cart'>Hakuna chochoda. Ongeza chakula!</div>";
            } else {
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    echo "
                    <div class='cart-item'>
                        <div class='cart-item-info'>
                            <h4>{$item['name']}</h4>
                            <p>{$item['quantity']} x TZS " . number_format($item['price'], 0) . " = TZS " . number_format($subtotal, 0) . "</p>
                        </div>
                        <a href='?remove={$id}' class='remove-btn'>Ondoa</a>
                    </div>
                    ";
                }
                echo "
                <div class='cart-total'>
                    JUMLA: TZS " . number_format($total, 0) . "
                </div>
                <form method='POST' action='order.php'>
                    <input type='hidden' name='total' value='{$total}'>
                    <button type='submit' class='checkout-btn'>✅ Agiza Sasa</button>
                </form>
                ";
            }
            ?>
        </div>
    </div>
</body>
</html>