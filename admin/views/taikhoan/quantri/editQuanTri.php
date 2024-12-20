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
                    <h1>Quản Lý Tài Khoản Quản Trị Viên</h1>
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
                            <h3 class="card-title">Sửa thông tin tài khoản quản trị: <?= $quanTri['ho_ten']; ?></h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '?act=sua-quan-tri' ?>" method="POST">
                            <input type="hidden" name="quan_tri_id" value="<?= $quanTri['id'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label">Họ tên</label>
                                        <input type="text" class="form-control" name="ho_ten" value="<?= $quanTri['ho_ten'] ?>" placeholder="Nhập họ tên">
                                        <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?= $quanTri['email'] ?>" placeholder="Nhập email">
                                        <?php if (isset($_SESSION['error']['email'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label">Số điện thoại </label>
                                        <input type="text" class="form-control" name="so_dien_thoai" value="<?= $quanTri['so_dien_thoai'] ?>" placeholder="Điền SĐT">
                                        <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                        <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái tài khoản</label>
                                    <select name="trang_thai" id="inputStatus" class="form-control custom-select">
                                        <option <?= $quanTri['trang_thai'] == 1 ? 'selected': '' ?> value="1">Active</option>
                                        <option <?= $quanTri['trang_thai'] !== 1 ? 'selected': '' ?> value="2">Inactive</option>
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