<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
// Lấy thông tin giỏ hàng từ session
$cartItems = $_SESSION['cart'] ?? [];
$totalAmount = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cartItems));
$orderId = uniqid("order_", true);

?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    h1 {
        text-align: center;
        color: #007bff;
        margin-top: 20px;
    }

    .order-container {
        max-width: 900px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #ddd;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        background-color: #f1f1f1;
        border-bottom: 1px solid #ddd;
    }

    .order-header .status {
        color: #e74c3c;
        font-weight: bold;
    }

    .order-header .time {
        color: #3498db;
        font-weight: bold;
    }

    .order-item {
        display: flex;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .order-item img {
        width: 80px;
        height: 100px;
        object-fit: cover;
        margin-right: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .order-item .info {
        flex-grow: 1;
    }

    .order-item .info h4 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .order-header {
        font-size: 20px;

    }

    .order-item .info .price {
        margin: 5px 0;
        font-size: 16px;
        color: #e74c3c;
    }

    .order-item .info .quantity {
        font-size: 14px;
        color: #555;
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        background-color: #f9f9f9;
    }

    .order-footer .total {
        font-size: 16px;
        font-weight: bold;
        color: #e74c3c;
    }

    .order-footer .btn-detail {
        padding: 5px 10px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-back {
        display: block;
        width: fit-content;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #7f8c8d;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
    }

    .btn-back:hover {
        background-color: #95a5a6;
    }

    .price-quantity {
        font-size: 14px;
      
        font-weight: bold;
        display: inline-block;
        line-height: 1.2;
    }

    .price-quantity .quantity {
        margin-left: 5px;
    }
</style>
</head>

<body>
    <h1>Lịch sử đặt hàng</h1>
<?php if (!empty($orderDetails)) { ?>
    <?php 
    // Nhóm các sản phẩm theo đơn hàng ID
    $ordersGrouped = [];
    foreach ($orderDetails as $order) {
        $ordersGrouped[$order['don_hang_id']][] = $order;
    }
    ?>
    
    <?php foreach ($ordersGrouped as $orderId => $products) { ?>
        <div class="order-container">
            <!-- Header của đơn hàng -->
            <div class="order-header">
                <span class="status">
                    Trạng thái: <?= isset($products[0]['ten_trang_thai']) ? htmlspecialchars($products[0]['ten_trang_thai']) : 'Không rõ' ?>
                </span>
                <span class="time">
                    Thời gian: <?= isset($products[0]['ngay_dat']) ? htmlspecialchars($products[0]['ngay_dat']) : 'Không rõ' ?>
                </span>
            </div>

            <!-- Hiển thị các sản phẩm thuộc đơn hàng -->
            <?php foreach ($products as $product) { ?>
                <div class="order-item">
                <img src="<?= isset($product['hinh_anh_san_pham']) ? htmlspecialchars($product['hinh_anh_san_pham']) : 'default.png' ?>" alt="Hình ảnh sản phẩm" style="width: 80px; height: 100px; object-fit: cover; margin-right: 10px; border: 1px solid #ddd; border-radius: 4px;">

                    <div class="info">
                        <h4><?= isset($product['ten_san_pham']) ? htmlspecialchars($product['ten_san_pham']) : 'Không rõ' ?></h4>
                        <div class="price-quantity">
                            <span class="price"><?= isset($product['don_gia']) ? number_format($product['don_gia'], 0, ',', '.') : '0' ?>đ</span>
                            &times;<span class="quantity"><?= isset($product['so_luong']) ? htmlspecialchars($product['so_luong']) : '0' ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Footer của đơn hàng -->
            <div class="order-footer">
                <span class="total">
                    Thành tiền: <?= isset($products[0]['tong_tien']) ? number_format($products[0]['tong_tien'], 0, ',', '.') : '0' ?>đ
                </span>
                <a href="?act=orderDetails&order_id=<?= $orderId ?>" class="btn-detail">Xem chi tiết</a>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <p style="text-align: center; color: #666; font-size:20px;">Bạn chưa có đơn hàng nào trong lịch sử.</p>
<?php } ?>


    <a href="javascript:history.back()" class="btn-back" style="font-size:15px;">Trở lại</a>

    <?php
    require_once './views/layout/footer.php';
    ?>