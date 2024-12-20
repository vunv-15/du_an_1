<?php
class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
        if (!$this->conn) {
            $this->logError(new Exception("Không thể kết nối cơ sở dữ liệu."));
            throw new Exception("Kết nối cơ sở dữ liệu thất bại.");
        }
    }

    // Lấy tất cả sản phẩm
    public function getAllProducts() {
        try {
            $sql = "SELECT id, ten_sach, gia_sach, hinh_anh FROM san_phams WHERE trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (Exception $e) {
            $this->logError($e);
            return [];
        }
    }

    // Lấy tất cả danh mục
    public function getAllCategories() {
        try {
            $sql = "SELECT id, ten_danh_muc FROM danh_mucs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (Exception $e) {
            $this->logError($e);
            return [];
        }
    }

    // Lấy sản phẩm theo danh mục
    public function getProductsByCategory($categoryId) {
        try {
            $categoryId = intval($categoryId); // Đảm bảo dữ liệu là số nguyên
            $sql = "SELECT id, ten_sach, gia_sach, hinh_anh 
                    FROM san_phams 
                    WHERE danh_muc_id = :danh_muc_id AND trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':danh_muc_id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (Exception $e) {
            $this->logError($e);
            return [];
        }
    }
    public function getBestSellingProducts($limit = 6) {
        try {
            $sql = "SELECT id, ten_sach, gia_sach,gia_khuyen_mai, hinh_anh
                    FROM san_phams 
                    WHERE trang_thai = 1 
                    LIMIT :limit";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $data;
        } catch (Exception $e) {
            $this->logError($e);
            return [];
        }
    }
    // Lấy thông tin chi tiết sản phẩm
    public function getProductById($id) {
        try {
            $id = intval($id);
            $sql = "SELECT id, ten_sach, gia_sach, hinh_anh, mo_ta, trang_thai, nha_xuat_ban, so_trang, ngay_xuat_ban, danh_muc_id 
                    FROM san_phams 
                    WHERE id = :id AND trang_thai = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Exception $e) {
            $this->logError($e);
            return null;
        }
    }
    public function getSuggestedProducts($limit = 6)
{
    try {
        $sql = "SELECT id, ten_sach, gia_sach, hinh_anh, gia_khuyen_mai 
                FROM san_phams 
                WHERE trang_thai = 1 
                ORDER BY RAND() 
                LIMIT :limit";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $this->logError($e); // Ghi log lỗi (nếu có hàm logError)
        return [];
    }
}
    // Hàm tìm kiếm sản phẩm
    public function searchProducts($keyword) {
        try {
            // Làm sạch dữ liệu đầu vào và tạo dấu % cho phép tìm kiếm toàn bộ từ khóa
            $keyword = '%' . trim(htmlspecialchars($keyword)) . '%'; 
            
            // SQL query để tìm kiếm sản phẩm theo tên hoặc mô tả
            $sql = "SELECT id, ten_sach, gia_sach, hinh_anh 
                    FROM san_phams 
                    WHERE (ten_sach LIKE :keyword OR mo_ta LIKE :keyword) AND trang_thai = 1";
            
            // Chuẩn bị câu truy vấn
            $stmt = $this->conn->prepare($sql);
            
            // Gắn tham số vào câu truy vấn
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
            
            // Thực thi câu truy vấn
            $stmt->execute();
            
            // Trả về tất cả kết quả dưới dạng mảng hoặc mảng rỗng nếu không có kết quả
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (Exception $e) {
            // Ghi log lỗi nếu có
            $this->logError($e);
            return [];
        }
    }
    public function getProductsByCategoryWithPagination($categoryId, $offset, $perPage) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM san_phams WHERE danh_muc_id = :categoryId LIMIT :offset, :perPage");
            $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->execute();
    
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Lấy tổng số sản phẩm
            $countStmt = $this->conn->prepare("SELECT COUNT(*) FROM san_phams WHERE danh_muc_id = :categoryId");
            $countStmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
            $countStmt->execute();
    
            $total = $countStmt->fetchColumn();
    
            return ['products' => $products, 'total' => $total];
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage());
        }
    }
    public function getAllProductsWithPagination($offset, $perPage) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM san_phams LIMIT :offset, :perPage");
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->execute();
    
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Lấy tổng số sản phẩm
            $countStmt = $this->conn->prepare("SELECT COUNT(*) FROM san_phams");
            $countStmt->execute();
    
            $total = $countStmt->fetchColumn();
    
            return ['products' => $products, 'total' => $total];
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi truy vấn cơ sở dữ liệu: " . $e->getMessage());
        }
    }
    public function getCategoryNameById($categoryId) {
        try {
            $stmt = $this->conn->prepare("SELECT ten_danh_muc FROM danh_mucs WHERE id = :id");
            $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            $this->logError($e);
            return null;
        }
    }
    public function getRelatedProducts($categoryId, $currentProductId) {
        try {
            $sql = "SELECT id, ten_sach, gia_sach, hinh_anh 
                    FROM san_phams 
                    WHERE danh_muc_id = :danh_muc_id 
                      AND id != :id 
                      AND trang_thai = 1 
                    LIMIT 6";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':danh_muc_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':id', $currentProductId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $this->logError($e);
            return [];
        }
    }
    // Ghi log lỗi
    private function logError($exception) {
        $message = '[' . date('Y-m-d H:i:s') . '] ERROR: ' . $exception->getMessage() . PHP_EOL;
        $file = './logs/error.log';

        if (!file_exists('./logs')) {
            mkdir('./logs', 0777, true);
        }

        file_put_contents($file, $message, FILE_APPEND);
    }
}
