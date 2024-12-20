<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sign in Admin</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <style>
         body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
         }
         .sign-in-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 40px 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 380px;
         }
         .sign-in-card h3 {
            color: #1e3c72;
            font-weight: bold;
            margin-bottom: 20px;
         }
         .form-control {
            border-radius: 5px;
            box-shadow: none;
         }
         .btn-primary {
            background-color: #1e3c72;
            border: none;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
         }
         .btn-primary:hover {
            background-color: #16325c;
         }
         .forgot-password {
            color: #1e3c72;
            font-size: 14px;
            text-decoration: none;
         }
         .forgot-password:hover {
            text-decoration: underline;
         }
         .text-danger-custom {
            color: #d32f2f;
         }
         .input-group-text {
            cursor: pointer;
         }
      </style>
   </head>
   <body>
      <div class="sign-in-card">
         <!-- Header -->
         <h3 class="text-center">Sign In</h3>
         <!-- Notification -->
         <?php if (isset($_SESSION['error'])) { ?>
            <p class="text-danger-custom text-center"><?= $_SESSION['error'] ?></p>
         <?php } else { ?>
            <p class="text-muted text-center">Vui lòng đăng nhập để vào Admin</p>
         <?php } ?>
         <!-- Form -->
         <form action="<?= BASE_URL_ADMIN . '?act=check-login-admin' ?>" method="POST">
            <div class="form-group">
               <label for="email">Email Address</label>
               <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="form-group">
               <label for="password">Password</label>
               <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                  <div class="input-group-append">
                     <span class="input-group-text" id="togglePassword">
                        <i class="nav-icon fas fa-eye-slash"></i>
                     </span>
                  </div>
               </div>
            </div>
            <div class="form-group d-flex justify-content-between">
               <div>
                  <input type="checkbox" id="remember" name="remember">
                  <label for="remember">Remember me</label>
               </div>
               <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
         </form>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      <script>
         // Toggle Password Visibility
         const togglePassword = document.querySelector("#togglePassword");
         const passwordInput = document.querySelector("#password");

         togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            this.innerHTML = type === "password" ? '<i class="nav-icon fas fa-eye-slash"></i>' : '<i class="nav-icon fas fa-eye-slash"></i>';
         });
      </script>
   </body>
</html>
