<?php
session_start();
// require_once './configs/config.php';
// require_once './configs/database.php';
//Load tất cả file trong thư mục configs, không cần phải require từng file
foreach (glob(__DIR__ . '/configs/*.php') as $filename){
    require_once $filename;
}

// require_once './public/core/CoreModel.php';
// require_once './public/core/BaseController.php';
//Load tất cả file trong thư mục core
foreach (glob(__DIR__ . '/core/*.php') as $filename){
    require_once $filename;
}
// require_once './app/Models/Admins.php';
foreach (glob(__DIR__ . '/app/Models/*.php') as $filename){
    require_once $filename;
}
// require_once './app/Controllers/AuthController.php';
foreach (glob(__DIR__ . '/app/Controllers/*.php') as $filename){
    require_once $filename;
}

$router=new Router();
foreach (glob(__DIR__ . '/routers/*.php') as $filename){
    require_once $filename;
}

$projectName='/BanTrangSuc';
$requestUrl=str_replace($projectName,'',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
$methodRes=$_SERVER['REQUEST_METHOD'];

$router->xuLyPath($methodRes,$requestUrl);
// echo "<h2>REQUEST_URI: ".$_SERVER['REQUEST_URI']."</h2>";
// echo "<h2>URL gửi vào Router: $requestUrl</h2>";

$core=new CoreModel();
$getInfo=$core->getAdminInfo();
setSession('getInfo',$getInfo);
$getInfo_KhachHang=$core->getKhachHangInfo();
setSession('getInfo_KhachHang',$getInfo_KhachHang);
