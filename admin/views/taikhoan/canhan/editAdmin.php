<?php require_once './views/layout/header.php' ?>
<?php require_once './views/layout/navbar.php' ?>
<?php require_once './views/layout/sidebar.php' ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 class="text-primary">Thông tin cá nhân</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Left column -->
        <div class="col-md-3">
          <div class="card">
            <div class="card-body text-center">
              <img src="<?= BASE_URL_ADMIN . $thongTin['anh_dai_dien']; ?>" class="avatar img-circle img-thumbnail" alt="avatar"
                onerror="this.onerror=null; this.src='https://e7.pngegg.com/pngimages/178/595/png-clipart-user-profile-computer-icons-login-user-avatars-monochrome-black.png'">
              <h6 class="mt-3">Họ Tên: <strong><?= $thongTin['ho_ten'] ?></strong></h6>
              <h6>Chức vụ: <strong><?= $thongTin['chuc_vu_id'] ?></strong></h6>
            </div>
          </div>
        </div>

        <!-- Right column -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h3>Thông tin quản trị viên</h3>
            </div>
            <div class="card-body">
              <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-admin' ?>" method="post">
                <div class="form-group">
                  <label>Họ tên:</label>
                  <input class="form-control" type="text" name="ho_ten" value="<?= $thongTin['ho_ten'] ?>" placeholder="Nhập họ tên">
                  <?php if (isset($_SESSION['error']['ho_ten'])): ?>
                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Email:</label>
                  <input class="form-control" type="email" name="email" value="<?= $thongTin['email'] ?>" placeholder="Nhập email">
                  <?php if (isset($_SESSION['error']['email'])): ?>
                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Số điện thoại:</label>
                  <input class="form-control" type="text" name="so_dien_thoai" value="<?= $thongTin['so_dien_thoai'] ?>" placeholder="Nhập số điện thoại">
                  <?php if (isset($_SESSION['error']['so_dien_thoai'])): ?>
                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Ngày sinh:</label>
                  <input class="form-control" type="date" name="ngay_sinh" value="<?= $thongTin['ngay_sinh'] ?>">
                </div>
                <div class="form-group">
                  <label>Giới tính:</label>
                  <select class="form-control" name="gioi_tinh">
                    <option <?= $thongTin['gioi_tinh'] == '1' ? 'selected' : '' ?> value="1">Nam</option>
                    <option <?= $thongTin['gioi_tinh'] == '0' ? 'selected' : '' ?> value="0">Nữ</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Địa chỉ:</label>
                  <input class="form-control" type="text" name="dia_chi" value="<?= $thongTin['dia_chi'] ?>" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                  <label>Trạng thái tài khoản:</label>
                  <select class="form-control" name="trang_thai">
                    <option <?= $thongTin['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Active</option>
                    <option <?= $thongTin['trang_thai'] !== 1 ? 'selected' : '' ?> value="2">Inactive</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
              </form>
            </div>
          </div>

          <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
              <h3>Đổi mật khẩu</h3>
            </div>
            <div class="card-body">
              <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-admin' ?>" method="post">
                <div class="form-group">
                  <label>Mật khẩu cũ:</label>
                  <input class="form-control" type="password" name="old_pass">
                  <?php if (isset($_SESSION['error']['old_pass'])): ?>
                    <p class="text-danger"><?= $_SESSION['error']['old_pass'] ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Mật khẩu mới:</label>
                  <input class="form-control" type="password" name="new_pass">
                  <?php if (isset($_SESSION['error']['new_pass'])): ?>
                    <p class="text-danger"><?= $_SESSION['error']['new_pass'] ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Nhập lại mật khẩu mới:</label>
                  <input class="form-control" type="password" name="confirm_pass">
                  <?php if (isset($_SESSION['error']['confirm_pass'])): ?>
                    <p class="text-danger"><?= $_SESSION['error']['confirm_pass'] ?></p>
                  <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php require_once './views/layout/footer.php' ?>