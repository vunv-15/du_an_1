<?php require_once './views/layout/header.php' ?>
<?php require_once './views/layout/navbar.php' ?>
<hr>
<div class="content-wrapper mb-5">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center mt-5">
                    <h1 class="display-4 text-danger">Thông tin cá nhân</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-info">Sửa Thông Tin</h3>
                        </div>
                        <form action="<?= BASE_URL . '?act=sua-khach-hang' ?>" method="POST">
                            <input type="hidden" name="khach_hang_id" value="<?= $khachHang['id'] ?>">
                            <div class="card-body">
                                <!-- Họ tên -->
                                <div class="form-group" style="font-size: 2rem; font-weight: bold; color: black;">
                                    <label for="ho_ten">Họ tên</label>
                                    <input type="text" class="form-control" id="ho_ten" name="ho_ten" 
                                           value="<?= $khachHang['ho_ten'] ?>" placeholder="Nhập họ tên" required>
                                    <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Email -->
                                <div class="form-group" style="font-size: 2rem; font-weight: bold; color: black;">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= $khachHang['email'] ?>" placeholder="Nhập email" required>
                                    <?php if (isset($_SESSION['error']['email'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Số điện thoại -->
                                <div class="form-group" style="font-size: 2rem; font-weight: bold; color: black;">
                                    <label for="so_dien_thoai">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" 
                                           value="<?= $khachHang['so_dien_thoai'] ?>" placeholder="Điền SĐT" 
                                           pattern="[0-9]{10}" required>
                                    <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Ngày sinh -->
                                <div class="form-group" style="font-size: 2rem; font-weight: bold; color: black;">
                                    <label for="ngay_sinh">Ngày sinh</label>
                                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" 
                                           value="<?= $khachHang['ngay_sinh'] ?>" required>
                                    <?php if (isset($_SESSION['error']['ngay_sinh'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Giới tính -->
                                <div class="form-group" style="font-size: 2rem; font-weight: bold; color: black;">
                                    <label for="gioi_tinh">Giới tính</label>
                                    <select name="gioi_tinh" id="gioi_tinh" class="form-control custom-select" required>
                                        <option <?= $khachHang['gioi_tinh'] == 1 ? 'selected': '' ?> value="1">Nam</option>
                                        <option <?= $khachHang['gioi_tinh'] !== 1 ? 'selected': '' ?> value="2">Nữ</option>
                                    </select>
                                </div>

                                <!-- Địa chỉ -->
                                <div class="form-group" style="font-size: 2rem; font-weight: bold; color: black;">
                                    <label for="dia_chi">Địa chỉ</label>
                                    <input type="text" class="form-control" id="dia_chi" name="dia_chi" 
                                           value="<?= $khachHang['dia_chi'] ?>" placeholder="Điền địa chỉ" required>
                                    <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<hr>
<?php require_once './views/layout/footer.php' ?>
