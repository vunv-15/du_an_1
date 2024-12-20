<?php require_once './views/layout/header.php' ?>
<?php require_once './views/layout/navbar.php' ?>

<!-- 
<button onclick="topFunction()" id="myBtn-scroll" title="Go to top"><i class="fas fa-chevron-up"></i></i></button> -->
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sign in Admin</title>
      <link rel="stylesheet" href="./admin/asset/css/bootstrap.min.css">
      <link rel="stylesheet" href="./admin/asset/css/typography.css">
      <link rel="stylesheet" href="./admin/asset/css/style.css">
      <link rel="stylesheet" href="./admin/asset/css/responsive.css">
      <style>
        .text-danger-custom {
            color: #d32f2f;
        }
      </style>
   </head>
   <body>
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
        <section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                      <div class="col-sm-12 sign-in-page-data">
                          <div class="sign-in-from bg-primary rounded">
                          <h3 class="mb-0 text-center text-white" style="font-size: 35px;">Sign in</h3>
                            <?php if(isset($_SESSION['error'])) : ?>
                                <p class="text-danger-custom text-center" style="font-size: 15px;"><?= $_SESSION['error'] ?></p>
                            <?php else: ?>
                            <p class="text-center text-white" style="font-size: 20px;">Vui lòng đăng nhập</p>
                            <?php endif; ?>
                              <form action="<?= BASE_URL .'?act=check-login' ?>" method="POST" class="mt-4 form-text">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control mb-0 text-dark" id="" placeholder="Enter email" name="email">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Password</label>
                                      <a href="#" class="float-right text-dark" style="font-size: 10px;">Quên Mật Khẩu ?</a>
                                      <input type="text" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password" style="color: black;" name="password">
                                  </div>
                                  <div class="d-inline-block w-100">
                                      <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1" style="font-size: 15px;">Remember Me</label>
                                      </div>
                                  </div>
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-white d-block w-100 mb-2">Sign in</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <script src="./admin/asset/js/jquery.min.js"></script>
      <script src="./admin/asset/js/bootstrap.min.js"></script>
      <script src="./admin/asset/js/jquery.magnific-popup.min.js"></script>
      <script src="./admin/asset/js/custom.js"></script>
   </body>
</html>
<?php require_once './views/layout/footer.php' ?>
</body>
</html>