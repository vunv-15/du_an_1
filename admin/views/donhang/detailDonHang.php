<!-- header -->
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Quản Lý - Đơn Hàng: <?= $donHang['ma_don_hang'] ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    if ($donHang['trang_thai_id'] == 1) {
                        $colorAlerts = 'warning';
                    } elseif ($donHang['trang_thai_id'] == 2) {
                        $colorAlerts = 'primary';
                    } else {
                        $colorAlerts = 'success';
                    }
                    ?>
                    <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                        <strong>Trạng Thái Đơn Hàng:</strong> <?= $donHang['ten_trang_thai'] ?>
                    </div>

                    <!-- Main content -->
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h4>
                                <i class="fas fa-book-open"></i> Shop Bán Sách Chuyên Ngành CNTT
                                <span class="float-right">Ngày Đặt: <?= $donHang['ngay_dat'] ?></span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Info row -->
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="text-primary">Thông Tin Người Đặt</h5>
                                    <address>
                                        <strong><?= $donHang['ho_ten'] ?></strong><br>
                                        <i class="fas fa-envelope"></i> Email: <?= $donHang['email'] ?><br>
                                        <i class="fas fa-phone"></i> Số Điện Thoại: <?= $donHang['so_dien_thoai'] ?><br>
                                        <i class="fas fa-map-marker-alt"></i> Địa Chỉ: <?= $donHang['dia_chi'] ?><br>
                                    </address>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-primary">Thông Tin Người Nhận</h5>
                                    <address>
                                        <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                                        <i class="fas fa-envelope"></i> Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                                        <i class="fas fa-phone"></i> Số Điện Thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                        <i class="fas fa-map-marker-alt"></i> Địa Chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                    </address>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-primary">Thông Tin Đơn Hàng</h5>
                                    <address>
                                        <strong>Mã Đơn Hàng:</strong> <?= $donHang['ma_don_hang'] ?><br>
                                        <strong>Tổng Tiền:</strong> <?= number_format($donHang['tong_tien'], 0, ',', '.') ?> VNĐ<br>
                                        <strong>Ghi Chú:</strong> <?= $donHang['ghi_chu'] ?><br>
                                        <strong>Thanh Toán:</strong> <?= $donHang['ten_phuong_thuc'] ?><br>
                                    </address>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="card-footer text-muted">
                            <button class="btn btn-warning">
                                <a href="<?= BASE_URL_ADMIN . '?act=don-hang' ?>">
                                    <i class="fas fa-arrow-left"></i> Quay Lại
                                </a>
                            </button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End footer -->


<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- Code injected by live-server -->

</body>

</html>