<?php
require_once './models/ProductModel.php';

class SearchController {
    private $productModel;

    public function __construct($dbConnection) {
        $this->productModel = new ProductModel($dbConnection);
    }

    // Xử lý tìm kiếm sản phẩm
    public function handleSearch() {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $_GET['keyword'] ?? ($_POST['keyword'] ?? '');
        $keyword = trim($keyword);

        // Lấy danh sách sản phẩm và danh mục
        $products = $this->getProductsByKeyword($keyword);
        $categories = $this->productModel->getAllCategories();

        // Kiểm tra loại request (AJAX hay không)
        if ($this->isAjaxRequest()) {
            $this->renderAjaxSearchResults($products);
            exit;
        }

        // Hiển thị giao diện danh sách sản phẩm
        require_once './views/listProduct.php';
    }

    // Lấy danh sách sản phẩm theo từ khóa
    private function getProductsByKeyword($keyword) {
        if ($keyword === '') {
            // Không có từ khóa, lấy tất cả sản phẩm
            return $this->productModel->getAllProducts();
        }
        // Có từ khóa, tìm kiếm sản phẩm
        return $this->productModel->searchProducts($keyword);
    }

    // Kiểm tra request có phải AJAX hay không
    private function isAjaxRequest() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Render kết quả tìm kiếm cho AJAX
    private function renderAjaxSearchResults($products) {
        if (!empty($products)) {
            foreach ($products as $product) {
                $productId = htmlspecialchars($product['id'] ?? 0);
                $productName = htmlspecialchars($product['ten_sach'] ?? 'Sản phẩm không xác định');
                $productImage = htmlspecialchars($product['hinh_anh'] ?? './assets/images/default-product.png');

                // Tạo HTML cho từng sản phẩm
                echo <<<HTML
                <a>
                    <li class="search-result-item" onclick="redirectToProduct($productId)">
                        <img src="$productImage" alt="$productName" class="search-result-img">
                        <span class="search-result-name">$productName</span>
                    </li>
                </a>
                HTML;
            }
        } else {
            echo '<p class="search-result-empty">Không tìm thấy sản phẩm nào.</p>';
        }
    }
}
?>
