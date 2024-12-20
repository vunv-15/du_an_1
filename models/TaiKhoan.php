<?php 

class TaiKhoan
{
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function checkLogin($email) {
        try {
            // Truy vấn lấy thông tin tài khoản từ email
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
    
            if ($user) {
                return $user;  // Trả về thông tin người dùng
            } else {
                return false;  // Không tìm thấy người dùng
            }
        } catch (\Exception $e) {
            // Xử lý lỗi
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    // đăng ký :
    public function insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id){
        try {
            // Truy vấn chèn dữ liệu vào bảng tai_khoans
            $sql = 'INSERT INTO tai_khoans(ho_ten, email, mat_khau, chuc_vu_id)
                    VALUES (:ho_ten, :email, :password, :chuc_vu_id)';
    
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi truy vấn với dữ liệu từ form
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,  // Mật khẩu đã mã hóa
                ':chuc_vu_id' => $chuc_vu_id,  // Chức vụ mặc định là khách hàng (2)
            ]);
    
            return true;  // Trả về true nếu thành công
        } catch (Exception $e) {
            // Xử lý lỗi
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    // profile
    public function getDetailTaiKhoan($id){
        try{
            $sql = 'SELECT * FROM tai_khoans WHERE id = :id';

            $stml = $this->conn->prepare($sql);

            $stml->execute([
                ':id' => $id
            ]);

            return $stml->fetch();
        }catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function updateKhachHang($id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi){
        try{
            $sql = 'UPDATE tai_khoans
                    SET
                        ho_ten = :ho_ten,
                        email = :email,
                        so_dien_thoai = :so_dien_thoai,
                        ngay_sinh = :ngay_sinh,
                        gioi_tinh = :gioi_tinh,
                        dia_chi = :dia_chi
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':ngay_sinh' => $ngay_sinh,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    // lịch sử mua hàng
    public function getHistoryOrderByUserId($userId) {
        try {
            $sql = "
                SELECT 
                    dh.id AS don_hang_id,
                    dh.ma_don_hang,
                    dh.ten_nguoi_nhan,
                    dh.ngay_dat,
                    dh.tong_tien,
                    dh.ghi_chu,
                    dh.trang_thai_id,
                    ctdh.san_pham_id,
                    ctdh.don_gia,
                    ctdh.so_luong,
                    ctdh.thanh_tien,
                    sp.ten_sach AS ten_san_pham,
                    sp.hinh_anh AS hinh_anh_san_pham,
                    tt.ten_trang_thai AS ten_trang_thai
                FROM don_hangs dh
                LEFT JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.don_hang_id
                LEFT JOIN san_phams sp ON ctdh.san_pham_id = sp.id
                LEFT JOIN trang_thai_don_hangs tt ON dh.trang_thai_id = tt.id
                WHERE dh.tai_khoan_id = :tai_khoan_id
                ORDER BY dh.ngay_dat DESC;
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $userId]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi khi lấy lịch sử đơn hàng: " . $e->getMessage());
            throw new Exception("Không thể lấy lịch sử đơn hàng.");
        }
    }
    public function getOrderDetailsById($orderId)
{
    try {
        $sql = "
            SELECT 
                dh.id AS don_hang_id,
                dh.ten_nguoi_nhan,
                dh.dia_chi_nguoi_nhan,
                dh.ngay_dat,
                dh.tong_tien AS tong_tien_hang,
                dh.tong_tien,
                dh.ghi_chu,
                dh.trang_thai_id,
                tt.ten_trang_thai,
                ctdh.san_pham_id,
                ctdh.so_luong,
                ctdh.don_gia,
                sp.ten_sach,
                sp.hinh_anh
            FROM don_hangs dh
            LEFT JOIN trang_thai_don_hangs tt ON dh.trang_thai_id = tt.id
            LEFT JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.don_hang_id
            LEFT JOIN san_phams sp ON ctdh.san_pham_id = sp.id
            WHERE dh.id = :order_id
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);

        $order = [];
        $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (empty($order)) {
                $order = [
                    'don_hang_id' => $row['don_hang_id'],
                    'ten_nguoi_nhan' => $row['ten_nguoi_nhan'],
                    'dia_chi_nguoi_nhan' => $row['dia_chi_nguoi_nhan'],
                    'ngay_dat' => $row['ngay_dat'],
                    'tong_tien_hang' => $row['tong_tien_hang'],
                    'tong_tien' => $row['tong_tien'],
                    'ghi_chu' => $row['ghi_chu'],
                    'trang_thai_id' => $row['trang_thai_id'],
                    'ten_trang_thai' => $row['ten_trang_thai'],
                ];
            }

            $products[] = [
                'san_pham_id' => $row['san_pham_id'],
                'ten_sach' => $row['ten_sach'],
                'hinh_anh' => $row['hinh_anh'],
                'so_luong' => $row['so_luong'],
                'don_gia' => $row['don_gia'],
            ];
        }

        if (!empty($order)) {
            $order['san_pham'] = $products;
        }

        return $order;
    } catch (PDOException $e) {
        throw new Exception("Lỗi khi lấy chi tiết đơn hàng: " . $e->getMessage());
    }
}
}