<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
?>
<style>
    .order-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
}

.order-info {
    margin-bottom: 20px;
}

.order-info .info-row {
    display: flex;
    justify-content: space-between;
    font-size: 20px;
    font-weight: bold;
}

.order-status {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
    align-items: center;
}

.order-status .status-step {
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
}

.order-status .status-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #fff;
    margin-bottom: 5px;
}

.order-status .status-step.active .status-circle {
    background-color: #3498db;
}

.order-status .status-step span {
    font-size: 12px;
    color: #333;
}

.order-products {
    margin: 20px 0;
}

.order-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.order-item img {
    width: 80px;
    height: 100px;
    object-fit: cover;
    margin-right: 20px;
}

.order-item .info h4 {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
}

.order-item .info .price-quantity {
    color: #3498db;
    font-size: 14px;
    margin-top: 5px;
}

.order-details table {
    width: 100%;
    border-collapse: collapse;
}

.order-details table th, .order-details table td {
    padding: 10px;
    font-size: 15px;
    border-bottom: 1px solid #ddd;
}

.order-details table th {
    background-color: #f9f9f9;
    font-weight: bold;
    text-align: left;
}

.order-details table .total {
    color: #e74c3c;
    font-weight: bold;
}


.progress-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 20px 0;
    position: relative;
}
.progress-container span{
    font-size: 15px;
    font-weight: bold;
}
.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
}

.progress-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: white;
    z-index: 1;
}

.progress-circle i {
    font-size: 16px;
}

.progress-step.active .progress-circle {
    background-color: #3498db;
}

.progress-step.active span {
    font-weight: bold;
    color: #3498db;
}

.progress-line {
    flex-grow: 1;
    height: 5px;
    background-color: #ddd;
    position: relative;
    top: 17px;
    z-index: 0;
}

.progress-line.active {
    background-color: #3498db;
}
.btn-back {
    display: inline-block;
    margin: 20px auto;
    padding: 12px 25px;
    background-color: #3498db; /* Màu xanh */
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin-left: 330px;
    text-decoration: none;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    
}

.btn-back:hover {
    background-color: #2980b9; /* Màu xanh đậm hơn khi hover */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    text-decoration: none;

}




</style>
<div class="order-container">
    <h2>Đơn đặt hàng của tôi</h2>

    <!-- Thông tin đơn hàng -->
    <div class="order-info">
        <div class="info-row">
            <span>Thời gian đặt hàng: <?= htmlspecialchars($orderDetails['ngay_dat'] ?? 'Không rõ') ?></span>
            <span>Trạng thái: <?= htmlspecialchars($orderDetails['ten_trang_thai'] ?? 'Không rõ') ?></span>
        </div>
    </div>

    <!-- Tiến trình giao hàng -->
    <div class="progress-container">
    <div class="progress-step <?= $orderDetails['trang_thai_id'] >= 1 ? 'active' : '' ?>">
        <div class="progress-circle"><i class="fas fa-check"></i></div>
        <span>Đã xác nhận</span>
    </div>
    <div class="progress-line <?= $orderDetails['trang_thai_id'] >= 2 ? 'active' : '' ?>"></div>
    <div class="progress-step <?= $orderDetails['trang_thai_id'] >= 2 ? 'active' : '' ?>">
        <div class="progress-circle"><i class="fas fa-truck"></i></div>
        <span>Đang giao hàng</span>
    </div>
    <div class="progress-line <?= $orderDetails['trang_thai_id'] >= 3 ? 'active' : '' ?>"></div>
    <div class="progress-step <?= $orderDetails['trang_thai_id'] == 3 ? 'active' : '' ?>">
        <div class="progress-circle"><i class="fas fa-check"></i></div>
        <span>Giao thành công</span>
    </div>
</div>

    <!-- Sản phẩm trong đơn hàng -->
    <div class="order-products">
        <?php foreach ($orderDetails['san_pham'] as $product) { ?>
            <div class="order-item">
                <img src="<?= htmlspecialchars($product['hinh_anh']) ?>" alt="Hình ảnh sản phẩm">
                <div class="info">
                    <h4><?= htmlspecialchars($product['ten_sach']) ?></h4>
                    <div class="price-quantity">
                        <?= number_format($product['don_gia'], 0, ',', '.') ?>đ × <?= $product['so_luong'] ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Bảng thông tin chi tiết -->
    <div class="order-details">
        <table>
            
            <tr>
                <th>Họ và tên</th>
                <td><?= htmlspecialchars($orderDetails['ten_nguoi_nhan'] ?? 'Không rõ') ?></td>
            </tr>
            <tr>
                <th>Địa chỉ giao hàng</th>
                <td><?= htmlspecialchars($orderDetails['dia_chi_nguoi_nhan'] ?? 'Không rõ') ?></td>
            </tr>
            <tr>
                <th>Tổng tiền hàng</th>
                <td><?= number_format($orderDetails['tong_tien_hang'], 0, ',', '.') ?>đ</td>
            </tr>
            <tr>
                <th>Ghi chú</th>
                <td><?= htmlspecialchars($orderDetails['ghi_chu'] ?? '') ?></td>
            </tr>
            <tr>
                <th>Thành tiền</th>
                <td class="total"><?= number_format($orderDetails['tong_tien'], 0, ',', '.') ?>đ</td>
            </tr>
        </table>
    </div>
<a href="javascript:history.back()" class="btn-back">Quay lại</a>

</div>



<?php require_once './views/layout/footer.php'; ?>
