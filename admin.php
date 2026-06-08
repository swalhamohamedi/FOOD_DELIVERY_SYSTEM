<?php
$orders_file = 'orders.json';
$orders = [];

if (file_exists($orders_file)) {
    $orders = json_decode(file_get_contents($orders_file), true);
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Food Delivery Orders</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>ADMIN PANEL - FOOD DELIVERY ORDERS</h1>
        </div>
        
        <button class="refresh-btn" onclick="location.reload()">Refresh Orders</button>
        
        <?php if (empty($orders)): ?>
            <div class="empty-cart">
                <h3>Hakuna orders bado</h3>
                <p>Orders zitaonekana hapa baada ya wateja kuagiza</p>
            </div>
        <?php else: ?>
            <?php foreach(array_reverse($orders) as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <span class="order-id">Order #<?php echo $order['id']; ?></span>
                        <span class="status <?php echo $order['status']; ?>">
                            <?php 
                            $status_text = [
                                'pending' => 'Inasubiri',
                                'confirmed' => 'Imethibitishwa',
                                'delivered' => 'Imewasilishwa'
                            ];
                            echo $status_text[$order['status']];
                            ?>
                        </span>
                    </div>
                    
                    <div class="customer-info">
                        <p><strong>Mteja:</strong> <?php echo $order['customer']['name']; ?></p>
                        <p><strong>Simu:</strong> <?php echo $order['customer']['phone']; ?></p>
                        <p><strong>Anuani:</strong> <?php echo $order['customer']['address']; ?></p>
                        <p><strong>Muda:</strong> <?php echo $order['order_date']; ?></p>
                    </div>
                    
                    <div class="items-list">
                        <strong>Chakula Kilichoagizwa:</strong>
                        <?php foreach($order['items'] as $item): ?>
                            <div class="item">
                                <span><?php echo $item['name']; ?> x <?php echo $item['quantity']; ?></span>
                                <span>TZS <?php echo number_format($item['price'] * $item['quantity'], 0); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="total">
                        JUMLA: TZS <?php echo number_format($order['total'], 0); ?>
                    </div>
                    
                    <?php if ($order['status'] == 'pending'): ?>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <input type="hidden" name="action" value="confirm">
                            <button type="submit" class="update-btn">Thibitisha Order</button>
                        </form>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <input type="hidden" name="action" value="deliver">
                            <button type="submit" class="update-btn">Wasilisha</button>
                        </form>
                    <?php elseif ($order['status'] == 'confirmed'): ?>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <input type="hidden" name="action" value="deliver">
                            <button type="submit" class="update-btn">Wasilisha</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Handle status updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];
    
    $orders = json_decode(file_get_contents('orders.json'), true);
    
    foreach ($orders as &$order) {
        if 
        ($order['id'] == $order_id) {
            if ($action == 'confirm') {
                $order['status'] = 'confirmed';
            } elseif ($action == 'deliver') {
                $order['status'] = 'delivered';
            }
            break;
        }
    }
    
    file_put_contents('orders.json', json_encode($orders, JSON_PRETTY_PRINT));
    echo "<script>window.location.href='admin.php';</script>";
}
?>