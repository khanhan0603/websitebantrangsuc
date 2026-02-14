<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo _HOST_URL_PUBLIC ?>/assets/css/style.css">
    <script src="/Giaodienweb/JS/myjs.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
      integrity="sha512-1PKOgITy59xJ8Co8+NE6FZ+LOAZKjy+KY8iq064B3cyeY6wYHN3yt9PW0XpSrivlKMxe40PTKnXrLn29+fkDaog=="
      crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="../script/jvscript.js" defer></script>

</head>
<body>
 <div class="wrap">

  <div class="container" >
    <form action="" method="POST" >
   <div class="container-giaohang" style="  margin-top: 13rem !important;">
  
    <h3>Thông tin giao hàng</h3>
    <table>
      <tr>
        <td>Họ và tên:</td>
        <td><input type="text" id="hovaten" name="hoten" value="<?php echo $khachhang['hoten']; ?>"></td>
      </tr>
      <tr>
        <td>Số điện thoại</td>
        <td><input type="tel" id="sodienthoai" name="sdt" value="<?php echo $khachhang['sdt']; ?>"></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><input type="email" id="email" name="email" value="<?php echo $khachhang['email']; ?>"> </td>
      </tr>
      <tr>
        <td>Địa chỉ giao hàng:</td>
        <td><input type="text" id="diachi" name="diachi" value="<?php echo $khachhang['diachi']; ?>"></td>
      </tr>
    </table>
   </div>
    <div class="hoadon">
      <table class="addpay">
        <tr>
          <td colspan="3">Hóa đơn của bạn</td>
        </tr>
        <tr>
          <td>Sản phẩm</td>
          <td>Số lượng</td>
          <td>Đơn giá</td>
        </tr>
        <?php if(!empty($cart)) ?>
        <?php foreach($cart as $id=>$item): ?>
        <tr>
          <td name="proname"><?php echo $item['tensanpham']; ?></td>
          <td name="prosl"><?php echo $item['soluong']; ?></td>
          <td name="price"><?php echo number_format($item['dongia']); ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
      <div class="hoadon_check_thanhtoan">
        <input type="radio" id="thanhtoan" name="radio_thanhtoan" value="1" checked>Thanh toán khi nhận hàng<br>
              <div class="total_dathang">
        <div class="hoadon_total">Tổng tiền: <span id="total"><?php echo number_format($data['total']); ?></span></div>
        <div class="hoadon_btn_dathang"><button type="submit" style="background-color: red;">Đặt hàng</button></div>
    </div>
    </div>
    </form>
    </div>
  <div class="footer" >
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
  </div> 
  
</body>
</html>
