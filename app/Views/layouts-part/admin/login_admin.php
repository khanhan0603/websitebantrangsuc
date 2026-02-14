<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="/BanTrangSuc/public/assets/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
      function verifyUser(event) {
        event.preventDefault(); // Ngăn form submit mặc định

        // Xóa thông báo lỗi cũ
        $("#username-error").hide().text("");

        //Lấy giá trị từ các input
        const username = $("input[type='text']").val();
        const password = $("input[type='password']").val();

        // Kiểm tra tên đăng nhập và mật khẩu
        $.get(
          "https://682de193746f8ca4a47afeb2.mockapi.io/signups",
          function (users) {
            const user = users.find(
              (user) => user.username === username && user.password === password
            );

            if (user) {
              alert("Đăng nhập thành công!");
              // Lưu thông tin người dùng vào localStorage
              localStorage.setItem("isLoggedIn", "true");
              localStorage.setItem("username", user.username);
              localStorage.setItem("email", user.email);
              localStorage.setItem("password", user.password);
              localStorage.setItem("hoten", user.hoten);
              localStorage.setItem("gioitinh", user.gioitinh);
              localStorage.setItem("sdt", user.sdt);
              localStorage.setItem("diachi", user.diachi);

              // Chuyển hướng đến trang homepage
              window.location.href = "/Giaodienweb/home/index.html"; // Chuyển hướng đến trang homepage
            } else {
              alert("Tên đăng nhập hoặc mật khẩu không đúng.");
              return;
            }
          }
        );
      }
    </script> -->
  </head>
  <body>
    <?php
    $msg=getSessionFlash('msg');
    $msg_type=getSessionFlash('msg_type');
    $errorsArr=getSessionFlash('errors');
    ?>
    <div class="login">
      <div class="login-container">
        <img onclick="history.back();" src="<?php echo _HOST_URL_PUBLIC;?>/assets/images/close.png" alt="" style="width: 30px" align="right" />
        <img src="<?php echo _HOST_URL_PUBLIC;?>/assets/images/cart.png" alt="Cart Icon" />
        <form method="post" action="" >
          <?php if (!empty($msg)): ?>
              <div class="alert alert-<?php echo $msg_type ?? 'danger'; ?>">
                  <?php echo $msg; ?>
              </div>
          <?php endif; ?>

          <input type="text" 
          placeholder="email" 
          name="email"
          style="background-image: url('<?php echo _HOST_URL_PUBLIC;?>/assets/images/user.png')"
          />
          <?php if (!empty($errorsArr['email'])): ?>
              <?php foreach ($errorsArr['email'] as $err): ?>
                  <p class="error-text"><?php echo $err; ?></p>
              <?php endforeach; ?>
          <?php endif; ?>

          <input
            type="password"
            placeholder="password"
            name="password"
            style="background-image: url('<?php echo _HOST_URL_PUBLIC;?>/assets/images/lock.png')"
          />
          <?php if (!empty($errorsArr['password'])): ?>
              <?php foreach ($errorsArr['password'] as $err): ?>
                  <p class="error-text"><?php echo $err; ?></p>
              <?php endforeach; ?>
          <?php endif; ?>
          <a href="#">Forgot password?</a>
          <button type="submit">LOGIN</button>
        </form>
        <p class="signup">
          Don't have an account?
          <a href="BanTrangSuc/register">Sign up</a>
        </p>
      </div>
    </div>
  </body>
</html>
