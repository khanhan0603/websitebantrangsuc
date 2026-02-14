<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Quản lý đơn hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap">
  <style>
    body {
      background-color: #f5f5f5;
      font-family: 'Arial', sans-serif;
      width: 100%;
      cursor: pointer;
    }
    .hidden{
      display: none !important;
    }
    .admin {
      width: 100%;
      height: 5rem;
      background-color: rgb(248, 245, 245);
      display: flex;
      align-items: center;
      border-bottom: 1px solid #ccc;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1001;
    }

    .admin ul {
      margin-top: 1rem;
      display: flex;
      list-style: none;
      width: 100%;
      align-items: center;
    }

    .admin li {
      margin-right: 1rem;
    }

    .fa-arrow-left {
      font-size: 25px;
    }

    .admin li:nth-child(2) {
      font-size: 30px;
      margin-left: 1rem;
    }
     .admin li:nth-child(2) a {
      text-decoration: none;
      color: black;
    }
    .admin li a.active {
  color: gray !important;
  font-weight: normal;
  pointer-events: none;
  opacity: 0.6;
}
    .admin-item {
      margin-left: auto;
      display: flex;
      align-items: center;
      position: relative;
      white-space: nowrap;
    }

    .admin-item i {
      font-size: 30px;
      color: black;
      cursor: pointer;
    }

    .admin-item span {
      margin-left: 5rem;
      font-size: 35px;
      font-weight: 600;
      background: linear-gradient(90deg, #FB0505 12%, #EE7A14 100%);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-family: "Londrina Solid", sans-serif;
    }

    .admin_menu {
      display: none; 
      position: absolute;
      top: 100%;
      right: 0;
      margin-top: 1rem;
      background-color: white;
      border: 2px solid #f0f0f0;
      border-radius: 10px;
      padding: 20px;
      width: 360px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      justify-items: center;
      margin-right: 5rem;
    }

    .admin_menu_item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      font-size: 20px;
    }
    .admin-item a{
      text-decoration: none;
      color: black;
    }
    .admin_menu_item img {
      width: 60px;
      height: 60px;
      object-fit: contain;
      margin-bottom: 8px;
    }

    .container-main {
      margin: 30px auto;
      margin-top: 7rem; /* thêm dòng này để tránh bị che */
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      font-size: 20px;
    }

    .tab-header {
      display: flex;
      gap: 20px;
      border-bottom: 2px solid #eee;
      margin-bottom: 15px;
    }

    .tab-header .tab {
      padding-bottom: 10px;
      cursor: pointer;
      font-weight: 500;
    }
    .tab-header .tab:last-child{
      background-color: red;
      color: white;
      margin-left: auto;
      margin-bottom: 0.5rem;
      border-radius: 5px;
    }
     .tab-header .tab:last-child a{
      text-decoration: none;
      color: white;
      margin-left: auto;
    }
    .tab.active {
      border-bottom: 3px solid #ee4d2d;
      color: #ee4d2d;
    }

    .search-filters {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 15px;
    }

    .product-table th, .product-table td {
      vertical-align: middle;
      text-align: center;
    }

    .product-name {
      text-align: left;
      display: flex;
      align-items: center;
      padding: 0 !important;
      margin: 0 !important;
    }

    .product-name img {
      width: 100%;
      max-width: 50px;
      height: 50px;
      object-fit: cover;
      margin-left: 1rem;
    }

    .text-orange {
      color: #f0ad4e;
      font-size: 0.9rem;
    }

    .action-links a {
      display: block;
      color: #007bff;
      text-decoration: none;
    }

    .action-links a:hover {
      text-decoration: underline;
    }

    .thanhcongcu {
      width: 4rem;
      background-color: rgb(248, 245, 245);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 1rem;
      position: fixed;
      top: 6rem;
      right: 0;  
      z-index: 1000;
      height: calc(100% - 6rem);
      border-left: 1px solid #ccc;
    }

    .thanhcongcu li {
      margin: 1rem 0;
      font-size: 30px;
      text-align: center;
      list-style-type: none;
      margin-left: -2rem;
    }

    .mess {
      width: 30px;
      height: 30px;
    }
  </style>
</head>
<body>
  <div class="admin">
    <ul>
      <li><a href="../landing/index.html"><i class="fas fa-arrow-left"></i></a></li>
      <li><a href="../admin/shopcuatoi.html">Shop của tôi/</a>
      <a href="../admin/sanphamcuatoi.html" class="active">Sản phẩm</a></li>
    </ul>
    <div class="admin-item">
      <div id="qr-wrapper">
        <i class="fas fa-qrcode" id="toggleMenu" onclick="menuclick()"></i>
        <div class="admin_menu hidden" id="adminMenu">
          <div class="admin_menu_item">
            <img src="../img/document.png" alt="">
           <a href="../admin/tatca.html"><p>Tất cả</p></a>
          </div>
          <div class="admin_menu_item">
            <img src="../img/shopping-bag.png" alt="">
            <a href="../admin/sanphamcuatoi.html"><p>Tất cả sản phẩm</p></a>
          </div>
          <div class="admin_menu_item">
            <img src="../img/money-bag.png" alt="">
            <p>Số dư ví</p>
          </div>
          <div class="admin_menu_item">
            <img src="../img/gear.png" alt="">
            <p>Cài đặt</p>
          </div>
        </div>
      </div>
      <span>TLA-Jew</span>
    </div>
  </div>

  <!-- Nội dung chính -->
  <div class="container container-main">
    <h4>Sản phẩm</h4>

    <div class="tab-header">
      <div class="tab active">Tất cả</div>
      <div class="tab">Đang hoạt động (1)</div>
      <div class="tab">Vi phạm (0)</div>
      <div class="tab">Chờ duyệt (0)</div>
      <div class="tab">Chưa được đăng (0)</div>
      <div class="tab"><a href="../admin/them.html">+ Thêm sản phẩm</a></div>
    </div>

    <div class="search-filters">
      <input class="form-control w-25" placeholder="Tìm tên, SKU, ID sản phẩm">
      <input class="form-control w-25" placeholder="Ngành hàng sản phẩm">
      <select class="form-select w-25">
        <option>Loại sản phẩm</option>
      </select>
      <button class="btn btn-danger">Áp dụng</button>
      <button class="btn btn-outline-secondary">Đặt lại</button>
    </div>

    <p><strong>1 Sản phẩm</strong> | Hạn mức đăng bán: 1000</p>

    <table class="table product-table table-bordered">
      <thead>
        <tr>
          <th><input type="checkbox" /></th>
          <th class="product-name">Tên sản phẩm</th>
          <th>Giá</th>
          <th>Kho hàng</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/a_0e4b11a1-4d7d-4cf1-a3a4-abfc665d76f8.webp" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Dây chuyền chữ A</strong><br>
          </td>
          <td>₫500000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
        <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/bee_2e928f90-6980-4925-a65f-6331a985a934.webp" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Dây chuyền con ong</strong><br>
          </td>
          <td>₫600000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/Serenade_of_Butterfly_Orchid_Ring_in_Silver.webp" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Nhẫn bạc họa tiết</strong><br>
          </td>
          <td>₫350000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/nhẫn đính đá.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Nhẫn đính đá</strong><br>
          </td>
          <td>₫595000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/vòng vân thạch cổ điển.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Vòng vân thạch cổ điển</strong><br>
          </td>
          <td>₫690000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/helius.webp" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Dây chuyền ngũ sắc</strong><br>
          </td>
          <td>₫700000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/đồng hồ.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Đồng hồ Aurora Gold(Nữ)</strong><br>
          </td>
          <td>₫900000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/ser_3ae5c448-d44c-4d78-b856-85bc95545602.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Dây chuyền chữ thập</strong><br>
          </td>
          <td>₫900000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/f05aef8f3144e66386338ded2eff12d5.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Đồng hồ vintage</strong><br>
          </td>
          <td>₫450000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/bông tai hoa mai.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Bông tai hoa mai</strong><br>
          </td>
          <td>₫500000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/bông tai mặt trời.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Bông tai mặt trời</strong><br>
          </td>
          <td>₫590000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/nhẫn ngọc.jpg" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Nhẫn ngọc</strong><br>
          </td>
          <td>₫500000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/9.1011443_035fe153-8d0f-4490-9a6e-dbfbce05751f.webp" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Set vòng cổ(Gồm 3 vòng)</strong><br>
          </td>
          <td>₫999999</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
         <tr>
          <td><input type="checkbox" /></td>
          <td class="product-name">
            <img src="../img/daisy-molecule-bracelet-in-silver-en-route-jewelry-1.webp" alt="Ảnh" class="me-2" style="width:50px;height:50px;">
            <strong>Lắc tay bạc</strong><br>
          </td>
          <td>₫450000</td>
          <td>50</td>     
          <td class="action-links">
            <a href="#">Cập nhật</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>

  <div class="thanhcongcu">
    <ul>
      <li><i class="fas fa-cog"></i></li>
      <li><i class="fas fa-bell"></i></li>
      <li><img src="../img/messenger.png" alt="Messenger" class="mess"></li>
    </ul>
  </div>
  <script src="../script/jvscript.js"></script>
</body>
</html>
