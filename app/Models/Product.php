<?php
    class Product extends CoreModel
    {
        public function __construct()
        {
            parent::__construct();//Gọi lại hàm khởi tạo của lớp cha CoreModel
        }

        public function getAllProducts(){
            return $this->getAll("SELECT * FROM sanphams"); //Gọi hàm getAll từ lớp cha CoreModel
        }

         public function getRowProducts(){
            return $this->getRows("SELECT * FROM sanphams"); //Gọi hàm getAll từ lớp cha CoreModel
        }

        public function insertProduct($data)
        {
            return $this->insert('sanphams',$data);
        }

      public function updateProduct($masanpham, $data)
    {
        return $this->update('sanphams', $data, ['masanpham' => $masanpham]);
    }
       public function deleteProduct($masanpham) {
        return $this->delete('sanphams', ['masanpham' => $masanpham]);
    }
        public function getDetail($id) {
            $sql = "SELECT * FROM sanphams WHERE masanpham = '$id'";
            return $this->getOne($sql);
        }
        
        public function searchProducts($keyword) {
            $sql = "SELECT * FROM sanphams WHERE tensanpham LIKE '%$keyword%'";
            return $this->getAll($sql);
        }
                    
            public function getOneSanPham($masanpham)
        {
            $sql = "SELECT * FROM sanphams WHERE masanpham =?";
            return $this->getOne($sql, [$masanpham]);
        }
    }
?>