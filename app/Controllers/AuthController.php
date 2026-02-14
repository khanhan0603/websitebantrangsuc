<?php

class AuthController extends BaseController
{
    private $coreModel;

    public function __construct()
    {
        $this->coreModel = new CoreModel();
    }
    public function showlogin_admin(){
        $this->renderView('layouts-part/admin/login_admin');
    }
   
    public function login_admin()
    {
        if (isPost()) {

            $filter = filterData();
            $errors = [];

            // Validate email
            if (empty($filter['email'])) {
                $errors['email']['required'] = 'Email không được để trống';
            } else {
                if(!validateEmail(trim($filter['email']))){
                    $errors['email']['isEmail'] = 'Email không đúng định dạng';
                }
            }

            // Validate password
            if (empty($filter['password'])) {
                $errors['password']['required'] = 'Mật khẩu không được để trống';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'Mật khẩu phải lớn hơn 6 ký tự';
                }
            }

            // ❗ Nếu có lỗi VALIDATE
            if (!empty($errors)) {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại thông tin đăng nhập');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('errors', $errors);
                return reload('login');
            }

            // ❗ Không có lỗi → Xử lý đăng nhập
            $email = $filter['email'];
            $password = $filter['password'];

            $sql = "SELECT * FROM admin WHERE email='$email'";
            $checkStatus = $this->coreModel->getOne($sql);
            // Debug thông tin đăng nhập
            // echo "<pre>";

            // echo "POST password raw: [" . $_POST['password'] . "]\n";
            // echo "POST password length: " . strlen($_POST['password']) . "\n\n";

            // echo "Filtered password: [" . $password . "]\n";
            // echo "Filtered password length: " . strlen($password) . "\n\n";

            // echo "password_verify: ";
            // var_dump(password_verify($password, $checkStatus['password']));
            // echo "\n\n";

            // print_r($checkStatus);   
            // exit;//Dừng lại để xem debug

            if ($checkStatus && password_verify($password, $checkStatus['password'])) {

                $token_adlogin = sha1(uniqid().time());
                $insertToken = $this->coreModel->insert('tokens_adlogin', [
                    'email' => $checkStatus['email'],
                    'token' => $token_adlogin,
                    'created_at' => date('Y-m-d H:i:s'),
                    'expired_at' => date('Y-m-d H:i:s', strtotime('+1 day')),// Token có hạn trong 1 ngày
                ]);

                if ($insertToken) {
                    setSession('admin_logged_in', true);
                    setSession('admin_id', $checkStatus['id'] ?? null);
                    setSession('admin_email', $checkStatus['email']);
                    setSession('admin_name', $checkStatus['name'] ?? $checkStatus['email']);
                    setSession('admin_role', $checkStatus['role'] ?? 'admin');
                    setSession('token_adlogin',$token_adlogin);
                    return reload('sanphamcuatoi'); // Quan trọng
                }

                setSessionFlash('msg','Đăng nhập không thành công, vui lòng thử lại');
                setSessionFlash('msg_type','danger');
                return reload('login');
            }

            setSessionFlash('msg','Email hoặc mật khẩu không đúng');
            setSessionFlash('msg_type','danger');
            return reload('login');
        }

        // GET request → show form login
        return $this->renderView('layouts-part/login_admin');
    }
// Hash mật khẩu, để test khi cần
    // public function hash()
    // { 
    //     return $this->renderView('hash');
    // }



    public function showRegister_khachhang(){
        $this->renderView('layouts-part/signup');
    }

   public function register(){
    if(isPost()){
        $filter = filterData();
        $errors = [];

        // Validate username
        if(empty($filter['username'])){
            $errors['username']['required']='Tên đăng nhập không được để trống';
        }

        // Validate email
        if(empty($filter['email'])){
            $errors['email']['required']='Email không được để trống';   
        } else {
            if(!validateEmail(trim($filter['email']))){
                $errors['email']['isEmail']='Email không đúng định dạng';
            } else {
                $email = trim($filter['email']);
                $checkEmail = $this->coreModel->getRows("SELECT * FROM khachhang WHERE email='$email'");
                if($checkEmail > 0){
                    $errors['email']['check']='Email đã tồn tại, vui lòng sử dụng email khác';
                }
            }
        }

        // Validate password
        if(empty($filter['password'])){
            $errors['password']['required']='Mật khẩu không được để trống';
        } else {
            if(strlen(trim($filter['password'])) < 6){
                $errors['password']['length']='Mật khẩu phải lớn hơn 6 ký tự';
            }
        }

        // Nếu không có lỗi
        if(empty($errors)){
            // 1) Insert vào bảng khách hàng trước
            $datainsert = [
                'username' => $filter['username'],
                'email' => $filter['email'],
                'password' => password_hash($filter['password'], PASSWORD_DEFAULT),
            ];

            $insertStatus = $this->coreModel->insert('khachhang', $datainsert);

            if ($insertStatus) {
                // 2) Tạo token login
                $token_login = sha1(uniqid() . time());

                $this->coreModel->insert('tokens_login', [
                    'email' => $filter['email'],
                    'token' => $token_login,
                    'created_at' => date('Y-m-d H:i:s'),
                    'expired_at' => date('Y-m-d H:i:s', strtotime('+1 day')),
                ]);

                // 3) Lưu session token
                setSession('token_login', $token_login);

                // 4) Redirect về home
                return reload('home');
            }

            // insert khách hàng thất bại
            setSessionFlash('msg','Đăng ký không thành công, vui lòng thử lại');
            setSessionFlash('msg_type','danger');
        }
        else {
            setSessionFlash('msg','Vui lòng kiểm tra lại thông tin đăng ký');
            setSessionFlash('msg_type','danger');
            setSessionFlash('errors',$errors);
            setSessionFlash('old',$filter);
        }

        return reload('register');
    }
}

    public function showlogin_khachhang()
    {
        $this->renderView('layouts-part/login_khachhang');
    }
      public function login_khachhang()
    {
        if (isPost()) {

            $filter = filterData();
            $errors = [];

            // Validate email
            if (empty($filter['email'])) {
                $errors['email']['required'] = 'Email không được để trống';
            } else {
                if(!validateEmail(trim($filter['email']))){
                    $errors['email']['isEmail'] = 'Email không đúng định dạng';
                }
            }

            // Validate password
            if (empty($filter['password'])) {
                $errors['password']['required'] = 'Mật khẩu không được để trống';
            } else {
                if (strlen(trim($filter['password'])) < 6) {
                    $errors['password']['length'] = 'Mật khẩu phải lớn hơn 6 ký tự';
                }
            }

            // Nếu có lỗi VALIDATE
            if (!empty($errors)) {
                setSessionFlash('msg', 'Vui lòng kiểm tra lại thông tin đăng nhập');
                setSessionFlash('msg_type', 'danger');
                setSessionFlash('errors', $errors);
                return reload('login');
            }

            // Không có lỗi → Xử lý đăng nhập
            $email = $filter['email'];
            $password = $filter['password'];

            $sql = "SELECT * FROM khachhang WHERE email='$email'";
            $checkStatus = $this->coreModel->getOne($sql);

            if ($checkStatus && password_verify($password, $checkStatus['password'])) {

                $token_login = sha1(uniqid().time());
                $insertToken = $this->coreModel->insert('tokens_login', [
                    'email' => $checkStatus['email'],
                    'token' => $token_login,
                    'created_at' => date('Y-m-d H:i:s'),
                    'expired_at' => date('Y-m-d H:i:s', strtotime('+1 day')),// Token có hạn trong 1 ngày
                ]);

                if ($insertToken) {
                    setSession('tokens_login', $token_login); // đúng cho khách hàng
                    setSession('email_khachhang', $checkStatus['email']);
                    setSession('username_khachhang', $checkStatus['username']);

                    return reload('home'); 
                }

                setSessionFlash('msg','Đăng nhập không thành công, vui lòng thử lại');
                setSessionFlash('msg_type','danger');
                return reload('login_khachhang');
            }

            setSessionFlash('msg','Email hoặc mật khẩu không đúng');
            setSessionFlash('msg_type','danger');
            return reload('login_khachhang');
        }

        // GET request → show form login
        return $this->renderView('layouts-part/login_khachhang');
    }

    public function logout_khachhang()
    {
       if (session_status() === PHP_SESSION_NONE) session_start();

        // Xóa toàn bộ session
        session_destroy();

        // Chuyển về trang chủ hoặc login
        header("Location: /BanTrangSuc/");
        exit();
    }
    public function logout_admin()
    {
       if (session_status() === PHP_SESSION_NONE) session_start();

        // Xóa toàn bộ session
        session_destroy();

        // Chuyển về trang chủ
        header("Location: /BanTrangSuc/");
        exit();
    }
}
