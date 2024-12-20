<?php 
    class AdminDanhMucController{

        public $modelDanhMuc;
        public function __construct()
        {
            $this->modelDanhMuc = new AdminDanhMuc();
        }
        public function danhSachDanhMuc(){
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            require_once './views/danhmuc/listDanhMuc.php';
        }

        public function formAddDanhMuc(){
            //hiển thị form nhập
            require_once './views/danhmuc/addDanhMuc.php';
        }

        
        public function postAddDanhMuc(){
            //thêm dữ liệu xử lý
            // var_dump($_POST);
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $mo_ta = $_POST['mo_ta'];
                $errors = [];
                if(empty($ten_danh_muc)){
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống.';
                }
                // nếu không có lỗi 
                if(empty($errors)){
                    // nếu không có lỗi tiến hành tiếp
                    // var_dump("kjhk");die;
                    $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                    header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                    exit();
                }else{
                    // trả về form và lỗi
                    require_once './views/danhmuc/addDanhMuc.php';
                }
            }
        }

        public function formEditDanhMuc(){
            //hiển thị form nhập
            //lấy ra thông tin
            $id = $_GET['id_danh_muc'];
            $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
            if($danhMuc){
                require_once './views/danhmuc/editDanhMuc.php';
            }else{
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                    exit();
            }
        }

        
        public function postEditDanhMuc(){
            //thêm dữ liệu xử lý
            // var_dump($_POST);
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $mo_ta = $_POST['mo_ta'];
                $errors = [];
                if(empty($ten_danh_muc)){
                    $errors['ten_danh_muc'] = 'Tên danh mục không được để trống.';
                }
                // nếu không có lỗi 
                if(empty($errors)){
                    // nếu không có lỗi tiến hành tiếp
                    // var_dump("kjhk");die;
                    $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                    header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                    exit();
                }else{
                    // trả về form và lỗi
                    $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                    require_once './views/danhmuc/editDanhMuc.php';
                }
            }
        }

        public function deleteDanhMuc(){
            $id = $_GET['id_danh_muc'];
            $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);

            if($danhMuc){
                $this->modelDanhMuc->destroyDanhMuc($id);
            }

            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
?>