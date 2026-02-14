function homepage() {
  window.location.href = "home";
}
function user() {
  const isLoggedIn = localStorage.getItem("isLoggedIn");
  if (isLoggedIn === "true") {
    // Nếu đã đăng nhập, chuyển hướng đến trang cá nhân
    window.location.href = "/Giaodienweb/User/index.html";
  } else {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    window.location.href = "/Giaodienweb/đangnhap/login.html";
  }
}
function cart() {
  const isLoggedIn = localStorage.getItem("isLoggedIn");
  if (isLoggedIn === "true") {
    // Nếu đã đăng nhập, chuyển hướng đến trang giỏ hàng
    window.location.href = "/Giaodienweb/giohang/giohang.html";
  } else {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    window.location.href = "/Giaodienweb/đangnhap/login.html";
  }
}
function aboutus() {
  window.location.href = "/Giaodienweb/Aboutus/aboutus.html";
}
function sanpham(btn) {
    console.log("sanpham chạy!", btn);
    console.log("URL:", btn.dataset.url);
    window.location.href = btn.dataset.url;
}
function search() {
  window.location.href = "/Giaodienweb/timkiem/timkiem.html";
}
function nhan() {
  window.location.href = "/Giaodienweb/sanpham/NHAN.html";
}
function vongtay() {
  window.location.href = "/Giaodienweb/sanpham/Vongtay.html";
}
function dongho() {
  window.location.href = "/Giaodienweb/sanpham/DongHo.html";
}
function bongtai() {
  window.location.href = "/Giaodienweb/sanpham/BongTai.html";
}
function buy() {
  // Nếu đã đăng nhập, chuyển hướng đến trang thanh toán
  // Lấy tên, giá, số lượng sản phẩm từ HTML
  var name = document.querySelector(".product-details h3").textContent;
  var priceText = document.querySelector(".product-details h4").textContent;
  var qty = parseInt(
    document.querySelector("input.form-control.text-center.mx-2").value,
    10
  );

  // Chuyển đổi giá về số nếu cần (loại bỏ ký tự không phải số)
  var price = Number(priceText.replace(/[^\d]/g, ""));
  var total = price * qty;

  // Tạo object sản phẩm
  var product = {
    name: name,
    price: price,
    qty: qty,
    total: total,
  };

  // Lưu vào orderItems (dạng mảng, chỉ 1 sản phẩm)
  localStorage.setItem("orderItems", JSON.stringify([product]));

  // Chuyển hướng sang trang thanh toán
  window.location.href = "../thanhtoan/index.html";
}
function tru2() {
    var input = document.getElementById("soluong");
    var sl = parseInt(input.value, 10) || 1;

    if (sl > 1) {
        input.value = sl - 1;
    }
}

function cong2() {
    var input = document.getElementById("soluong");
    var sl = parseInt(input.value, 10) || 1;

    input.value = sl + 1;
}
