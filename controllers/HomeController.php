<?php 

class HomeController
{
    public $modelTaiKhoan;
    public $modelSanPham;
    public $productModel;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();     
        $this->productModel = new ProductModel(); // Chú ý đảm bảo bạn có $dbConnection nếu ProductModel cần kết nối DB
    }

    public function home(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        // Lấy danh sách sản phẩm bán chạy
        $bestSellingProducts = $this->productModel->getBestSellingProducts();

        $suggestedProducts = $this->productModel->getSuggestedProducts();

       // Lấy tất cả danh mục sản phẩm
    $categories = $this->productModel->getAllCategories();

    // Lấy ID danh mục từ GET, mặc định là danh mục đầu tiên nếu không chọn
    $categoryId = $_GET['danh_muc_id'] ?? ($categories[0]['id'] ?? null);

    // Lấy danh sách sản phẩm theo danh mục
    if ($categoryId) {
        $products = $this->productModel->getProductsByCategory($categoryId);
    } else {
        $products = $this->productModel->getAllProducts();
    }
        require_once './views/home.php';
    }

    //liên hệ
    public function contact(){
        require_once './views/Contact.php';
    }

    // bài viết
    public function post(){
        require_once './views/Post.php';
    }

    public function trangChu(){
        echo "Trang Chủ";
    }
    // Đăng nhập
    public function formLogin() {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
        exit();
    }
    public function postLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy email và mật khẩu từ form
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email);
    
            // Kiểm tra tài khoản khách hàng hoạt động
            if ($user && password_verify($password, $user['mat_khau']) && $user['chuc_vu_id'] == 2 && $user['trang_thai'] == 1) {
                // Đăng nhập thành công
                $_SESSION['user_client'] = $user;
                $_SESSION['success'] = 'Đăng nhập thành công!';
                header("Location: " . BASE_URL);
                exit();
            } else {
                // Nếu đăng nhập thất bại, lưu lỗi vào session
                $_SESSION['error'] = "Sai thông tin mật khẩu hoặc tài khoản hoặc tài khoản không hoạt động!";
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function logout(){
        if(isset($_SESSION['user_client'])){
            unset($_SESSION['user_client']);
            header("Location: " .BASE_URL);
            exit();
        }
    }
    // Đăng ký
    public function formRegister() {
        require_once './views/auth/register.php';
        deleteSessionError();
        exit();
    }
    public function postAddUser(){
        // Xử lý thêm dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $password = $_POST['mat_khau'];
            $errors = [];
        
            // Lưu dữ liệu đã nhập vào session
            $_SESSION['old_data'] = [
                'ho_ten' => $ho_ten,
                'email' => $email,
                // Không lưu password để bảo mật
            ];
        
            // Kiểm tra dữ liệu đầu vào
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Vui lòng điền tên!';
            }
            if (empty($email)) {
                $errors['email'] = 'Vui lòng điền tài khoản email!';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ!';
            }
            
            if (empty($password)) {
                $errors['password'] = 'Nhập mật khẩu!';
            } elseif (strlen($password) <= 5) {
                $errors['password'] = 'Mật khẩu phải có nhiều hơn 5 ký tự!';
            }
        
            // Lưu lỗi vào session
            $_SESSION['error'] = $errors;
        
            // Nếu không có lỗi
            if (empty($errors)) {
                // Mã hóa mật khẩu
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
                // Chức vụ mặc định là 2 (Khách hàng)
                $chuc_vu_id = 2;
        
                // Lưu thông tin người dùng vào database
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $hashedPassword, $chuc_vu_id);
        
                // Thêm thông báo thành công vào session
                $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
        
                // Xóa dữ liệu tạm thời trong session
                unset($_SESSION['old_data']);
                unset($_SESSION['error']);
        
                // Chuyển hướng đến trang đăng nhập
                header("Location: " . BASE_URL . '?act=login');
                exit();
            } else {
                // Chuyển hướng lại form
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }
        }
        
    }
    // Profile khách hàng
    public function formEditKhachHang() {
        // Lấy ID khách hàng từ session thay vì GET
        $id_khach_hang = $_SESSION['user_client']['id']; 
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        require_once './views/auth/editUser.php';
        deleteSessionError();
    }
    
    public function postEditKhachHang() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ID khách hàng từ session
            $khach_hang_id = $_SESSION['user_client']['id']; 
            
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
    
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Điền họ tên';
            }
            if (empty($email)) {
                $errors['email'] = 'Điền email';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Chọn ngày sinh';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Chọn giới tính';
            }
            $_SESSION['error'] = $errors;
            
            if (empty($errors)) {
                $this->modelTaiKhoan->updateKhachHang($khach_hang_id, $ho_ten, $email, $so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi);
                header("Location: " . BASE_URL . '?act=chi-tiet-khach-hang');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL . '?act=form-sua-khach-hang');
                exit();
            }
        }
    }
    
    public function deltailKhachHang() {
        // Lấy ID khách hàng từ session
        $id_khach_hang = $_SESSION['user_client']['id']; 
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        require_once './views/auth/deltailUser.php';
    }



    // lịch sử mua hàng
    public function viewOrderHistory() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_client']['id'])) {
            header("Location: " . BASE_URL . '?act=login');
            return;
        }
    
        $userId = $_SESSION['user_client']['id'];
    
        try {
            // Lấy dữ liệu lịch sử đơn hàng từ model
            $orderDetails = $this->modelTaiKhoan->getHistoryOrderByUserId($userId);
    
            // Debug dữ liệu trả về
            if (!$orderDetails || empty($orderDetails)) {
                $error_message = "Không có đơn hàng nào trong lịch sử.";
            }
    
            include './views/order/OrderHistory.php';
        } catch (Exception $e) {
            $error_message = "Lỗi xảy ra khi lấy lịch sử đặt hàng: " . $e->getMessage();
            include './views/order/OrderHistory.php';
        }
    }
    
    // Hiển thị chi tiết đơn hàng
    public function orderDetails()
{
    // Lấy order_id từ URL
    $orderId = $_GET['order_id'] ?? null;

    if (!$orderId) {
        echo "<p>Không tìm thấy thông tin đơn hàng.</p>";
        exit;
    }

    try {
        // Lấy thông tin chi tiết đơn hàng từ model
        $orderDetails = $this->modelTaiKhoan->getOrderDetailsById($orderId);

        if (!$orderDetails) {
            echo "<p>Đơn hàng không tồn tại hoặc bạn không có quyền xem.</p>";
            exit;
        }

        // Truyền dữ liệu sang view
        require_once './views/order/OrderDetails.php'; // Đường dẫn view
    } catch (Exception $e) {
        echo "<p>Lỗi: " . $e->getMessage() . "</p>";
        exit;
    }
}
}