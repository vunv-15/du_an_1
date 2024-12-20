  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white;"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= BASE_URL ?>" class="nav-link" style="color: white;">Website</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt" style="color: white;"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL_ADMIN . '?act=logout-admin' ?>" onclick="return confirm('Đăng xuất tài khoản ?')">
        <i class="fas fa-sign-out-alt" style="color: white;"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->