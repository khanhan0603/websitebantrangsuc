<?php
$order = $_SESSION['order_info'] ?? null;

// Nếu không có thông tin đơn hàng → quay về home
// if (!$order) {
//     header("Location: /BanTrangSuc/home");
//     exit;
// }
//Xem dữ liệu trong session
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// exit;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Xác nhận đơn hàng</title>
<style>
.popup {
    width: 450px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    margin: 50px auto;
    box-shadow: 0 0 10px #999;
    font-family: Arial;
}
.popup h2 {
    margin-bottom: 10px;
    color: green;
}
.popup table {
    width: 100%;
    border-collapse: collapse;
}
.popup table td {
    padding: 5px;
}
.popup .total {
    font-weight: bold;
    font-size: 18px;
    margin-top: 15px;
}
</style>
</head>

<body>
<div class="popup">
    <h2>Đặt hàng thành công!</h2>

    <p><b>Mã hóa đơn:</b> <?php echo $order['madonhang']; ?></p>
    <p><b>Họ tên:</b> <?php echo $order['hoten']; ?></p>
    <p><b>Số điện thoại:</b> <?php echo $order['sdt']; ?></p>
    <p><b>Địa chỉ:</b> <?php echo $order['diachi']; ?></p>

    <h3>Chi tiết sản phẩm</h3>
    <table border="1">
        <tr>
            <th>Tên SP</th>
            <th>SL</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
            <th>Phương thức thanh toán</th>
        </tr>

        <?php if (!empty($chitiet)): ?>
            <?php foreach ($chitiet as $item): ?>
                <tr>
                    <td><?= $item['tensanpham'] ?></td>
                    <td><?= $item['soluong'] ?></td>
                    <td><?= number_format($item['dongia']) ?> đ</td>
                    <td><?= number_format($item['thanhtien']) ?> đ</td>
                    <td><?= $order['pttt'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if(empty($chitiet)): ?>
            <tr><td colspan="4">Không có sản phẩm trong hóa đơn!</td></tr>
        <?php endif; ?>
    </table>

    <p class="total">Tổng tiền: 
        <?php echo number_format($order['tongtien']); ?> đ
    </p>

    <button onclick="window.location.href='/BanTrangSuc/clear_order'">
        Về trang chủ
    </button>
</div>

</body>
</html>

