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
            <h1>Quản Lý Tài Khoản Khách Hàng</h1>
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
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ảnh đại diện</th>
                    <th>Email</th>
                    <th>Số diện thoại</th>
                    <th>Trạng thái</th>
                    <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listKhachHang as $key => $khachHang) : ?>
                  <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $khachHang['ho_ten'] ?></td>
                    <td>
                      <img src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>" style="height: 80px" alt=""
                      onerror="this.onerror=null; this.src='https://e7.pngegg.com/pngimages/178/595/png-clipart-user-profile-computer-icons-login-user-avatars-monochrome-black.png'">
                    </td>
                    <td><?= $khachHang['email'] ?></td>
                    <td><?= $khachHang['so_dien_thoai'] ?></td>
                    <td><?= $khachHang['trang_thai'] == 1 ? 'Active':'Inactive' ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' .$khachHang['id'] ?>">
                                <button class="btn btn-primary">Xem</button>
                            </a>
                            <a href="<?= BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' .$khachHang['id'] ?>">
                                <button class="btn btn-warning">Sửa</button>
                            </a>
                            <a href="<?= BASE_URL_ADMIN . '?act=reset-password&id_quan_tri=' .$khachHang['id'] ?>" 
                            onclick="return confirm('Bạn Có muốn reset password của tài khoản hay không?')">
                                <button class="btn btn-danger"><i class="fas fa-circle-notch"></i></button>
                            </a>
                        </div>
                    </td>
                  </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Ảnh đại diện</th>
                    <th>Email</th>
                    <th>Số diện thoại</th>
                    <th>Trạng thái</th>
                    <th>Thao Tác</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
