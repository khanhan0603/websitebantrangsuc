<?php

class CoreModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = Database::connectPDO();
        // Test kết nối
        // var_dump($this->conn);
        // die();
    }

    public function getAdminInfo(){
        $token=getSession('token_adlogin');
        $getAdminEmail=$this->getOne("SELECT email FROM tokens_adlogin WHERE token = '$token'");
        if(!empty($getAdminEmail['email'])){
            $admin_email=$getAdminEmail['email'];
        }
        if(!empty($admin_email)){
          $getInfo=$this->getOne("SELECT * FROM admin WHERE email = '$admin_email'");
          if(!empty($getInfo)){
            return $getInfo;
          }
        }
        return false;
    }
    public function getKhachHangInfo(){
        $token=getSession('token_login');
        $getAdminEmail=$this->getOne("SELECT email FROM tokens_login WHERE token = '$token'");
        if(!empty($getAdminEmail['email'])){
            $khachhang_email=$getAdminEmail['email'];
        }
        if(!empty($khachhang_email)){
          $getInfo=$this->getOne("SELECT * FROM khachhang WHERE email = '$khachhang_email'");
          if(!empty($getInfo)){
            return $getInfo;
          }
        }
        return false;
    }

    //Truy vấn 1 dữ liệu theo khóa chính
    // public function getById($table,$id,$key='id'){
    //     $sql="SELECT * FROM $table WHERE $key = $id";
    //     $stm=$this->conn->prepare($sql);
    //     $stm->execute();
    //     $result=$stm->fetch(PDO::FETCH_ASSOC);//Lấy 1 dòng dữ liệu
    //     return $result;
    // }

    // Truy vấn nhiều dòng dữ liệu
    public function getAll($sql){
        $stm=$this->conn->prepare($sql);
        $stm->execute();
        $result=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Đếm số dòng trả về
    public function getRows($sql){
        $stm=$this->conn->prepare($sql);
        $stm->execute();
        return $stm->rowCount();
    }

    // Truy vấn một dòng dữ liệu
     public function getOne($sql, $params = [])
{
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    // Insert dữ liệu
    public function insert($table, $data){
       $keys=array_keys($data);//Lấy ds cột từ mảng data
       $cot=implode(", ", $keys);//Ghép tên cột thành cuỗi
       $place=':'.implode(", :", $keys);//Tạo placeholder cho PDO

       $sql="INSERT INTO $table ($cot) VALUES ($place)";//:name -> placeholder

       $stm=$this->conn->prepare($sql);//SQL Injection

    //    Thực thi câu lệnh
        $rel=$stm->execute($data);

        return $rel;
    }

    // Update dữ liệu
      public function update($table, $data, $condition)
    {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key=?,";
        }
        $fields = rtrim($fields, ",");

        $sql = "UPDATE $table SET $fields WHERE ";

        foreach ($condition as $key => $value) {
            $sql .= "$key=? AND ";
        }
        $sql = rtrim($sql, " AND ");

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(array_merge(array_values($data), array_values($condition)));
    }
 
    public function updateUser($table, $data, $condition) { $fields = ""; foreach ($data as $key => $value) { $fields .= "$key=?,"; } $fields = rtrim($fields, ","); $sql = "UPDATE $table SET $fields WHERE "; foreach ($condition as $key => $value) { $sql .= "$key=? AND "; } $sql = rtrim($sql, " AND "); $stmt = $this->conn->prepare($sql); return $stmt->execute(array_merge(array_values($data), array_values($condition))); }
   public function deleteUser($table, $where)
{
    if (!is_array($where) || empty($where)) {
        throw new Exception("Where phải là mảng và không rỗng");
    }

    $conditions = [];
    foreach ($where as $key => $value) {
        $conditions[] = "`$key` = ?";
    }

    $sql = "DELETE FROM `$table` WHERE " . implode(' AND ', $conditions);

    $stmt = $this->conn->prepare($sql);
    return $stmt->execute(array_values($where));
}

//     // Xóa sản phẩm
   public function delete($table, $where) {
        $column = key($where);
        $value = $where[$column];
        $sql = "DELETE FROM $table WHERE $column = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$value]);
    }
    // Lấy ID mới nhất sau khi insert
    public function lastID(){
        global $conn;
        return $this->conn->lastInsertId();
    }
    
}