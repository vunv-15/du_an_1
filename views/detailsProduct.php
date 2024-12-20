<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
?>

<style>
    .product__main-info-cart-btn-wrap {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
        padding: 10px 0;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }

    .cart__body-quantity {
        display: flex;
        align-items: center;
        gap: 2px;
        /* Giảm khoảng cách giữa các nút */
    }

    .cart__body-quantity input[type="button"],
    .cart__body-quantity input[type="number"] {
        margin: 0;
        /* Đảm bảo không có margin thừa */
        padding: 0;
        /* Xóa khoảng cách bên trong nếu cần */
        width: 40px;
        /* Điều chỉnh kích thước để đồng đều */
        height: 30px;
        /* Chiều cao đồng đều */
        text-align: center;
        /* Căn giữa nội dung */
        border: 1px solid #ccc;
        /* Đường viền đơn giản */
        border-radius: 3px;
        /* Bo góc */
    }

    .cart__body-quantity input[type="number"] {
        width: 50px;
        /* Đặt chiều rộng lớn hơn một chút cho số */
    }

    .cart__body-quantity input[type="button"]:hover {
        background-color: #f0f0f0;
        /* Hiệu ứng hover */
    }

    .cart__body-quantity input[type="number"] {
        width: 60px;
        height: 30px;
        text-align: center;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .product__main-info-cart-btn {
        margin-top: 20px;

        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
</style>
<section class="product">
    <div class="container">
        <div class="row bg-white pt-4 pb-4 border-bt pc">


            <article class="product__main col-lg-9 col-md-12 col-sm-12">
                <div class="row">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="product__main-img col-lg-4 col-md-4 col-sm-12">
                        <div class="product__main-img-primary">
                            <img src="<?= htmlspecialchars($product['hinh_anh'] ?? 'images/default.jpg') ?>"
                                alt="<?= htmlspecialchars($product['ten_sach'] ?? 'Không có tên sản phẩm') ?>">
                        </div>
                    </div>

                    <!-- Thông tin sản phẩm -->
                    <div class="product__main-info col-lg-8 col-md-8 col-sm-12">
                        <div class="product__main-info-breadcrumb" style="font-size: 20px;">
                            <a href="index.php">Trang chủ</a> / <a href="index.php?act=productByCategory">Danh sách sản phẩm</a>/ <a href="index.php?act=productByCategory">Sản phẩm</a>
                        </div>

                        <h2 class="product__main-info-heading">
                            <?= htmlspecialchars($product['ten_sach'] ?? 'Tên sản phẩm không có') ?>
                        </h2>

                        <div class="product__main-info-price">
                            <span class="product__main-info-price-current">
                                <?= isset($product['gia_sach']) ? number_format($product['gia_sach'], 0, ',', '.') . 'đ' : 'Liên hệ' ?>
                            </span>
                        </div>

                        <div class="product__main-info-status" style="font-size: 30px;">
                            <strong>Trạng thái:</strong>
                            <span>
                                <?= $product['trang_thai'] == 1 ? 'Còn hàng' : 'Hết hàng'; ?>
                            </span>
                        </div>

                        <!-- Form thêm vào giỏ hàng -->
                        <div class="product__main-info-cart-btn-wrap">
                            <form method="post" action="index.php?act=addToCart&id=<?= htmlspecialchars($product['id'] ?? 0) ?>"
                                onsubmit="ensureValidQuantity(<?= htmlspecialchars($product['id'] ?? 0) ?>)">
                                <label for="quantity-<?= htmlspecialchars($product['id'] ?? 0) ?>">
                                    <h2>Số lượng:</h2>
                                </label>
                                <div class="cart__body-quantity">
                                    <!-- Nút giảm số lượng -->
                                    <input type="button" value="-" class="cart__body-quantity-minus"
                                        onclick="updateQuantity(<?= htmlspecialchars($product['id'] ?? 0) ?>, false)">
                                    <!-- Input nhập số lượng -->
                                    <input type="number" step="1" min="1" max="999" name="quantity"
                                        id="quantity-<?= htmlspecialchars($product['id'] ?? 0) ?>"
                                        value="1" onchange="validateQuantity(<?= htmlspecialchars($product['id'] ?? 0) ?>)">
                                    <!-- Nút tăng số lượng -->
                                    <input type="button" value="+" class="cart__body-quantity-plus"
                                        onclick="updateQuantity(<?= htmlspecialchars($product['id'] ?? 0) ?>, true)">
                                </div>
                                <button type="submit" class="product__main-info-cart-btn">Thêm vào giỏ hàng</button>

                        </div>

                        <div class="product__main-info-contact">
                            <a href="#" class="product__main-info-contact-fb">
                                <i class="fab fa-facebook-f"></i> Chat Facebook
                            </a>
                            <div class="product__main-info-contact-phone-wrap">
                                <div class="product__main-info-contact-phone-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="product__main-info-contact-phone">
                                    <div class="product__main-info-contact-phone-title">Gọi điện tư vấn</div>
                                    <div class="product__main-info-contact-phone-number">(0352.860.701)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Mô tả & Đánh giá -->
                <div class="row bg-white">
                    <div class="col-12 product__main-tab">
                        <a href="#" class="product__main-tab-link product__main-tab-link--active">Mô tả</a>
                        <a href="#" class="product__main-tab-link">Đánh giá</a>
                    </div>

                    <div class="col-12 product__main-content-wrap">
                        <!-- Mô tả sản phẩm -->
                        <div class="product__main-info-description">
                            <?= nl2br(htmlspecialchars($product['mo_ta'] ?? 'Không có mô tả.')) ?>
                        </div>

                        <!-- Thông tin chi tiết -->
                        <h2 class="thongtin"><span>Thông tin chi tiết</span></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Công ty phát hành</th>
                                        <td><?= htmlspecialchars($product['nha_xuat_ban'] ?? 'Không có thông tin') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ngày xuất bản</th>
                                        <td><?= htmlspecialchars($product['ngay_xuat_ban'] ?? 'Không có thông tin') ?></td>
                                    </tr>
                                    <tr>
                                        <th>Số trang</th>
                                        <td><?= htmlspecialchars($product['so_trang'] ?? 'Không có thông tin') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </article>

            <script>
                // Đồng bộ số lượng trước khi thanh toán
                function prepareCheckout(productId) {
                    // Lấy giá trị từ ô nhập số lượng
                    const quantityInput = document.getElementById('quantity-' + productId);
                    const checkoutQuantityInput = document.getElementById('checkout-quantity');

                    // Đồng bộ giá trị số lượng
                    checkoutQuantityInput.value = quantityInput.value;

                    // Gửi form thanh toán
                    document.getElementById('checkoutForm').submit();
                }

                // Hàm cập nhật số lượng khi nhấn tăng/giảm
                function updateQuantity(productId, increase) {
                    const quantityInput = document.getElementById('quantity-' + productId);
                    let currentQuantity = parseInt(quantityInput.value) || 1;

                    // Tăng hoặc giảm số lượng
                    if (increase) {
                        quantityInput.value = currentQuantity + 1;
                    } else if (currentQuantity > 1) {
                        quantityInput.value = currentQuantity - 1;
                    }
                }

                // Hàm kiểm tra số lượng khi nhập trực tiếp
                function validateQuantity(productId) {
                    const quantityInput = document.getElementById('quantity-' + productId);
                    let quantity = parseInt(quantityInput.value);

                    // Đảm bảo giá trị hợp lệ
                    if (quantity < 1 || isNaN(quantity)) {
                        quantityInput.value = 1;
                    }
                }

                function ensureValidQuantity(productId) {
                    let quantityInput = document.getElementById('quantity-' + productId);
                    if (parseInt(quantityInput.value) < 1 || isNaN(quantityInput.value)) {
                        quantityInput.value = 1;
                    }
                }
            </script>


            <aside class="product__aside col-lg-3 col-md-0 col-sm-0">
                <div class="product__aside-top">
                    <div class="product__aside-top-item">
                        <div class="product__aside-top-item-text">
                            <p>
                                Giao hàng nhanh chóng
                            </p>
                            <span>
                                Chỉ trong vòng 24h
                            </span>
                        </div>
                    </div>
                    <div class="product__aside-top-item">
                        <div class="product__aside-top-item-text">
                            <p>
                                Sản phẩm chính hãng
                            </p>
                            <span>
                                Sản phẩm nhập khẩu 100%
                            </span>
                        </div>
                    </div>
                    <div class="product__aside-top-item">
                        <div class="product__aside-top-item-text">
                            <p>
                                Mua hàng tiết kiệm
                            </p>
                            <span>
                                Rẻ hơn từ 10% đến 30%
                            </span>
                        </div>
                    </div>
                </div>

                <div class="product__aside-bottom">
                    <h3 class="product__aside-heading">
                        Có thể bạn thích
                    </h3>

                    <div class="product__aside-list">
                        <?php if (!empty($suggestedProducts)): ?>
                            <?php foreach ($suggestedProducts as $suggestedProduct): ?>
                                <div class="product__aside-item product__aside-item--border">
                                    <div class="product__aside-img-wrap">
                                        <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($suggestedProduct['id']) ?>"> <img src="<?= htmlspecialchars($suggestedProduct['hinh_anh']) ?>" class="product__aside-img" alt="<?= htmlspecialchars($suggestedProduct['ten_sach']) ?>"></a>
                                    </div>
                                    <div class="product__aside-title">
                                        <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($suggestedProduct['id']) ?>" class="product__aside-link">
                                            <?= htmlspecialchars($suggestedProduct['ten_sach']) ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có sản phẩm gợi ý nào.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>

        </div>

        <div class="customer-reviews row pb-4 pb-4  py-4 pb-4 py-4 py-4">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3>Bình luận sản phẩm</h3>
                <form id="formgroupcomment" method="post" action="index.php?act=submitComment">
                    <div class="form-group">
                        <label>Tên:</label>
                        <input name="comm_name" required type="text" id="form-name" class="form-control" form="formgroupcomment">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input name="comm_mail" required type="email" class="form-control" id="pwd" form="formgroupcomment">
                    </div>
                    <div class="form-group">
                        <label>Nội dung:</label>
                        <textarea name="comm_details" required rows="8" id="formcontent" class="form-control" form="formgroupcomment"></textarea>
                    </div>
                    <button type="submit" name="sbm" id="submitcomment" class="btn btn-primary" form="formgroupcomment">Gửi</button>
                </form>
            </div>
        </div>

        <div class="product-comment row pb-4 pb-4  py-4 pb-4 py-4 py-4">

        </div>
        <section class="product__love col-12 mt-4">
            <div class="row bg-white">
                <div class="col-lg-12 col-md-12 col-sm-12 product__love-title">
                    <h2 class="product__love-heading">Sản phẩm tương tự</h2>
                </div>
            </div>
            <div class="row bg-white">
                <?php if (!empty($relatedProducts)): ?>
                    <?php foreach ($relatedProducts as $relatedProduct): ?>
                        <div class="product__panel-item col-lg-3 col-md-4 col-sm-6">
                            <div class="product__panel-img-wrap">
                                <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($relatedProduct['id']) ?>"> <img src="<?= htmlspecialchars($relatedProduct['hinh_anh']) ?>" alt="" class="product__panel-img" style="width:130px;"></a>
                            </div>
                            <h3 class="product__panel-heading">
                                <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($relatedProduct['id']) ?>" class="product__panel-link">
                                    <?= htmlspecialchars($relatedProduct['ten_sach']) ?>
                                </a>
                            </h3>
                            <div class="product__panel-price" style="font-size: 20px; color: red;">
                                <?= number_format($relatedProduct['gia_sach'], 0, ',', '.') ?>đ
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h1 style="font-size:30px;margin-left:300px;">Không có sản phẩm tương tự nào.</h1>
                <?php endif; ?>
            </div>
        </section>
    </div>
</section>

<?php
require_once './views/layout/footer.php';
?>
</body>

</html>