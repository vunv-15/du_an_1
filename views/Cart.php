<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
$isLoggedIn = isset($_SESSION['user_client']) && !empty($_SESSION['user_client']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['act'] === 'updateCart') {
    $input = json_decode(file_get_contents('php://input'), true);
    $productId = $input['product_id'] ?? 0;
    $quantity = $input['quantity'] ?? 1;

    if (isset($_SESSION['cart'][$productId])) {
        // Cập nhật số lượng sản phẩm
        $_SESSION['cart'][$productId]['quantity'] = $quantity;

        // Tính lại giá tiền cho sản phẩm
        $itemTotal = $_SESSION['cart'][$productId]['quantity'] * $_SESSION['cart'][$productId]['price'];

        // Tính tổng tiền giỏ hàng
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $_SESSION['cart']));

        // Trả về kết quả
        echo json_encode([
            'success' => true,
            'itemTotal' => number_format($itemTotal, 0, ',', '.') . 'đ',
            'totalAmount' => number_format($totalAmount, 0, ',', '.') . 'đ'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
    }
    exit;
}
?>
<button onclick="topFunction()" id="myBtn-scroll" title="Go to top"><i class="fas fa-chevron-down"></i></button>

<!-- cart -->
<section class="cart">
    <div class="container">
        <!-- Header của giỏ hàng -->
        <article class="row cart__head pc">
            <nav class="menu__nav col-lg-3 col-md-12 col-sm-0">
                <ul class="menu__list">
                    <li class="menu__item menu__item--active">
                        <a href="#" class="menu__link">
                            <img src="images1/item/baby-boy.png" alt="Sách Tiếng Việt" class="menu__item-icon">
                            Sách Tiếng Việt
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="menu__link">
                            <img src="images1/item/translation.png" alt="Sách nước ngoài" class="menu__item-icon">
                            Sách nước ngoài
                        </a>
                    </li>
                    <li class="menu__item">
                        <a href="#" class="menu__link">
                            <img src="images1/item/1380754_batman_comic_hero_superhero_icon.png" alt="Manga - Comic" class="menu__item-icon">
                            Manga - Comic
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="col-6 cart__head-name">Thông tin sản phẩm</div>
            <div class="col-3 cart__head-quantity">Số lượng</div>
            <div class="col-3 cart__head-price">Đơn giá</div>
        </article>

        <!-- Sản phẩm trong giỏ -->
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $item): ?>
                <article class="row cart__body">
                    <div class="col-6 cart__body-name">
                        <div class="cart__body-name-img">
                            <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($item['id']); ?>">
                            <img src="<?= htmlspecialchars($item['image'] ?? 'images/default.jpg') ?>" 
                                 alt="<?= htmlspecialchars($item['name'] ?? 'No Name') ?>" 
                                 onerror="this.src='images/default.jpg'">
                                 </a>
                        </div>
                        <a href="index.php?act=showProductDetail&id=<?= htmlspecialchars($item['id']); ?>" class="cart__body-name-title">
                            <?= htmlspecialchars($item['name'] ?? 'No Name') ?>
                        </a>
                    </div>
                    <div class="col-3 cart__body-quantity">
                        <input type="button" value="-" class="cart__body-quantity-minus" data-product-id="<?= $item['id'] ?>">
                        <input type="number" step="1" min="1" max="999" value="<?= $item['quantity'] ?>" 
                               class="cart__body-quantity-total" data-product-id="<?= $item['id'] ?>">
                        <input type="button" value="+" class="cart__body-quantity-plus" data-product-id="<?= $item['id'] ?>">
                    </div>
                    <div class="col-3 cart__body-price">
                    <span id="item-total-<?= $item['id'] ?>">
    <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
</span>
                        <a href="index.php?act=removeFromCart&id=<?= $item['id'] ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                    </div>
                    <div id="deleteModal" class="modal">
    <div class="modal-content">
        <p>Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?</p>
        <button id="confirmDelete" class="btn-confirm">Xóa</button>
        <button id="cancelDelete" class="btn-cancel">Hủy</button>
    </div>
</div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="cart-empty-message" style="font-size:20px;text-align:center;margin-top: 20px;">Giỏ hàng của bạn đang trống.</p>
            <div style="text-align:center;margin-bottom: 20px;" >
            <a href="index.php?act=productByCategory" class="btn btn-success" style="font-size:10px;">Xem sản phẩm</a>

            <a href="index.php" class="btn btn-primary " style="font-size:10px;">Quay lại trang chủ</a>
            </div>
        <?php endif; ?>

        <!-- Footer của giỏ hàng -->
        <article class="row cart__foot">
            <div class="col-6 col-lg-6 col-sm-6 cart__foot-update">
                
            </div>
            <p class="col-3 col-lg-3 col-sm-3 cart__foot-total">Tổng cộng:</p>
            <span id="cart-total" class="col-3 col-lg-3 col-sm-3 cart__foot-price">
                <?= number_format($totalAmount, 0, ',', '.') ?>đ
            </span>
            
            <div class="cart__checkout">
    <form action="index.php?act=order" method="POST">
        <?php foreach ($cartItems as $item): ?>
            <input type="hidden" name="cartItems[]" value='<?= json_encode([
                'id' => $item['id'] ?? 0,
                'name' => $item['name'] ?? 'Tên sản phẩm không xác định',
                'image' => $item['image'] ?? 'images/default.jpg',
                'quantity' => $item['quantity'] ?? 0, // Sử dụng 'quantity' thay cho 'so_luong'
                'price' => $item['price'] ?? 0, // Thêm thông tin giá nếu cần
            ], JSON_UNESCAPED_UNICODE) ?>'>
        <?php endforeach; ?>
        <input type="hidden" name="totalAmount" value="<?= $totalAmount ?>">
<!-- Nút thanh toán -->
<button type="button" id="btnCheckout" class="cart__foot-price-btn">Thanh toán</button>    </form>
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Bạn cần phải đăng nhập để có thể thanh toán.</p>
    </div>
</div>
</div>
</section>

<?php
require_once './views/layout/footer.php';
?>
<style>
    .cart {
    min-height: calc(100vh - 300px); /* Đặt chiều cao tối thiểu để lấp đầy màn hình */
    
}
    .modal {
    display: none; /* Ẩn modal mặc định */
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-content p {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 10px;
}

.modal-content .close {
    color: #aaa;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.modal-content .close:hover,
.modal-content .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
<script>
        const isLoggedIn = <?= json_encode($isLoggedIn); ?>;

        document.addEventListener("DOMContentLoaded", function () {
    const checkoutButton = document.getElementById("btnCheckout");
    const modal = document.getElementById("loginModal");
    const closeModal = document.querySelector(".close");

    checkoutButton.addEventListener("click", function () {
        if (!isLoggedIn) { // Sử dụng biến `isLoggedIn` được truyền từ PHP
            modal.style.display = "block"; // Hiển thị modal nếu chưa đăng nhập
        } else {
            // Thực hiện thanh toán
            window.location.href = "index.php?act=order";
        }
    });

    // Đóng modal khi nhấn vào nút close
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Đóng modal khi nhấn ra ngoài modal
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const cartContainer = document.querySelector(".cart");

    cartContainer.addEventListener("click", function (event) {
        const target = event.target;

        // Xử lý nút tăng số lượng
        if (target.matches(".cart__body-quantity-plus")) {
            const inputField = target.previousElementSibling;
            const productId = target.getAttribute("data-product-id");

            let currentValue = parseInt(inputField.value) || 0;
            if (currentValue < 999) {
                currentValue += 1;
                inputField.value = currentValue; // Cập nhật giá trị trong input
                updateQuantity(productId, currentValue);
            }
        }

        // Xử lý nút giảm số lượng
        if (target.matches(".cart__body-quantity-minus")) {
            const inputField = target.nextElementSibling;
            const productId = target.getAttribute("data-product-id");

            let currentValue = parseInt(inputField.value) || 1;
            if (currentValue > 1) {
                currentValue -= 1;
                inputField.value = currentValue; // Cập nhật giá trị trong input
                updateQuantity(productId, currentValue);
            }
        }
    });

    const updateQuantity = (productId, quantity) => {
        fetch("index.php?act=updateCart", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ product_id: productId, quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật giá sản phẩm
                const itemTotalElement = document.querySelector(`#item-total-${productId}`);
                if (itemTotalElement) {
                    itemTotalElement.innerText = data.itemTotal; // Cập nhật giá tiền từng sản phẩm
                }

                // Cập nhật tổng tiền
                const cartTotalElement = document.querySelector("#cart-total");
                if (cartTotalElement) {
                    cartTotalElement.innerText = data.totalAmount; // Cập nhật tổng tiền
                }
            } else {
                alert("Không thể cập nhật số lượng: " + data.message);
            }
        })
        .catch(error => {
            console.error("Lỗi:", error);
        });
    };
});

</script>
