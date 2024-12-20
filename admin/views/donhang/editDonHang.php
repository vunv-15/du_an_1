<?php require_once './views/layout/header.php' ?>
<?php require_once './views/layout/navbar.php' ?>
<?php require_once './views/layout/sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1>Quản Lý Thông Tin Đơn Hàng</h1>
                </div>
                <div class="col-sm-1">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa Đơn Hàng: <?= $donHang['ma_don_hang'] ?></h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">
                            <input type="text" name="don_hang_id" value="<?= $donHang['id'] ?>" hidden>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên Người Nhận</label>
                                        <input type="text" class="form-control" name="ten_nguoi_nhan" value="<?= $donHang['ten_nguoi_nhan'] ?>" placeholder="Nhập tên người nhận" readonly>
                                        <?php if (isset($errors['ten_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $errors['ten_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                        <input type="email" class="form-control" name="email_nguoi_nhan" value="<?= $donHang['email_nguoi_nhan'] ?>" placeholder="Nhập email" readonly>
                                        <?php if (isset($errors['email_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $errors['email_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Số Điện Thoại</label>
                                        <input type="number" class="form-control" name="sdt_nguoi_nhan" value="<?= $donHang['sdt_nguoi_nhan'] ?>" placeholder="Nhập số điện thoại" readonly>
                                        <?php if (isset($errors['sdt_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $errors['sdt_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Địa Chỉ</label>
                                        <input type="text" class="form-control" name="dia_chi_nguoi_nhan" value="<?= $donHang['dia_chi_nguoi_nhan'] ?>" placeholder="Nhập địa chỉ" readonly>
                                        <?php if (isset($errors['dia_chi_nguoi_nhan'])) { ?>
                                            <p class="text-danger"><?= $errors['dia_chi_nguoi_nhan'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Ghi Chú</label>
                                        <textarea name="ghi_chu" class="form-control" placeholder="Nhập mô tả" readonly><?= $donHang['ghi_chu'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng Thái Đơn Hàng</label>
                                    <select id="inputStatus" name="trang_thai_id" class="form-control custom-select">
                                        <?php foreach ($listTrangThaiDonHang as $trangThai) : ?>
                                            <option 
                                                <?php 
                                                    if($donHang['trang_thai_id'] > $trangThai['id']
                                                        || $donHang['trang_thai_id'] == 3)
                                                    {
                                                        echo 'disabled';
                                                    }
                                                ?>
                                                <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?> 
                                                value="<?= $trangThai['id']; ?>">
                                                <?= $trangThai['ten_trang_thai']; ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once './views/layout/footer.php' ?>
</body>

</html>