<?php
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';

?>
<div class="d-flex justify-content-center align-items-center" style="height: 400px; margin: 100px;">
    <div>
        <div class="mb-4 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="100" height="100" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <div class="text-center" >
            <h3 class="mb-2" style="font-size:30px;">Cảm ơn quý khách hàng đã mua hàng !</h3>
            <h5 class="mb-3" style="font-size:15px;">Rất mong quý khách hàng sẽ luôn luôn tin tưởng và ủng hộ EduBook</h5>
            <a href="index.php" class="btn btn-primary " style="font-size:20px;text-align:center;">Quay lại trang chủ</a>
        </div>
       
    </div>
</div>

<?php
require_once './views/layout/footer.php';
?>