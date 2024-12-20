<?php require_once './views/layout/header.php' ?>
<?php require_once './views/layout/navbar.php' ?>
<hr>
<style>
    .custom-hover {
        transition: 0.3s; 
    }
    .custom-hover:hover {
        background-color: #007bff; 
        color: white; 
    }
</style>
<div class="content-wrapper mb-5">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col text-center mt-5">
                    <h1 class="display-5 text-primary">Thông tin cá nhân</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Card -->
                <div class="col-md-10">
                    <div class="card shadow-lg">
                        <div class="row g-0">
                            <!-- Avatar Section -->
                            <div class="col-md-4 text-center p-4">
                                <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" 
                                     class="img-fluid rounded-circle mb-3" style="width: 60%; height: auto;" alt="Avatar"
                                     onerror="this.onerror=null; this.src='https://e7.pngegg.com/pngimages/178/595/png-clipart-user-profile-computer-icons-login-user-avatars-monochrome-black.png'">
                                <h5 class="fw-bold"><?= $khachHang['ho_ten'] ?? 'Khách hàng' ?></h5>
                            </div>
                            <!-- Information Section -->
                            <div class="col-md-8 p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tbody class="fs-5">
                                            <tr style="font-size: 2rem; font-weight: bold; color: black;">
                                                <th>Họ tên :</th>
                                                <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                                            </tr>
                                            <tr style="font-size: 2rem; font-weight: bold; color: black;">
                                                <th>Ngày sinh :</th>
                                                <td><?= $khachHang['ngay_sinh'] ?? '' ?></td>
                                            </tr>
                                            <tr style="font-size: 2rem; font-weight: bold; color: black;">
                                                <th>Email :</th>
                                                <td><?= $khachHang['email'] ?? '' ?></td>
                                            </tr>
                                            <tr style="font-size: 2rem; font-weight: bold; color: black;">
                                                <th>Số điện thoại :</th>
                                                <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                                            </tr>
                                            <tr style="font-size: 2rem; font-weight: bold; color: black;">
                                                <th>Giới tính :</th>
                                                <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ'; ?></td>
                                            </tr>
                                            <tr style="font-size: 2rem; font-weight: bold; color: black;">
                                                <th>Địa chỉ :</th>
                                                <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <a href="<?= BASE_URL . '?act=form-sua-khach-hang' ?>">
                                        <button class="btn btn-warning btn-lg custom-hover">
                                            Chỉnh sửa thông tin
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<hr>
<?php require_once './views/layout/footer.php' ?>
