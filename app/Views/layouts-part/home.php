<!-- <?php
  $rel =getSession('getInfo_KhachHang');
  echo "<pre>";
  print_r($rel);
  echo "</pre>";
  ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo _HOST_URL_PUBLIC; ?>/assets/css/style.css">
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
</head>
<body>
 <div class="wrap">
  
  <div class="container">
    <div class="anh"><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Ảnh chủ đạo lớn.jpg" alt="" class="anhchinh"></div>
    <div class="phanloaiphukien">
      <a href="../sanpham/DongHo.html" id=""><button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/f05aef8f3144e66386338ded2eff12d5.jpg" alt="" class="Đồng hồ">Đồng hồ</button></a>
      <a href="" id=""><button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/flower_earrings_28fffc8a-76ac-4a1c-8c76-4173113659b9.webp" alt="" class="bestseller">Best Seller</button></a>
       <a href="../sanpham/NHAN.html" id=""><button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Serenade_of_Butterfly_Orchid_Ring_in_Silver.webp" alt="" class="nhan">Nhẫn</button></a>
       <a href="../sanpham/BongTai.html" id=""><button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Blooming_Crossroad_Earrings_1ecdf136-d3ed-4d3d-9df9-ca3d47e225a0.webp" alt="" class="hoatai">Hoa tai</button></a>
       <a href="../sanpham/VongTay.html" id=""><button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/daisy-molecule-bracelet-in-silver-en-route-jewelry-1.webp" alt="" class="vongtay">Vòng tay</button></a>
      <a href="../sanpham/DayChuyen.html" id=""><button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/1_a0018791-86c5-45b9-b5bf-7d77f1146ce0.webp" alt="" class="daychuyen">Dây chuyền</button></a>
    </div>
    <div class="collection">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/iris0.7_1.webp" alt="" class="anhgiua">
    <button>collections 2025</button>
    </div>
    <div class="product">
      <div class="nhanbac" >
         <a href="#" class="motsosanpham">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Serenade_of_Butterfly_Orchid_Ring_in_Silver.webp" alt="" class="nhanbachoatiet">
       <div class="ten">Nhẫn bạc họa tiết </div> 
       <div class="gia">350000</div>
      </a>
       </div>
      <div class="nhanngoc">
        <a href="#" class="motsosanpham">
       <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/2be1248851dff548e9330d99e4eae52b_02c6736c-b222-4201-b954-6f93153394fc.webp" alt="" class="nhanbacdinhngocxanh">
        <div class="ten">Nhẫn bạc đính ngọc xanh</div>
        <div class="gia">350000</div>
       </a>
       </div>
     <div class="nhanluc">
       <a href="#" class="motsosanpham">
     <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/gold-midday-ring-en-route-jewelry-1.webp" alt="" class="nhanluchonglam">
        <div class="ten">Nhẫn lục hồng lam</div>
        <div class="gia">450000</div>
    </a>
        </div>
      <div class="vongtaymay">
        <a href="#" class="motsosanpham">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Chunky_Wave_Bangle3.webp" alt="" class="vongtaymayvang">
       <div class="ten">Vòng tay mây vàng</div>
       <div class="gia">1500000</div>
        </a>
      </div>
      <div class="bongtai">
        <a href="#" class="motsosanpham">
      <button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Blooming_Crossroad_Earrings_1ecdf136-d3ed-4d3d-9df9-ca3d47e225a0.webp" alt="" class="hoataihoanggia">
      <div class="ten">Hoa tai hoàng gia</div>
      <div class="gia">1900000</div>
      </a>
      </div>
      <div class="nhanbacdong">
        <a href="#" class="motsosanpham">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/twin-molten-ring-en-route-jewelry-3.webp" alt="" class="nhanbacdongchay">
       <div class="ten">Nhẫn bạc dòng chảy</div>
       <div class="gia">420000</div>
       </a>
       </div>
     </div>
    <div class="trending">-> Trending Now</div>
      <div class="grid-container-trending">
     <div class="item1"><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/daisy_molecule_f2366517-115e-4005-9fee-9303aaeb5690.webp" class="image"></div>
     <div class=" item2">
      <a href="#" class="product-link">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/a_0e4b11a1-4d7d-4cf1-a3a4-abfc665d76f8.webp" class="image">
      <div class="product-text">
        <span class="product-name">Dây chuyền chữ A</span><br>
        <span class="product-price">450000</span>
      </div>
      </a>
    </div>
     <div class=" item3">
       <a href="#" class="product-link">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/ser_3ae5c448-d44c-4d78-b856-85bc95545602.jpg" class="image">
       <div class="product-text">
        <span class="product-name">Dây chuyền chữ thập</span><br>
        <span class="product-price">950000</span>
      </div>
      </a>
    </div>
     <div class=" item4">
       <a href="#" class="product-link">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/helius.webp" class="image">
     <div class="product-text">
        <span class="product-name">Dây chuyền ngũ sắc</span><br>
        <span class="product-price">650000</span>
      </div>
      </a>
    </div>
 <div class="item5">
  <a href="#" class="product-link">
    <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/bee_2e928f90-6980-4925-a65f-6331a985a934.webp" class="image">
    <div class="product-text">
      <span class="product-name">Dây chuyền con ong</span><br>
      <span class="product-price">450000</span>
    </div>
  </a>
</div>

</div>
    </div>
  <div class="footer">
  <div class="thongtindichvu">
    <div class="thongtin">Tư vấn 24/7</div>
    <div class="thongtin">Bảo hành 100 ngày</div>
    <div class="thongtin">Giá cả hợp lý</div>
    <div class="thongtin">Hỗ trợ đổi trả trong vòng 15 ngày</div>
    <div class="thongtin">Quà tặng kèm đơn hàng trên đ500.000</div>
  </div>
  <div class="thongtinlienlac">
    <div class="tenshop">TLA-Jew</div>
    <div class="vetrangsuc" onclick="aboutus">Về trang sức TLA-Jew</div>
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
