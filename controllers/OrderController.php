<?php
require_once './models/OrderModel.php';

class OrderController {
    private $db;
    private $orderModel;

    public function __construct($db) {
        $this->db = $db;
        $this->orderModel = new OrderModel($db);
    }

    // Hiển thị form nhập thông tin đặt hàng
    public function orderForm() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra nếu giỏ hàng trống
        if (empty($_SESSION['cart'])) {
            echo "Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi đặt hàng.";
            return;
        }

        include './views/order/Order.php';
    }

    // Xử lý thanh toán và đặt hàng
    public function checkout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Lấy thông tin từ form
        $recipientName = trim($_POST['recipient_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $orderNote = trim($_POST['note'] ?? '');
        $paymentMethodId = $_POST['payment_method'] ?? 1; // Mặc định thanh toán COD
        $userId = $_SESSION['user_client']['id'] ?? null;
    
        // Kiểm tra tính hợp lệ của dữ liệu
        if (!$userId || !$recipientName || !$email || !$phone || !$address) {
            $error_message = "Vui lòng nhập đầy đủ thông tin.";
            include './views/order/Order.php';
            return;
        }
    
        // Kiểm tra giỏ hàng
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            $error_message = "Giỏ hàng trống. Vui lòng thêm sản phẩm trước khi đặt hàng.";
            include './views/order/Order.php';
            return;
        }
    
        // Tính tổng tiền
        $totalAmount = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        if ($totalAmount <= 0) {
            $error_message = "Tổng tiền không hợp lệ.";
            include './views/order/Order.php';
            return;
        }
    
        try {
            // Tạo đơn hàng
            $orderId = $this->orderModel->createOrder($totalAmount, 1, $paymentMethodId, $userId, $recipientName, $email, $phone, $address, $orderNote);
    
            // Thêm chi tiết đơn hàng
            foreach ($cart as $item) {
                if (!isset($item['id'], $item['price'], $item['quantity'])) {
                    throw new Exception("Dữ liệu sản phẩm không hợp lệ.");
                }
                $this->orderModel->addOrderDetails($orderId, $item['id'], $item['quantity'], $item['price']);
            }
    
            // Xóa giỏ hàng sau khi thanh toán thành công
            unset($_SESSION['cart']);
    
            // Xử lý thanh toán
            if ($paymentMethodId == 2) { // Thanh toán VNPay
                $this->createVNPayPaymentRequest($orderId, $totalAmount, $recipientName, $email, $phone, $address, $orderNote);
                return; // Dừng tại đây vì đã chuyển hướng đến VNPay
            }
    
            // Thanh toán COD (mặc định)
            header("Location: index.php?act=orderSuccess");
            exit();
        } catch (Exception $e) {
            $error_message = "Lỗi khi xử lý đơn hàng: " . $e->getMessage();
            include './views/order/Order.php';
        }
    }
    
    



    public function createVNPayPaymentRequest($orderId, $totalAmount, $recipientName, $email, $phone, $address, $orderNote) {
        $vnp_TmnCode = "31DQ0GI0";  
        $vnp_HashSecret = "W4J1L035O98GIOWPIJUIUDL7D61VFXC5"; 
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";  
        $vnp_Returnurl = "http://localhost/project/DUAN-NHOM10/index.php?act=orderSuccess";

        $vnp_TxnRef = $orderId;
        $vnp_OrderInfo = $_POST['order_desc'] ?? 'No description provided';
        $vnp_OrderType = $_POST['order_type'] ?? 'other';
        $vnp_Amount = $totalAmount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        $vnp_Url .= "?" . $hashdata . "&vnp_SecureHash=" . $vnpSecureHash;

        header('Location: ' . $vnp_Url);
        die();
    }

    public function orderSuccess() {
        include './views/order/OrderSuccess.php'; 
    }
}
