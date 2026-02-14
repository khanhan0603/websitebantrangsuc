# Website quản lý bán trang sức (TLA Jew)

## Giới thiệu 
Đây là website demo cơ bản cho việc **quản lý bán trang sức**, bao gồm các chức năng chính:
- Quản lý thông tin người dùng (khách hàng, admin)
- Quản lý loại sản phẩm và sản phẩm
- Quản lý đơn hàng

Website được xây dựng theo mô hình **MVC bằng PHP**, phục vụ mục đích học tập và nghiên cứu.

## Công nghệ sử dụng 
- **PHP** (MVC)
- **MySQL**
- **HTML / CSS / JavaScript**
- **Apache (WAMP / XAMPP)** 

## Setup môi trường 

### 1. Yêu cầu hệ thống 
- PHP >= 8.3 
- MySQL 
- Git 
- WAMP / XAMPP

### 2. Clone source
```bash
git clone https://github.com/khanhan0603/websitebantrangsuc.git
```

### 3. Cấu hình web server
- Copy project vào thư mục www (WAMP) hoặc htdocs (XAMPP)
- Khởi động Apache và MySQL

### 4. Cấu hình Database
- Tạo database trong MySQL (ví dụ: dbqltrangsuc)
- Import file SQL trong thư mục database
- Chỉnh sửa thông tin kết nối database trong file config.php của thư mục configs

### 5. Chạy website
- Mở trình duyệt và truy cập. Ví dụ:
```bash
http://localhost/websitebantrangsuc/
```

### 6. Tài khoản demo
- **Admin**
  - Email: `ly@gmail.com`
  - Password: `123456789`

- **Khách hàng**
  - Email: `a@gmail.com`
  - Password: `123456789`

