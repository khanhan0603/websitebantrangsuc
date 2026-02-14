<?php
$router->get('/','HomeController@landingpage');
$router->get('/home','HomeController@home');

//Admin
//$router->get('/dashboard','AdminController@dashboard');
$router->get('/thongtinadmin','AdminController@thongTinAdmin');
$router->get('tatcadonhang_admin','AdminController@tatcadonhang_admin');
$router->post('/update_admin','AdminController@updateAdmin');
$router->get('/logout_admin','AuthController@logout_admin');

$router->get('/login','AuthController@showlogin_admin');
$router->post('/login','AuthController@login_admin');
// Tất cả sản phẩm (admin)
//$router->get('/', 'SanPhamADController@index');
$router->get('/sanphamcuatoi','SanPhamADController@sanphamcuatoi');
// Thêm sản phẩm (admin)
$router->get('/admin/add','SanPhamADController@showAdd');
$router->post('/admin/add','SanPhamADController@add');
// Cập nhật sản phẩm
$router->get('/admin/update','SanPhamADController@showedit');
$router->post('/admin/update','SanPhamADController@edit');

// Xóa sản phẩm
$router->get('/admin/delete', 'SanPhamADController@delete');

//Khách hàng
$router->get('/register','AuthController@showRegister_khachhang');
$router->post('/register','AuthController@register');
$router->get('/login_khachhang','AuthController@showlogin_khachhang');
$router->post('/login_khachhang','AuthController@login_khachhang');
$router->get('/logout_khachhang','AuthController@logout_khachhang');
$router->get('/showProfileUser','KhachHangController@showProfileUser');
$router->post('/showProfileUser','KhachHangController@updateProfileUser');

//Product
$router->get('/products','ProductController@list');
$router->get('/product_detail','ProductController@detail');

// Loại sản phẩm
$router->get('/loaisanpham','LoaiSPController@loaisanpham');
$router->get('/admin/addLSP','LoaiSPController@showAddLSP');
$router->post('/admin/addLSP','LoaiSPController@addLSP');
$router->get('/admin/updateloai','LoaiSPController@showeditLSP');
$router->post('/admin/updateloai','LoaiSPController@editLSP');
$router->get('/admin/deleteloai','LoaiSPController@deleteloai');

//Cart
$router->get('/cart','CartController@showCart');
$router->post('/add_to_cart','CartController@addToCart');
$router->get('/remove_cart','CartController@removeCart');

//Checkout
$router->get('/checkout','DonHangController@showCheckout');
$router->post('/checkout','DonHangController@processCheckout');
$router->get('/order_confirmation', 'DonHangController@orderConfirmation');
$router->get('/clear_order', 'DonHangController@clearOrder');

//Search
$router->get('/search','ProductController@search');
$router->post('/search','ProductController@searchSP');












