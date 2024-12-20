<?php

class OrderModel {
    private $db;

    // Khởi tạo với đối tượng database
    public function __construct($db) {
        $this->db = $db;
    }

    // Tạo đơn hàng
    public function createOrder($totalAmount, $statusId, $paymentMethodId, $userId, $recipientName, $email, $phone, $address, $oderNote) {
        $orderDate = date('Y-m-d'); // Lấy ngày hiện tại làm ngày đặt hàng
    
        // SQL query tạo đơn hàng mà không cần mã đơn hàng
        $sql = "INSERT INTO don_hangs 
                (tong_tien, trang_thai_id, phuong_thuc_thanh_toan_id, tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ngay_dat, ghi_chu) 
                VALUES 
                (:tong_tien, :trang_thai_id, :phuong_thuc_thanh_toan_id, :tai_khoan_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ngay_dat, :ghi_chu)";
    
        $stmt = $this->db->prepare($sql);
    
        try {
            // Thực thi câu lệnh SQL để tạo đơn hàng
            $stmt->execute([
                ':tong_tien' => $totalAmount,
                ':trang_thai_id' => $statusId,
                ':phuong_thuc_thanh_toan_id' => $paymentMethodId,
                ':tai_khoan_id' => $userId,
                ':ten_nguoi_nhan' => $recipientName,
                ':email_nguoi_nhan' => $email,
                ':sdt_nguoi_nhan' => $phone,
                ':dia_chi_nguoi_nhan' => $address,
                ':ngay_dat' => $orderDate, // Thêm trường ngày đặt
                ':ghi_chu' => $oderNote
            ]);
    
            // Lấy ID của đơn hàng vừa tạo
            $orderId = $this->db->lastInsertId();
    
            // Tạo mã đơn hàng theo định dạng "DH" + ID (với số lấp đầy bằng 0)
            $orderCode = "DH" . str_pad($orderId, 4, '0', STR_PAD_LEFT);
    
            // Cập nhật lại mã đơn hàng vào CSDL
            $updateSql = "UPDATE don_hangs SET ma_don_hang = :ma_don_hang WHERE id = :id";
            $updateStmt = $this->db->prepare($updateSql);
            $updateStmt->execute([
                ':ma_don_hang' => $orderCode,
                ':id' => $orderId
            ]);
    
            return $orderId;
    
        } catch (PDOException $e) {
            error_log("Lỗi khi tạo đơn hàng: " . $e->getMessage());
            throw new Exception("Không thể tạo đơn hàng. Vui lòng thử lại.");
        }
    }
   
    // Hàm cập nhật trạng thái đơn hàng
    public function updateOrderStatus($orderId, $status) {
        try {
            // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
            $query = "UPDATE don_hangs SET trang_thai_id = :trang_thai_id WHERE id = :order_id";
            $stmt = $this->db->prepare($query);

            // Gán giá trị cho các tham số
            $stmt->bindParam(':trang_thai_id', $status, PDO::PARAM_INT);
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

            // Thực thi câu lệnh
            $stmt->execute();

            return true;  // Trả về true nếu cập nhật thành công
        } catch (Exception $e) {
            // Xử lý lỗi nếu có
            error_log("Lỗi khi cập nhật trạng thái đơn hàng: " . $e->getMessage());
            return false;
        }
    }

    // Phương thức lấy tổng số sản phẩm
    public function getTotalProducts() {
        // Kiểm tra nếu $db là null, báo lỗi
        if ($this->db === null) {
            throw new Exception("Database connection is not initialized.");
        }

        $sql = "SELECT COUNT(*) FROM san_phams WHERE trang_thai = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Thêm chi tiết đơn hàng
    public function addOrderDetails($orderId, $productId, $quantity, $price) {
        // Kiểm tra xem sản phẩm có tồn tại hay không
        $sqlCheckProduct = "SELECT id FROM san_phams WHERE id = :product_id AND trang_thai = 1";
        $stmtCheckProduct = $this->db->prepare($sqlCheckProduct);
        $stmtCheckProduct->execute([':product_id' => $productId]);
    
        if ($stmtCheckProduct->rowCount() == 0) {
            // Nếu sản phẩm không tồn tại hoặc không còn bán, trả về lỗi
            throw new Exception("Sản phẩm với ID $productId không tồn tại hoặc không còn bán.");
        }
    
        // Tính toán giá trị thanh toán cho sản phẩm này
        $totalAmount = $price * $quantity;
    
        // Thêm chi tiết đơn hàng
        $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, so_luong, don_gia, thanh_tien) 
                VALUES (:don_hang_id, :san_pham_id, :so_luong, :don_gia, :thanh_tien)";
        $stmt = $this->db->prepare($sql);
    
        try {
            $stmt->execute([
                ':don_hang_id' => $orderId,
                ':san_pham_id' => $productId,
                ':so_luong' => $quantity,
                ':don_gia' => $price,
                ':thanh_tien' => $totalAmount
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi khi thêm chi tiết đơn hàng: " . $e->getMessage());
            throw new Exception("Lỗi khi thêm chi tiết đơn hàng cho sản phẩm ID $productId: " . $e->getMessage());
        }
    }
}
?>
