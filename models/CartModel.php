<?php

class CartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->initializeCart(); // Đảm bảo giỏ hàng được khởi tạo
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart($productId, $productName, $price, $quantity, $image = 'images/default.jpg') {
        // Kiểm tra tính hợp lệ của số lượng
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Số lượng sản phẩm phải lớn hơn 0.");
        }

        if (isset($_SESSION['cart'][$productId])) {
            // Tăng số lượng nếu sản phẩm đã tồn tại trong giỏ
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            // Thêm sản phẩm mới vào giỏ
            $_SESSION['cart'][$productId] = $this->createItem($productId, $productName, $price, $quantity, $image);
        }

        $this->updateCartMetrics(); // Cập nhật tổng số lượng và số sản phẩm
    }

    // Lấy danh sách đơn hàng theo ID người dùng
    public function getOrdersByUserId($userId) {
        try {
            $sql = "SELECT * FROM don_hangs WHERE tai_khoan_id = :user_id ORDER BY ngay_dat DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi truy vấn đơn hàng: " . $e->getMessage());
        }
    }

    // Lấy tất cả sản phẩm trong giỏ hàng
    public function getCartItems() {
        return $_SESSION['cart'] ?? [];
    }

    // Tính tổng tiền giỏ hàng
    public function getTotalAmount() {
        return array_reduce($_SESSION['cart'] ?? [], function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    // Đếm số lượng sản phẩm độc nhất
    public function getUniqueProductCount() {
        return count($_SESSION['cart'] ?? []);
    }

    // Cập nhật số lượng sản phẩm trong giỏ
    public function updateProductQuantity($productId, $change) {
        if (isset($_SESSION['cart'][$productId])) {
            $newQuantity = $_SESSION['cart'][$productId]['quantity'] + $change;

            // Kiểm tra số lượng mới
            if ($newQuantity > 0) {
                $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
            } else {
                $_SESSION['cart'][$productId]['quantity'] = 1; // Đảm bảo không nhỏ hơn 1
            }

            $this->updateCartMetrics();
            return true;
        }
        return false;
    }

    // Xóa sản phẩm khỏi giỏ
    public function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
            $this->updateCartMetrics(); // Cập nhật lại giỏ hàng
        }
    }

    // Thêm sản phẩm vào giỏ từ database
    public function addProductToCartFromDB($productId, $quantity) {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Số lượng phải lớn hơn 0.");
        }

        $productModel = new ProductModel($this->db);
        $product = $productModel->getProductById($productId);

        if ($product) {
            $this->addToCart(
                $product['id'],
                $product['ten_sach'],
                $product['gia_sach'],
                $quantity,
                $product['hinh_anh'] ?? 'images/default.jpg'
            );
        } else {
            throw new Exception("Sản phẩm không tồn tại.");
        }
    }

    // Khởi tạo giỏ hàng nếu chưa có
    private function initializeCart() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Tạo một sản phẩm trong giỏ hàng
    private function createItem($id, $name, $price, $quantity, $image) {
        return [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $image
        ];
    }
    public function setProductQuantity($productId, $quantity) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
            return true;
        }
        return false;
    }
    
   
    // Cập nhật số lượng và tổng tiền trong giỏ hàng
    private function updateCartMetrics() {
        $_SESSION['cart_total_quantity'] = array_sum(array_column($_SESSION['cart'], 'quantity') ?? []);
        $_SESSION['cart_unique_count'] = count($_SESSION['cart'] ?? []);
    }
}
