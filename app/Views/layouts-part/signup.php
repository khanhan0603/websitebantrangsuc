<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký</title>
    <link rel="stylesheet" href="<?php echo _HOST_URL_PUBLIC; ?>/assets/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function createUser(event) {
        event.preventDefault(); // Ngăn form submit mặc định
        // Xóa thông báo lỗi cũ
        $("#username-error").hide().text("");
        $("#email-error").hide().text("");
        //Lấy giá trị từ các input
        const username = $("input[type='text']").val();
        const email = $("input[type='email']").val();
        const password = $("input[type='password']").val();

        //Kiểm tra trường trống
        if (username === "" || email === "" || password === "") {
          alert("Vui lòng điền đầy đủ thông tin.");
          return;
        }

        let hasError_1 = false;
        //Kiểm tra tính hợp lệ của tên đăng nhập và email
        // Tên đăng nhập phải từ 3 ký tự trở lên, gồm cả chữ cái và số, không chứa ký tự đặc biệt
        const usernameRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{3,}$/;
        //Kiểm tra định dạng email hợp lệ (phải có ký tự trước và sau dấu @, có dấu chấm ở phần domain, không chứa khoảng trắng).
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!usernameRegex.test(username)) {
          $("#username-error")
            .text("Tên đăng nhập không hợp lệ. Vui lòng thử lại.")
            .show();
          hasError_1 = true;
        }
        if (!emailRegex.test(email)) {
          $("#email-error")
            .text("Email không hợp lệ. Vui lòng thử lại.")
            .show();
          hasError_1 = true;
        }
        if (hasError_1) return;

        // Kiểm tra trùng tên đăng nhập trước khi thêm
        $.get(
          "https://682de193746f8ca4a47afeb2.mockapi.io/signups",
          function (users) {
            const exists = users.some((user) => user.username === username);
            const exists_email = users.some((user) => user.email === email);

            let hasError = false;
            if (exists) {
              $("#username-error")
                .text("Đã tồn tại tên đăng nhập. Vui lòng chọn tên khác.")
                .show();
              hasError = true;
            }
            if (exists_email) {
              $("#email-error")
                .text("Đã tồn tại email. Vui lòng chọn email khác.")
                .show();
              hasError = true;
            }
            if (hasError) return;

            $.ajax({
              url: "https://682de193746f8ca4a47afeb2.mockapi.io/signups",
              type: "POST",
              data: {
                username: $("input[type='text']").val(),
                email: $("input[type='email']").val(),
                password: $("input[type='password']").val(),
              },
              success: function (response) {
                alert("Đăng ký thành công!");
                window.location.href = "/Giaodienweb/đangnhap/login.html"; // Chuyển hướng đến trang homepage
              },
              error: function (error) {
                alert("Error creating user. Please try again.");
              },
            });
          }
        );
      }
    </script>
  </head>
  <body>
   <?php
    $msg=getSessionFlash('msg');
    $msg_type=getSessionFlash('msg_type');
    $errorsArr=getSessionFlash('errors');
    ?>
    <div class="signup-container">
      <img onclick="history.back();" src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/close.png" alt="" style="width: 30px" align="right" />
      <h1>Create an account</h1>
      <p>Already have an account? <a href="BanTrangSuc/login_khachhang">Log in</a></p>
      <!-- Không action nữa vì khi nhấn submit form sẽ gửi dữ liệu đến cùng một URL (register) có phương thức POST  -->
      <form method="POST" action="" enctype="multipart/form-data">
        <?php if (!empty($msg)): ?>
              <div class="alert alert-<?php echo $msg_type ?? 'danger'; ?>">
                  <?php echo $msg; ?>
              </div>
          <?php endif; ?>
        <input type="text" placeholder="Create a username" name="username" value="<?php echo htmlspecialchars($errorsArr['old']['username'] ?? ''); ?>" />
        <span
          id="username-error"
          style="color: red; font-size: 13px; display: none"
        ></span>
        <?php if (!empty($errorsArr['username'])): ?>
              <?php foreach ($errorsArr['username'] as $err): ?>
                  <p class="error-text"><?php echo $err; ?></p>
              <?php endforeach; ?>
        <?php endif; ?>
        <p class="terms">
          Từ 3 ký tự trở lên, gồm cả chữ cái và số, không chứa ký tự đặc biệt
        </p>
        <input
          type="email"
          placeholder="What's your email?"
          name="email"
          value="<?php echo htmlspecialchars($errorsArr['old']['email'] ?? ''); ?>"
          style="margin-bottom: 20px"
        />
        <span
          id="email-error"
          style="color: red; font-size: 13px; display: none"
        ></span>
        <?php if (!empty($errorsArr['email'])): ?>
              <?php foreach ($errorsArr['email'] as $err): ?>
                  <p class="error-text"><?php echo $err; ?></p>
              <?php endforeach; ?>
        <?php endif; ?>
        <input type="password" placeholder="Create a password" name="password" />
        <p class="terms">Từ 4 ký tự trở lên, không chứa khoảng trắng</p>
        <?php if (!empty($errorsArr['password'])): ?>
              <?php foreach ($errorsArr['password'] as $err): ?>
                  <p class="error-text"><?php echo $err; ?></p>
              <?php endforeach; ?>
        <?php endif; ?>
        <button type="submit">CREATE AN ACCOUNT</button>
      </form>
      <p class="policy">
        By creating an account, you agree to the
        <a href="#">Terms of use</a> and <a href="#">Privacy Policy</a>.
      </p>
      <div class="social-buttons">
        <button>
          <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Social media logo.png " alt="Facebook" />
          Facebook
        </button>
        <button>
          <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Google logo.png" alt="Google" />
          Google
        </button>
        <button>
          <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Apple logo.png" alt="Apple" />
          Apple
        </button>
      </div>
    </div>
  </body>
</html>
