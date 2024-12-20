<?php
require_once './models/ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct($dbConnection) {
        $this->productModel = new ProductModel($dbConnection);
    }

    // Hiển thị danh sách sản phẩm
    public function showProductList() {
        $products = $this->productModel->getAllProducts();
        $categories = $this->productModel->getAllCategories();
        require_once './views/listProduct.php'; // Gọi view để hiển thị sản phẩm
    }

    // Hiển thị sản phẩm theo danh mục
    public function showProductsByCategory() {
        try {
            $categoryId = $_GET['danh_muc_id'] ?? null;
            $currentPage = $_GET['page'] ?? 1;
            $perPage = 9;
            $offset = ($currentPage - 1) * $perPage;
    
            $categories = $this->productModel->getAllCategories();
    
            if ($categoryId) {
                $productsData = $this->productModel->getProductsByCategoryWithPagination($categoryId, $offset, $perPage);
            } else {
                $productsData = $this->productModel->getAllProductsWithPagination($offset, $perPage);
            }
    
            $products = $productsData['products'];
            $totalProducts = $productsData['total'];
            $totalPages = ceil($totalProducts / $perPage);
    
            require_once './views/listProduct.php';
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function showCategoryHome() {
        try {
            // Lấy danh mục ID từ URL
            $categoryId = $_GET['danh_muc_id'] ?? null;
    
            // Xử lý phân trang
            $currentPage = $_GET['page'] ?? 1;
            $perPage = 9;
            $offset = ($currentPage - 1) * $perPage;
    
            // Lấy danh sách danh mục
            $categories = $this->productModel->getAllCategories();
    
            // Lấy sản phẩm theo danh mục hoặc tất cả sản phẩm
            if ($categoryId) {
                $productsData = $this->productModel->getProductsByCategoryWithPagination($categoryId, $offset, $perPage);
            } else {
                $productsData = $this->productModel->getAllProductsWithPagination($offset, $perPage);
            }
    
            $products = $productsData['products'];
            $totalProducts = $productsData['total'];
            $totalPages = ceil($totalProducts / $perPage);
    
            // Truyền thông tin danh mục đang hoạt động (active category)
            $activeCategory = $categoryId ? $this->productModel->getCategoryNameById($categoryId) : null;
    
            // Gửi dữ liệu xuống view
            require_once './views/listProduct.php';
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Hiển thị chi tiết sản phẩm
    public function showProductDetail() {
        $productId = $_GET['id'] ?? null;
        if (!$productId || !is_numeric($productId)) {
            echo "ID sản phẩm không hợp lệ.";
            return;
        }
    
        // Lấy chi tiết sản phẩm
        $product = $this->productModel->getProductById((int) $productId);
    
        if ($product) {
            // Lấy sản phẩm tương tự
            $relatedProducts = $this->productModel->getRelatedProducts($product['danh_muc_id'], $productId);
    
            // Lấy sản phẩm gợi ý
            $suggestedProducts = $this->productModel->getSuggestedProducts();
    
            // Gửi dữ liệu xuống view
            require_once './views/detailsProduct.php';
        } else {
            echo "Sản phẩm không tồn tại.";
        }
    }
}
?>
