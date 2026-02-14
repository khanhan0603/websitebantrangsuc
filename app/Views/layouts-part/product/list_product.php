<!-- <?php
echo "<pre>";
print_r($productModel);
echo "</pre>";
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
       <script src="<?php echo _HOST_URL_PUBLIC; ?>/assets/js/jvscript.js" defer></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo _HOST_URL_PUBLIC; ?>/assets/css/style.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
      integrity="sha512-1PSKOgITy59xJ8Co8+NE6FZ+LOAZKjy+KY8iq064B3cyeY6wYHN3yt9PW0XpSrivlKMxe40PTKnXrLn29+fkDaog=="
      crossorigin="anonymous">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kadwa:wght@400;700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
.product_sanpham img {
    width: 100%;
    height: 300px; 
    object-fit: cover;
}
</style>

</head>
<body>
<div class="wrap">

     <div class="container" style="margin-top: 2rem;">
    <div class="container-newcollection">
  <div class="newcollection1">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/7452aa575b471de3a52a9133c538dd5c.jpg" alt="">
    
  </div>
  <div class="newcollection2">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/6693d993a8f2d4770551e435f02dac1a.jpg" alt="">
  </div>
  <div class="newcollection3 tall">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/88c550398ee111df2b24b15dfd3d46c9.jpg" alt="">
    <div class="newcollection3_text">New collection 2025</div>
  </div>
  <div class="newcollection4">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/1981189d2b3c75e964ade3dd4a129dd8.jpg" alt="">
  </div>
  <div class="newcollection5">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/bb2ffba2485f733034b45afbada6b5e3.jpg" alt="" class="newcollection5-anh1">
   <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/52a7c22a7a1353a9ffa7da00034ce717.jpg" alt="" class="newcollection5-anh2">
  </div>
</div>
  <div class="grid-container" style="margin-top: 5rem;">
  <?php
    foreach($productModel as $key => $item):
    ?>
    <div class="product_sanpham">
        <a href="/BanTrangSuc/product_detail?masanpham=<?php echo $item['masanpham']; ?>" class="product_link">
            <?php 
               if (!empty($item['hinhanh'])) {
                $mime = $item['loai_hinhanh']; // lấy trực tiếp
                $img  = base64_encode($item['hinhanh']);

                echo '<img src="data:' . $mime . ';base64,' . $img . '">';
                }
            ?>
            <p class="product_info"><?php echo $item['tensanpham']; ?></p>
            <p class="product_price"><?php echo number_format($item['dongia'],0,',','.'); ?> VND</p>
        </a>
        <i class="fas fa-plus icon_add" ></i>
    </div>
    <?php endforeach;?>
       </div>
    
    
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
    <div class="vetrangsuc">về trang sức TLA-Jew</div>
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
      