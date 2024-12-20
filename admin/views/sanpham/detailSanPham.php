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
        <div class="col-sm-11">
          <h1>Quản Lý Sản Phẩm</h1>
        </div>
        <div class="col-sm-1">
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Card Box -->
    <div class="card card-solid shadow">
      <div class="card-body">
        <div class="row">
          <!-- Product Image Section -->
          <div class="col-12 col-sm-6">
            <div class="text-center mb-4">
              <img style="width:400px; height:500px;" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="img-fluid rounded border" alt="Product Image">
            </div>
            <div class="d-flex justify-content-center flex-wrap">
              <?php foreach ($listAnhSanPham as $key => $anhSP) : ?>
                <div class="product-image-thumb <?= $anhSP[$key] == 0 ? 'active' : '' ?> m-2">
                  <img src="<?= BASE_URL . $anhSP['link_hinh_anh']; ?>" alt="Product Image" class="img-thumbnail" style="width:80px; height:100px;">
                </div>
              <?php endforeach ?>
            </div>
          </div>

          <!-- Product Details Section -->
          <div class="col-12 col-sm-6">
            <h3 class="my-3 text-primary"><b>Tên Sách:</b> <?= $sanPham['ten_sach'] ?></h3>
            <hr>
            <ul class="list-group">
              <li class="list-group-item"><b>Giá Tiền:</b> <span class="text-danger"><?= number_format($sanPham['gia_sach'], 0, ',', '.') ?> VNĐ</span></li>
              <li class="list-group-item"><b>Giá Khuyến Mãi:</b> <span class="text-success"><?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?> VNĐ</span></li>
              <li class="list-group-item"><b>Số Lượng:</b> <?= $sanPham['so_luong'] ?></li>
              <li class="list-group-item"><b>Lượt Xem:</b> <?= $sanPham['luot_xem'] ?></li>
              <li class="list-group-item"><b>Ngày Nhập:</b> <?= $sanPham['ngay_xuat_ban'] ?></li>
              <li class="list-group-item"><b>Danh Mục:</b> <?= $sanPham['ten_danh_muc'] ?></li>
              <li class="list-group-item"><b>Trạng Thái:</b> <?= $sanPham['trang_thai'] == 1 ? '<span class="badge bg-success">Còn Bán</span>' : '<span class="badge bg-danger">Dừng Bán</span>' ?></li>
              <li class="list-group-item"><b>Mô Tả:</b> <?= $sanPham['mo_ta'] ?></li>
            </ul>
          </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-4">
          <h2>Bình luận của sản phẩm</h2>
          <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered">
              <thead class="bg-secondary text-white">
                <tr>
                  <th>STT</th>
                  <th>Người bình luận</th>
                  <th>Nội dung</th>
                  <th>Ngày bình luận</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listBinhLuan as $key => $binhLuan) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id'] ?>" target="_blank" class="text-info">
                        <?= $binhLuan['ho_ten'] ?>
                      </a>
                    </td>
                    <td><?= $binhLuan['noi_dung'] ?></td>
                    <td><?= $binhLuan['ngay_dang'] ?></td>
                    <td>
                      <span class="badge <?= $binhLuan['trang_thai'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                        <?= $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Bị ẩn' ?>
                      </span>
                    </td>
                    <td>
                      <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="post" class="d-inline-block">
                        <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                        <input type="hidden" name="name_view" value="detail_sanpham">
                        <button onclick="return confirm('Bạn có muốn ẩn bình luận này không?')" class="btn btn-warning btn-sm">
                          <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Bỏ ẩn' ?>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
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
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function() {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>

</html>