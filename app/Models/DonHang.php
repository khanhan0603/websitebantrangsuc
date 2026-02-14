<?php
    class DonHang extends CoreModel
    {
        public function __construct()
        {
            parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
        }

        public function getAllDonHangs(){
            return $this->getAll("SELECT * FROM donhang"); //Gọi hàm getAll từ lớp cha CoreModel
        }

         public function getRowDonHangs(){
            return $this->getRows("SELECT * FROM donhang"); //Gọi hàm getAll từ lớp cha CoreModel
        }
    
       public function insertDonHang($email, $soluong, $tongtien)
{
    // 1. Insert trước để lấy id
    $this->insert("donhang", [
        'email'    => $email,
        'soluong'  => $soluong,
        'tongtien' => $tongtien,
        'ngaydat'  => date("Y-m-d H:i:s")
    ]);

    // 2. Lấy ID tự tăng
    $id = $this->conn->lastInsertId();

    // 3. Tạo mã hóa đơn
    $mahoadon = "DH" . date("Ymd") . str_pad($id, 4, '0', STR_PAD_LEFT);

    // 4. Update mã hóa đơn (✔ đúng kiểu)
    $this->update(
        "donhang",
        ['madonhang' => $mahoadon],
        ['id' => $id]
    );

    return $mahoadon;
}


        public function updateDonHang($data,$condition)
        {
            return $this->updateUser('donhang',$data,$condition);
        }

        public function deleteDonHang($condition)
        {
            return $this->deleteUser('donhang',$condition);
        }
        public function getDetail($id) {
           $sql = "
                SELECT d.*, k.hoten, k.sdt, k.diachi 
                FROM donhang d
                JOIN khachhang k ON d.email = k.email
                WHERE d.madonhang = '$id'
            ";
            return $this->getOne($sql);
        }
    }