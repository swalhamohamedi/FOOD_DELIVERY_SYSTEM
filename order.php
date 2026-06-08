<?php
session_start();

if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];
    $total = $_POST['total'];
    
    // Create order data
    $order = [
        'id' => time(),
        'customer' => [
            'name' => $customer_name,
            'phone' => $customer_phone,
            'address' => $customer_address
        ],
        'items' => $_SESSION['cart'],
        'total' => $total,
        'status' => 'pending',
        'order_date' => date('Y-m-d H:i:s')
    ];
    
    // Save to JSON file
    $orders_file = 'orders.json';
    $orders = [];
    
    if (file_exists($orders_file)) {
        $orders = json_decode(file_get_contents($orders_file), true);
    }
    
    $orders[] = $order;
    file_put_contents($orders_file, json_encode($orders, JSON_PRETTY_PRINT));
    
    // Clear cart
    $_SESSION['cart'] = [];
    
    // Show success message
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maliza Order - Food Delivery</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <?php if (isset($success)): ?>
            <div class="success-message">
                <h3>ORDER YAKO IMETUMWA SUCCESSFULLY!</h3>
                <p><strong>Order #<?php echo $order['id']; ?></strong></p>
                <p>Utapokea simu kwa uthibitisho. Asante kwa kununua!</p>
            </div>
            <a href="index.php" class="back-btn" style="display: block; text-align: center; margin-top: 15px;">← Rudi Kwenye Menu</a>
        <?php else: ?>
            <h2>Kamilisha Order Yako</h2>
            
            <div class="order-summary">
                <strong>Jumla ya Order: TZS <?php echo number_format($_POST['total'], 0); ?></strong>
            </div>
            
            <form method="POST">
                <input type="hidden" name="total" value="<?php echo $_POST['total']; ?>">
                <input type="hidden" name="submit_order" value="1">
                
                <div class="form-group">
                    <label>Jina Lako Kamili *</label>
                    <input type="text" name="customer_name" required>
                </div>
                
                <div class="form-group">
                    <label>Namba ya Simu *</label>
                    <input type="tel" name="customer_phone" required>
                </div>
                
                <div class="form-group">
                    <label>Anuani Kamili (Tunaweza kupelekea wapi?) *</label>
                    <textarea name="customer_address" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Thibitisha Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>