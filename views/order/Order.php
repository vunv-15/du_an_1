<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';

// Lấy thông tin giỏ hàng từ session
$cartItems = $_SESSION['cart'] ?? [];
$totalAmount = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cartItems));
$orderId = uniqid("order_", true);

// Biến lưu lỗi
$errors = [];
$isSubmitted = false; // Xác định trạng thái form chưa được gửi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isSubmitted = true;

    $recipientName = trim($_POST['recipient_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $note = trim($_POST['note'] ?? '');
    $paymentMethod = $_POST['payment_method'] ?? '';

    // Validate các trường
    if (empty($recipientName)) {
        $errors['recipient_name'] = 'Tên người nhận không được để trống.';
    }
    if (empty($phone) || !preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors['phone'] = 'Số điện thoại phải là số từ 10 đến 15 chữ số.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ.';
    }
    if (empty($address)) {
        $errors['address'] = 'Địa chỉ không được để trống.';
    }
    if (empty($paymentMethod) || !in_array($paymentMethod, ['1', '2'])) {
        $errors['payment_method'] = 'Phương thức thanh toán không hợp lệ.';
    }

    // Nếu không có lỗi, điều hướng đến trang thành công
    if (empty($errors)) {
        header("Location: index.php?act=orderSuccess");
        exit;
    }
}
?>


<style>
    /* Cải thiện modal */
    #confirmationModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        max-width: 600px;
        width: 90%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-content h2 {
        margin-bottom: 20px;
    }

    .modal-content p {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .modal-content button {
        padding: 10px 20px;
        margin: 10px 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        border-radius: 5px;
    }

    .modal-content button:hover {
        background-color: #45a049;
    }

    /* Cải thiện form */
    .container1 {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    label {
        font-size: 16px;
        margin-bottom: 8px;
        display: block;
        color: #555;
    }

    .name,.sdt, .email, textarea, select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .name,.sdt,:focus,.email:focus, textarea:focus, select:focus {
        border-color: #4CAF50;
        outline: none;
    }

    textarea {
        height: 100px;
        resize: none;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    button:hover {
        background-color: #45a049;
    }

    .cart-summary {
        background-color: #f8f8f8;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .cart-summary ul {
        list-style: none;
        padding: 0;
    }

    .cart-summary ul li {
        margin-bottom: 10px;
    }

    .cart-summary p {
        font-weight: bold;
    }

    .cart-summary p span {
        color: red;
    }

    .error-message {
        color: red;
        font-weight: bold;
        text-align: center;
        margin-bottom: 15px;
    }
    .error{
        color: red;
       font-size: 15px;
       margin-bottom: 10px;
    }
</style>

<div class="container1">
    <h1>Nhập thông tin đặt hàng</h1>

    <!-- Hiển thị lỗi nếu có -->
    <?php if (isset($error_message)): ?>
        <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    

    <form id="orderForm" action="index.php?act=checkout" method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="order_id" value="<?= htmlspecialchars($orderId) ?>">

        <!-- Tên người nhận -->
        <div>
            <label for="recipient_name">Tên người nhận:</label>
            <input class="name" type="text" id="recipient_name" name="recipient_name" 
                   placeholder="Nhập tên người nhận" 
                   onblur="validateField('recipient_name', 'recipientNameError')"
                   oninput="validateField('recipient_name', 'recipientNameError')">
            <p class="error" id="recipientNameError" style="display: none;">Tên người nhận không được để trống.</p>
        </div>

      <!-- Số điện thoại -->
<div>
    <label for="phone">Số điện thoại:</label>
    <input class="sdt" type="text" id="phone" name="phone" 
           placeholder="Nhập số điện thoại" 
           onblur="validatePhone()" 
           oninput="validatePhone()">
    <p class="error" id="phoneEmptyError" style="display: none;">Số điện thoại không được để trống.</p>
    <p class="error" id="phoneInvalidError" style="display: none;">Số điện thoại phải từ 10 đến 15 chữ số.</p>
</div>

<!-- Email -->
<div>
    <label for="email">Email người nhận:</label>
    <input class="email" type="email" id="email" name="email" 
           placeholder="Nhập email người nhận" 
           onblur="validateEmail()" 
           oninput="validateEmail()">
    <p class="error" id="emailEmptyError" style="display: none;">Email không được để trống.</p>
    <p class="error" id="emailInvalidError" style="display: none;">Email không hợp lệ.</p>
</div>

        <!-- Địa chỉ -->
        <div>
            <label for="address">Địa chỉ:</label>
            <textarea id="address" name="address" 
                      placeholder="Nhập địa chỉ giao hàng" 
                      onblur="validateField('address', 'addressError')"
                      oninput="validateField('address', 'addressError')"></textarea>
            <p class="error" id="addressError" style="display: none;">Địa chỉ không được để trống.</p>
        </div>

        <!-- Ghi chú -->
        <div>
            <label for="note">Ghi chú:</label>
            <textarea id="note" name="note" placeholder="Nhập ghi chú đơn hàng"></textarea>
        </div>

        <!-- Phương thức thanh toán -->
        <div>
            <label for="payment_method">Phương thức thanh toán:</label>
            <select id="payment_method" name="payment_method">
                <option value="1">Thanh toán trực tiếp</option>
                <option value="2">Thanh toán qua VNPay</option>
            </select>
        </div>

        <!-- Giỏ hàng -->
        <div class="cart-summary" style="font-size: 30px;">
            <h2>Thông tin giỏ hàng</h2>
            <ul>
                <?php foreach ($cartItems as $item): ?>
                    <li><?= htmlspecialchars($item['name']) ?> x<?= $item['quantity'] ?> x <?= number_format($item['price'], 0, ',', '.') ?> đ</li>
                <?php endforeach; ?>
            </ul>
            <p><strong>Tổng cộng:</strong> <?= number_format($totalAmount, 0, ',', '.') ?> đ</p>
        </div>

        <!-- Nút Xác nhận -->
        <button type="submit" id="confirmOrderBtn" <?= empty($cartItems) ? 'disabled' : '' ?>>Xác nhận đặt hàng</button>
    </form>
</div>

</div>

<!-- Modal xác nhận -->
<div id="confirmationModal">
    <div class="modal-content">
        <h2>Xác nhận thông tin đơn hàng</h2>
        <div id="orderDetails"></div>
        <button id="confirmSubmitBtn">Xác nhận</button>
        <button id="cancelBtn">Hủy</button>
    </div>
</div>

<script>
// Kiểm tra trường văn bản chung
function validateField(fieldId, errorId) {
    const field = document.getElementById(fieldId);
    const error = document.getElementById(errorId);

    if (field.value.trim() === '') {
        error.style.display = 'block';
        return false;
    } else {
        error.style.display = 'none';
        return true;
    }
}

function validatePhone() {
    const phone = document.getElementById('phone');
    const phoneEmptyError = document.getElementById('phoneEmptyError');
    const phoneInvalidError = document.getElementById('phoneInvalidError');
    const phoneRegex = /^[0-9]{10,15}$/;

    // Kiểm tra nếu để trống
    if (phone.value.trim() === '') {
        phoneEmptyError.style.display = 'block';
        phoneInvalidError.style.display = 'none';
        return false;
    } else {
        phoneEmptyError.style.display = 'none';
    }

    // Kiểm tra định dạng hợp lệ
    if (!phoneRegex.test(phone.value.trim())) {
        phoneInvalidError.style.display = 'block';
        return false;
    } else {
        phoneInvalidError.style.display = 'none';
    }

    return true;
}
function validateEmail() {
    const email = document.getElementById('email');
    const emailEmptyError = document.getElementById('emailEmptyError');
    const emailInvalidError = document.getElementById('emailInvalidError');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Kiểm tra nếu để trống
    if (email.value.trim() === '') {
        emailEmptyError.style.display = 'block';
        emailInvalidError.style.display = 'none';
        return false;
    } else {
        emailEmptyError.style.display = 'none';
    }

    // Kiểm tra định dạng hợp lệ
    if (!emailRegex.test(email.value.trim())) {
        emailInvalidError.style.display = 'block';
        return false;
    } else {
        emailInvalidError.style.display = 'none';
    }

    return true;
}

function validateForm() {
    const isNameValid = validateField('recipient_name', 'recipientNameEmptyError');
    const isPhoneValid = validatePhone();
    const isEmailValid = validateEmail();
    const isAddressValid = validateField('address', 'addressEmptyError');

    return isNameValid && isPhoneValid && isEmailValid && isAddressValid;
}
document.getElementById('confirmOrderBtn').addEventListener('click', function(event) {
    // Ngăn chặn form gửi đi ngay lập tức
    event.preventDefault();

    // Lấy dữ liệu từ form
    const recipientName = document.getElementById('recipient_name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();
    const address = document.getElementById('address').value.trim();
    const paymentMethod = document.getElementById('payment_method').value;
    const totalAmount = <?= $totalAmount ?>;
    const orderId = "<?= $orderId ?>";  // Lấy order_id từ PHP

    // Kiểm tra tính hợp lệ của dữ liệu đầu vào
    if (!recipientName || !phone || !email || !address) {
        return;
    }

    // Hiển thị modal xác nhận
    let orderDetails = ` 
        <p><strong>Tên người nhận:</strong> ${recipientName}</p>
        <p><strong>Số điện thoại:</strong> ${phone}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Địa chỉ:</strong> ${address}</p>
        <p><strong>Phương thức thanh toán:</strong> ${paymentMethod == 1 ? 'Tiền mặt' : 'Chuyển khoản'}</p>
        <p><strong>Tổng cộng:</strong> ${totalAmount.toLocaleString()}đ</p>
    `;
    document.getElementById('orderDetails').innerHTML = orderDetails;
    document.getElementById('confirmationModal').style.display = 'flex';
});

// Khi nhấn "Xác nhận" trong modal, gửi form
document.getElementById('confirmSubmitBtn').addEventListener('click', function() {
    // Thêm order_id vào form khi người dùng nhấn "Xác nhận"
    const orderForm = document.getElementById('orderForm');
    const orderIdInput = document.createElement('input');
    orderIdInput.type = 'hidden';
    orderIdInput.name = 'order_id';
    orderIdInput.value = "<?= $orderId ?>";  // Lấy order_id từ PHP

    orderForm.appendChild(orderIdInput);  // Thêm vào form

    // Submit form
    orderForm.submit();
});

// Khi nhấn "Hủy" trong modal, đóng modal
document.getElementById('cancelBtn').addEventListener('click', function() {
    document.getElementById('confirmationModal').style.display = 'none';
});

// Đóng modal khi click vào ngoài modal
window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('confirmationModal')) {
        document.getElementById('confirmationModal').style.display = 'none';
    }
});
</script>

<?php 
require_once './views/layout/footer.php';
?>