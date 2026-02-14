<!-- <?php
  if (session_status() === PHP_SESSION_NONE) session_start();

  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nhẫn ngọc</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="<?php echo _HOST_URL_PUBLIC; ?>/assets/js/jvscript.js" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo _HOST_URL_PUBLIC; ?>/assets/css/style.css">
  <script src="<?php echo _HOST_URL_PUBLIC; ?>/assets/js/myjs.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgITy59xJ8Co8+NE6FZ+LOAZKjy+KY8iq064B3cyeY6wYHN3yt9PW0XpSrivlKMxe40PTKnXrLn29+fkDaog=="
        crossorigin="anonymous" rel="stylesheet">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="wrap">
    <?php require_once __DIR__ . '/../../parts/header.php'; ?>
  <div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb bg-white p-0">
        <li class="breadcrumb-item"><a href="../home/index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Accessories</a></li>
        <li class="breadcrumb-item"><a href="../sanpham/index.html">Tất cả sản phẩm</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nhẫn ngọc</li>
      </ol>
    </nav>

    <!-- Product Detail Section -->
    <!-- Ảnh sản phẩm -->
   <div class="text-center mb-4">
    <?php 
        if (!empty($product['hinhanh'])) {
            $mime = $product['loai_hinhanh'];
            $img  = base64_encode($product['hinhanh']);
            echo '<img src="data:' . $mime . ';base64,' . $img . '" style="margin-right: 100px; width:1300px;object-fit:cover;">';
        }
    ?>
</div>


    <!-- Thông tin sản phẩm -->
    <div class="product-details px-3">
      <h3 class="fw-semibold"><?php echo htmlspecialchars($product['tensanpham']); ?></h3>
      <h4 class="text-danger fw-bold mb-3"><?php echo number_format($product['dongia'], 0, ',', '.') . '₫'; ?></h4>

      <!-- Bộ đếm -->
      <div class="d-flex align-items-center mb-3">
        <button class="btn btn-outline-dark px-3" onclick="tru2()">−</button>
        <input type="text" class="form-control text-center mx-2" id="soluong" value="1" style="width: 60px;">
        <button class="btn btn-outline-dark px-3" onclick="cong2()">+</button>
      </div>

      <!-- Nút -->
      <div class="d-grid gap-2 mb-4">
        <form action="/BanTrangSuc/add_to_cart" method="POST">
            <input type="hidden" name="masanpham" value="<?php echo $product['masanpham']; ?>">
            <input type="hidden" name="soluong" id="soluong-input" value="1">

            <button type="submit" class="btn btn-warning w-100 mb-2">ADD TO BAG</button>
        </form>
        <button class="btn btn-dark w-100" onclick="buy()">BUY NOW</button>
      </div>

      <!-- Mô tả -->
      <div class="product-description">
        <h5 class="fw-bold mb-2">Details</h5>
        <p><?php echo nl2br(htmlspecialchars($product['mota'])); ?></p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer-home">
    <div class="thongtindichvu">
      <div class="thongtin">Tư vấn 24/7</div>
      <div class="thongtin">Bảo hành 100 ngày</div>
      <div class="thongtin">Giá cả hợp lý</div>
      <div class="thongtin">Hỗ trợ đổi trả trong vòng 15 ngày</div>
      <div class="thongtin">Quà tặng kèm đơn hàng trên đ500.000</div>
    </div>
    <div class="thongtinlienlac">
      <div class="tenshop">TLA-Jew</div>
      <div class="vetrangsuc" onclick="aboutus()">Về trang sức TLA-Jew</div>
      <div class="contact-container">
        <div class="contact-title">Contact us</div>
        <div class="contact-grid">
          <div class="lienlac">Hotline: 1900 063 167</div>
          <div class="lienlac">Instagram: TLA Jew</div>
          <div class="lienlac">Email: TLAJew@gmail.com</div>
          <div class="lienlac">TikTok: TLA Jew</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
