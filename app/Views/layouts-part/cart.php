
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo _HOST_URL_PUBLIC; ?>/assets/css/style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <div class="header">
            <div class="header1">Miễn phí vận chuyển cho những đơn hàng đầu tiên</div>
    <div class="list_item">
      <ul class="list">
        <li class="item">
          <button><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Group 8.svg" alt="" id="menu" onclick="menuIconclick()">
          </button>
        
                   <ul id="menu-list" class="hidden">
                            <li><a href="#" id="close-menu" onclick="closeMenuclick()">X</a></li>
                            <li><a href="home">home</a></li>
                            <li><a href="#">Accesories</a>
                            <i class="fas fa-caret-right"></i>
                            </li>
                            <li><a href="#">new in </a></li>
                             <li><a href="#">collection</a></li>
                            <li><a href="../Aboutus/aboutus.html">About Us</a></li>
                            <li>
                              <div class="menu-item">
                              <a href="../home/index.html" class="menu-item-text">TLA-Jew</a>
                              <div class="menu-icons">
                               <a href="#"><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/instagram-icon-white-on-black 1.png" alt="" class="menu-item-icon"></a>
                                <a href="#"><img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/tiktok-logo-tikok-icon-transparent-tikok-app-logo-free-png.png" alt="" class="menu-item-icon"></a>
                                </div>
                              </li>                        
                        </ul>
               
             <div class="accesories-list">
              <ul id="accesories-list-item" class="hidden1">
                <li class="accesories-item">
                  <i class="fas fa-caret-left"></i>
                  <a href="#">ACCESERIES </a>
                </li>
                <li class="accesories-item"> 
                  <form action="" method="get" >
                 <input type="button" class="submitsp"value="Tất cả sản phẩm" input type="button" value="Tất cả sản phẩm" onclick="window.location.href='<?php echo _HOST_URL.'/products' ;?>'">
                </form>
                    <form action="" method="post">
                 <input type="button" class="submitsp"value="Nhẫn" onclick="nhan()">
                </form>
                   <form action="" method="post">
                 <input type="button" class="submitsp"value="Vòng tay" onclick="vongtay()">
                </form>
                  <form action="" method="post">
                 <input type="button" class="submitsp"value="Dây chuyền" onclick="daychuyen()">
                </form>
                  <form action="" method="post">
                 <input type="button" class="submitsp"value="Đồng hồ" onclick="dongho()">
                </form>
                   <form action="" method="post">
                 <input type="button" class="submitsp"value="Bông tai" onclick="bongtai()">
                  </form>
                </li> 
              </ul>
              </div>
        </li>
        <a href="home" style="color: red;"><li class="item">TLA-Jew</li></a>
        <li class="item">
         <button onclick="window.location.href='/BanTrangSuc/search'"> <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Frame 248.svg" alt="" id="timkiem"></button>
        <button onclick="window.location.href='/BanTrangSuc/showProfileUser?email=<?php echo isset($_SESSION['email_khachhang']) ? $_SESSION['email_khachhang'] : '' ;?>'"> 
          <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/user.svg" alt="" id="user">
        </button>
        
        <button>
           <div class="icon_cart"><a href="cart" class="cart" >
            <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Shopping Cart.png" alt="" id="giohang">
            <span class="cart-count">
            <?php echo $count ?>
            </span>
          </a>
          </div>
        </button>
        </li>
        </li>
      </ul>
    </div>
    <div class="header-giohang">
        <div class="header-giohang-icon"><i class="fas fa-angle-left"></i></div>
        <div class="header-giohang-text">Giỏ hàng</div>
        <div class="header-giohang-soluong">
        <span id="count-of-cart"><?php echo $count; ?></span>
        <div class="">item(s)</div>
        </div>
        </div>
        </div>

        <div class="container">
              <div class="container-giohang">
    <section class="shoping-cart spad">

        <div class="row">
            <div class="col-lg-12">

                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th></th> <!-- Checkbox -->
                                <th class="shoping__product">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="addcart">

                            <?php if (!empty($cart)): ?>

                                <?php foreach ($cart as $id => $item): ?>
                                    <tr>
                                        <td class="shoping__cart__check">
                                            <input type="checkbox" class="product-check" data-id="<?php echo $id; ?>">
                                        </td>

                                        <td class="shoping__cart__item">
                                            <img src="data:<?php echo $item['loai_hinhanh']; ?>;base64,<?php echo base64_encode($item['hinhanh']); ?>" width="90">
                                            <h5><?php echo $item['tensanpham']; ?></h5>
                                        </td>

                                        <td class="shoping__cart__price">
                                            <?php echo number_format($item['dongia']); ?> đ
                                        </td>

                                        <td class="shoping__cart__quantity">
                                            <?php echo $item['soluong']; ?>
                                        </td>

                                        <td class="shoping__cart__total">
                                            <?php echo number_format($item['dongia'] * $item['soluong']); ?> đ
                                        </td>

                                        <td class="shoping__cart__item__close">
                                           <a href="/BanTrangSuc/remove_cart?masanpham=<?php echo $item['masanpham']; ?>">
                                                <span class="icon_close">X</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php endif; ?>
                            <?php if (empty($cart)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5" 
                                    style="font-size: 20px; font-weight: 600; color: #666;">
                                    Không có sản phẩm trong giỏ hàng
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="row mt-4">
            
            <div class="col-lg-6">
                <a href="home" class="primary-btn cart-btn">TIẾP TỤC MUA SẮM</a>
            </div>

            <div class="col-lg-6 text-end">
                <div class="shoping__checkout">
                    Tổng: <span id="shoping_checkout_total">0đ</span>
                </div>

                <button style="width: 100%; height: 3rem; background-color: red;" onclick="window.location.href='/BanTrangSuc/checkout?email=<?php echo isset($_SESSION['email_khachhang']) ? $_SESSION['email_khachhang'] : '' ;?>'">
                    Mua hàng (<span id="totalQuantity">0</span>)
                </button>
            </div>

        </div>

        </section>

    </div>  
            
        </div>

   
   <div class="text">Có thể bạn quan tâm</div>
             <div class="sanphamformkhachhang">
      <div class="hinh1">
         <a href="../chitietsanpham/nhanbac.html" class="sanphamquantam">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/Serenade_of_Butterfly_Orchid_Ring_in_Silver.webp" alt="" class="sp1">
      <div class="ttsp">
      <span class="ten">Nhẫn bạc họa tiết </span> <br>
       <span class="gia">350000</span>
       </div>
      </a>
       </div>
       <div class="hinh2">
         <a href="../chitietsanpham/bongtaimattroi.html" class="sanphamquantam">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/cf05147fc8f8e82510fc2f2ffcaa420e_900x.jpg" alt="" class="sp2">
      <div class="ttsp"> 
      <span class="ten">Bông tai mặt trời </span> <br>
       <span class="gia">590000</span>
       </div>
      </a>
       </div>
       <div class="hinh3">
         <a href="../chitietsanpham/daychuyenngusac.html" class="sanphamquantam">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/helius.webp" alt="" class="sp3">
      <div class="ttsp">
       <span class="ten">Dây chuyền ngũ sắc</span> <br>
       <span class="gia">700000</span>
       </div>
      </a>
       </div>
        <div class="hinh4">
         <a href="../chitietsanpham/vongvanthach.html" class="sanphamquantam">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/tu_1.jpg" alt="" class="sp4">
      <div class="ttsp">
      <span class="ten">Vòng vân thạch cổ điển</span> <br>
       <span class="gia">690000</span>
       </div>
      </a>
       </div>
       <div class="hinh5">
         <a href="../chitietsanpham/dongho.html" class="sanphamquantam">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/1e071d744e5f85d76949c5b93cfcf941.jpg" alt="" class="sp5">
      <div class="ttsp">
      <span class="ten">Đồng hồ Aurora Gold</span> <br>
       <span class="gia">900000</span>
       </div>
      </a>
       </div>
       <div class="hinh6">
         <a href="../chitietsanpham/setvongco.html" class="sanphamquantam">
      <img src="<?php echo _HOST_URL_PUBLIC; ?>/assets/images/9.1011443_035fe153-8d0f-4490-9a6e-dbfbce05751f.webp" alt="" class="sp6">
     <div class="ttsp">
      <span class="ten">Set vòng cổ (Gồm 3 dây) </span> <br>
       <span class="gia">999999</span>
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
<script>
    const menuList = document.getElementById("menu-list");
    const tamgiacphai = document.getElementsByClassName(" fa-caret-right");
    const accessoriesList = document.getElementById("accesories-list-item");
    const tamgiactrai = document.getElementsByClassName("fa-caret-left");

    function menuIconclick() {
    menuList.classList.toggle("hidden");
    }

    function closeMenuclick() {
    menuList.classList.add("hidden");
    accessoriesList.classList.add("hidden1");
    }

    for (let i = 0; i < tamgiacphai.length; i++) {
    tamgiacphai[i].addEventListener("click", function () {
        accessoriesList.classList.toggle("hidden1");
    });
    }
    for (let i = 0; i < tamgiactrai.length; i++) {
    tamgiactrai[i].addEventListener("click", function () {
        accessoriesList.classList.add("hidden1");
    });
    }

    document.addEventListener("change", function(e) {
        if (e.target.classList.contains("product-check")) {
            updateCartTotal();
        }
    });

  document.addEventListener("click", function(e) {
        if (e.target.classList.contains("remove-cart")) {

            const id = e.target.getAttribute("data-id");

            if (!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?")) {
                return;
            }

            fetch("/BanTrangSuc/ajax_remove_cart", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "masanpham=" + id
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {

                    // Xóa dòng sản phẩm
                    e.target.closest("tr").remove();

                    // cập nhật số lượng hiển thị
                    document.querySelectorAll("#count-of-cart, .cart-count")
                        .forEach(el => el.innerText = data.count);

                    // cập nhật tổng tiền
                    document.getElementById("shoping_checkout_total")
                        .innerText = data.total.toLocaleString("vi-VN") + " đ";

                    // cập nhật nút mua hàng
                    document.getElementById("totalQuantity").innerText = data.count;

                    // Nếu giỏ hàng trống → thêm dòng thông báo
                    if (data.count === 0) {
                        document.querySelector(".addcart").innerHTML = `
                            <tr>
                                <td colspan="5" class="text-center py-5" 
                                    style="font-size: 20px; font-weight: 600; color: #666;">
                                    Không có sản phẩm trong giỏ hàng
                                </td>
                            </tr>
                        `;
                    }
                }
            });
        }
    });
    function updateCartTotal() {
        let totalQty = 0;
        let totalPrice = 0;

        document.querySelectorAll(".addcart tr").forEach(function(row) {
            const check = row.querySelector(".product-check");
            if (check && check.checked) {
                const qty = parseInt(row.querySelector(".shoping__cart__quantity").innerText);
                const priceText = row.querySelector(".shoping__cart__total").innerText;
                const itemTotal = parseInt(priceText.replace(/\D/g, '')) || 0;

                totalQty += qty;
                totalPrice += itemTotal;
            }
        });

        document.getElementById("shoping_checkout_total").innerText = 
            totalPrice.toLocaleString("vi-VN") + " đ";

        document.getElementById("totalQuantity").innerText = totalQty;
    }
</script>
</body>

</html>
