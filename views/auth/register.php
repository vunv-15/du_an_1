<?php require_once './views/layout/header.php' ?>
<?php require_once './views/layout/navbar.php' ?>

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
         <div id="loading-center"></div>
      </div>
      <section class="sign-in-page">
         <div class="container p-0">
            <div class="row no-gutters height-self-center">
               <div class="col-sm-12 align-self-center page-content rounded">
                  <div class="row m-0">
                     <div class="col-sm-12 sign-in-page-data">
                        <div class="sign-in-from bg-primary rounded p-4">
                           <h3 class="mb-3 text-center text-white" style="font-size: 35px;">Sign Up</h3>
                           <p class="text-center text-white mb-4" style="font-size: 15px;">Tạo tài khoản trang web</p>
                           <form action="<?= BASE_URL . '?act=them-tai-khoan' ?>" method="POST">
                              <!-- Full Name -->
                              <div class="form-group">
                                 <label for="fullName" class="text-white">Your Full Name</label>
                                 <input type="text" class="form-control mb-2 text-dark" id="fullName" name="ho_ten" 
                                       placeholder="Enter your full name" 
                                       value="<?= isset($_SESSION['old_data']['ho_ten']) ? htmlspecialchars($_SESSION['old_data']['ho_ten']) : '' ?>">
                                 <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                    <p class="text-danger-custom"><?= $_SESSION['error']['ho_ten'] ?></p>
                                 <?php } ?>
                              </div>

                              <!-- Email -->
                              <div class="form-group">
                                 <label for="email" class="text-white">Email Address</label>
                                 <input type="email" class="form-control mb-2 text-dark" id="email" name="email" 
                                       placeholder="Enter your email" 
                                       value="<?= isset($_SESSION['old_data']['email']) ? htmlspecialchars($_SESSION['old_data']['email']) : '' ?>">
                                 <?php if (isset($_SESSION['error']['email'])) { ?>
                                    <p class="text-danger-custom"><?= $_SESSION['error']['email'] ?></p>
                                 <?php } ?>
                              </div>

                              <!-- Password -->
                              <div class="form-group">
                                 <label for="password" class="text-white">Password</label>
                                 <input type="password" class="form-control mb-2 text-dark" id="password" name="mat_khau" 
                                       placeholder="Enter your password">
                                 <?php if (isset($_SESSION['error']['password'])) { ?>
                                    <p class="text-danger-custom"><?= $_SESSION['error']['password'] ?></p>
                                 <?php } ?>
                              </div>

                              <!-- Confirm Password -->
                              <!-- <div class="form-group">
                                 <label for="confirmPassword" class="text-white">Confirm Password</label>
                                 <input type="password" class="form-control mb-2" id="confirmPassword" name="mat_khau_xac_nhan" placeholder="Confirm your password" required>
                              </div> -->
                              <!-- Phone -->
                              <!-- <div class="form-group">
                                 <label for="phone" class="text-white">Phone Number</label>
                                 <input type="text" class="form-control mb-2" id="phone" name="so_dien_thoai" placeholder="Enter your phone number">
                              </div> -->
                              <!-- Date of Birth -->
                              <!-- <div class="form-group">
                                 <label for="dob" class="text-white">Date of Birth</label>
                                 <input type="date" class="form-control mb-2" id="dob" name="ngay_sinh">
                              </div> -->
                              <!-- Gender -->
                              <!-- <div class="form-group">
                                 <label for="gender" class="text-white">Gender</label>
                                 <select class="form-control mb-2" id="gender" name="gioi_tinh">
                                    <option value="Nam">Male</option>
                                    <option value="Nữ">Female</option>
                                    <option value="Khác">Other</option>
                                 </select>
                              </div> -->
                              <!-- Address -->
                              <!-- <div class="form-group">
                                 <label for="address" class="text-white">Address</label>
                                 <textarea class="form-control mb-2" id="address" name="dia_chi" placeholder="Enter your address"></textarea>
                              </div> -->
                              <!-- Terms -->
                              <div class="form-group custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                 <input type="checkbox" class="custom-control-input" id="terms">
                                 <label class="custom-control-label text-light" for="terms">
                                 Tôi đồng ý <a href="#" class="text-white" style="font-size: 15px;">Điều khoản và điều kiện</a>.
                                 </label>
                              </div>
                              <!-- Submit -->
                              <div class="sign-info text-center mt-4">
                                 <button type="submit" class="btn btn-white btn-block">Sign Up</button>
                                 <span class="text-dark d-inline-block mt-2">Already have an account? 
                                    <a href="sign-in.html" class="text-warning">Log In</a>
                                 </span>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <script src="./admin/asset/js/jquery.min.js"></script>
      <script src="./admin/asset/js/bootstrap.min.js"></script>
      <script src="./admin/asset/js/jquery.magnific-popup.min.js"></script>
      <script src="./admin/asset/js/custom.js"></script>
   </body>
   <?php require_once './views/layout/footer.php' ?>
</html>
<?php 
unset($_SESSION['error']);
unset($_SESSION['old_data']);
?>

