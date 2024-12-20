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
            <div class="card">
              <div class="card-header">
                <a href="<?= BASE_URL_ADMIN . '?act=form-them-quan-tri' ?>"class="btn btn-success">Thêm Tài Khoản</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số diện thoại</th>
                    <th>Trạng thái</th>
                    <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($listQuanTri as $key => $quantri) : ?>
                  <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $quantri['ho_ten'] ?></td>
                    <td><?= $quantri['email'] ?></td>
                    <td><?= $quantri['so_dien_thoai'] ?></td>
                    <td><?= $quantri['trang_thai'] == 1 ? 'Active':'Inactive' ?></td>
                    <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' .$quantri['id'] ?>">
                        <button class="btn btn-warning">Sửa</button>
                      </a>
                      <a href="<?= BASE_URL_ADMIN . '?act=reset-password&id_quan_tri=' .$quantri['id'] ?>" 
                      onclick="return confirm('Bạn Có muốn reset password của tài khoản hay không?')">
                        <button class="btn btn-danger">Reset</button>
                      </a>
                    </td>
                  </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
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
