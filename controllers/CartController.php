<?php
require_once './models/CartModel.php';
require_once './models/ProductModel.php';

class CartController {
    private $cartModel;
    private $productModel;

    public function __construct($dbConnection) {
        $this->cartModel = new CartModel($dbConnection); // Sửa lỗi truyền tham số
        $this->productModel = new ProductModel($dbConnection);
    }

    // Hiển thị giỏ hàng
    public function viewCart() {
        try {
            $cartItems = $this->cartModel->getCartItems();
            $totalAmount = $this->cartModel->getTotalAmount();
            $uniqueProductCount = count($cartItems); // Số lượng sản phẩm độc nhất
            require './views/cart.php';
        } catch (Exception $e) {
            file_put_contents('./logs/error.log', date('Y-m-d H:i:s') . ' - Lỗi hiển thị giỏ hàng: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
            echo "Không thể hiển thị giỏ hàng.";
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart() {
        try {
            $productId = $_GET['id'] ?? null;
            $quantity = max((int)($_POST['quantity'] ?? 1), 1); // Đảm bảo số lượng tối thiểu là 1

            // Kiểm tra dữ liệu đầu vào
            if (!is_numeric($productId) || $quantity <= 0) {
                throw new Exception("Thông tin sản phẩm không hợp lệ.");
            }

            $product = $this->productModel->getProductById($productId);
            if (!$product) {
                throw new Exception("Sản phẩm không tồn tại.");
            }

            // Thêm sản phẩm vào giỏ
            $this->cartModel->addToCart(
                $product['id'],
                $product['ten_sach'],
                $product['gia_sach'],
                $quantity,
                $product['hinh_anh'] ?? 'images/default.jpg'
            );

            header("Location: index.php?act=viewCart");
            exit();
        } catch (Exception $e) {
            file_put_contents('./logs/error.log', date('Y-m-d H:i:s') . ' - Lỗi thêm sản phẩm vào giỏ: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
            echo "Không thể thêm sản phẩm vào giỏ hàng.";
        }
    }

    public function updateCart() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $productId = $data['product_id'] ?? null;
            $quantity = $data['quantity'] ?? null;
    
            // Kiểm tra dữ liệu đầu vào
            if (!is_numeric($productId) || !is_numeric($quantity) || $quantity <= 0) {
                throw new Exception("Dữ liệu không hợp lệ.");
            }
    
            // Cập nhật số lượng sản phẩm trong giỏ
            $success = $this->cartModel->setProductQuantity($productId, (int)$quantity);
            if (!$success) {
                throw new Exception("Không thể cập nhật số lượng sản phẩm.");
            }
    
            // Lấy thông tin giỏ hàng sau khi cập nhật
            $cartItems = $this->cartModel->getCartItems();
    
            // Tính lại giá từng sản phẩm và tổng tiền giỏ hàng
            $itemTotal = isset($cartItems[$productId])
                ? $cartItems[$productId]['price'] * $cartItems[$productId]['quantity']
                : 0;
    
            $totalAmount = $this->cartModel->getTotalAmount();
    
            // Trả kết quả về dạng JSON
            echo json_encode([
                'success' => true,
                'itemTotal' => number_format($itemTotal, 0, ',', '.') . 'đ',
                'totalAmount' => number_format($totalAmount, 0, ',', '.') . 'đ',
            ]);
        } catch (Exception $e) {
            file_put_contents('./logs/error.log', date('Y-m-d H:i:s') . ' - Lỗi cập nhật giỏ hàng: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    

    // Xóa sản phẩm khỏi giỏ
    public function removeFromCart() {
        try {
            $productId = $_GET['id'] ?? null;

            // Kiểm tra dữ liệu đầu vào
            if (!is_numeric($productId)) {
                throw new Exception("ID sản phẩm không hợp lệ.");
            }

            $this->cartModel->removeFromCart((int)$productId);
            header("Location: index.php?act=viewCart");
            exit();
        } catch (Exception $e) {
            file_put_contents('./logs/error.log', date('Y-m-d H:i:s') . ' - Lỗi xóa sản phẩm khỏi giỏ: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
            echo "Không thể xóa sản phẩm khỏi giỏ hàng.";
        }
    }
}
