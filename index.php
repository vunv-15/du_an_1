<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './controllers/SearchController.php'; 
require_once './controllers/CartController.php'; 
require_once './controllers/OrderController.php';

// Require toàn bộ file Models
require_once './models/TaiKhoan.php';
require_once './models/SanPham.php';
require_once './models/ProductModel.php'; 
require_once './models/CartModel.php';    
require_once './models/OrderModel.php';  

//
// Kết nối cơ sở dữ liệu
$dbConnection = connectDB();
if (!$dbConnection) {
    die("Không thể kết nối đến cơ sở dữ liệu.");
}

// Sử dụng match để route các chức năng
$act = $_GET['act'] ?? '/';

// Danh sách route
$routes = [
    '/' => [HomeController::class, 'home'],
    'post' => [HomeController::class, 'post'],
    'contact' => [HomeController::class, 'contact'],
    // '/' => (new HomeController())->home(),
    'showProductDetail' => [ProductController::class, 'showProductDetail'],
    'productList' => [ProductController::class, 'showProductList'],
    'productByCategory' => [ProductController::class, 'showProductsByCategory'],
    'search' => [SearchController::class, 'handleSearch'],
    'addToCart' => [CartController::class, 'addToCart'],
    'viewCart' => [CartController::class, 'viewCart'],
    'updateCart' => function () use ($dbConnection) {
        header('Content-Type: application/json');
        (new CartController($dbConnection))->updateCart();
    },
    'removeFromCart' => [CartController::class, 'removeFromCart'],

    // Thêm route mới cho đặt hàng và thanh toán
    'checkout' => [OrderController::class, 'checkout'], // Xử lý thanh toán
    'confirmOrder' => [OrderController::class, 'confirmOrder'], // Xác nhận đơn hàng
    'placeOrder' => [OrderController::class, 'placeOrder'],
    'order' => [OrderController::class, 'orderForm'],
    'orderSuccess' => [OrderController::class, 'orderSuccess'],
    // Lịch sử đơn hàng
    'orderHistory' => [HomeController::class, 'viewOrderHistory'],
    'orderDetails' => [HomeController::class, 'orderDetails'],
    'checkoutFromDetail' => [HomeController::class, 'checkoutFromDetail'],
    
    // auth
    // login
    'login' => [HomeController::class, 'formLogin'],
    'check-login' => [HomeController::class, 'postLogin'],
    'logout' => [HomeController::class, 'logout'],
    // đăng ký
    'register' => [HomeController::class, 'formRegister'],
    'them-tai-khoan' => [HomeController::class, 'postAddUser'],

    // Profile 
    'form-sua-khach-hang' => [HomeController::class, 'formEditKhachHang'],
    'sua-khach-hang' => [HomeController::class, 'postEditKhachHang'],
    'chi-tiet-khach-hang' => [HomeController::class, 'deltailKhachHang'],

    // Bình luận
    'addComment' => [ProductController::class, 'addComment'], // Thêm bình luận cho sản phẩm
    'showComments' => [ProductController::class, 'showProductDetail'], // Hiển thị bình luận khi xem chi tiết sản phẩm

];
// Kiểm tra và xử lý route
try {
    if (isset($routes[$act])) {
        $handler = $routes[$act];

        if (is_callable($handler)) {
            $handler(); // Gọi route dạng hàm
        } else {
            [$class, $method] = $handler;
            if (class_exists($class) && method_exists($class, $method)) {
                (new $class($dbConnection))->$method(); // Gọi route dạng class/method
            } else {
                throw new Exception("Controller hoặc method không tồn tại: {$class}::{$method}");
            }
        }
    } else {
        http_response_code(404);
        include './404error.php';
    }
} catch (Exception $e) {
    http_response_code(500);
    if (getenv('APP_ENV') === 'development') {
        echo "Đã xảy ra lỗi: " . htmlspecialchars($e->getMessage());
    } else {
        echo "Lỗi hệ thống. Vui lòng thử lại sau.";
        error_log($e->getMessage());
    }
}
