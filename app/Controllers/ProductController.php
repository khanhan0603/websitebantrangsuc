<?php
    class ProductController extends BaseController{
         private $productModel;

        public function __construct()
        {
            $this->productModel = new Product();
        }

        public function showPost(){
            $data=[
                'productModel'=>$this->productModel
            ];
             $this->renderView('layouts-part/list_product',$data);
        }
        public function list(){
            $filter= filterData();
            $keyword='';
            $cate=0;
            $users=0;
            $chuoiSearch='';

            if(isGet()){
                if(isset($filter['keyword'])){
                    $keyword=$filter['keyword'];
                }
                if(isset($filter['category_id'])){
                    $cate=$filter['category_id'];
                }
                if(isset($filter['users'])){
                    $users=$filter['users'];
                }
                if(!empty($keyword)){
                    if(strpos($chuoiSearch,'WHERE')==false){
                        $chuoiSearch.=' WHERE ';
                    }
                    else{
                        $chuoiSearch.= ' AND ';
                    }
                    $chuoiSearch.="tensanpham LIKE '$$keyword%'";   
                }
                if($cate>0){
                    if(strpos($chuoiSearch,'WHERE')==false){
                        $chuoiSearch.=' WHERE ';
                    }
                    else{
                        $chuoiSearch.= ' AND ';
                    }
                    $chuoiSearch.="maloai = $cate";
                }
                if($users>0){
                    if(strpos($chuoiSearch,'WHERE')==false){
                        $chuoiSearch.=' WHERE ';
                    }
                    else{
                        $chuoiSearch.= ' AND ';
                    }
                    $chuoiSearch.="makhachhang = $users";
                }
            }
            //Phan trang
            $maxRow=$this->productModel->getRowProducts("SELECT masanpham FROM sanpham");
            $perPage=15;
            $maxPage=ceil($maxRow/$perPage);
            //Lấy trang hiện tại
            if(isset($filter['page'])){
                $page=$filter['page'];
            }
            else{
                $page=1;
            }
            $offset=($page-1)*$perPage;

            //Lấy danh sách sản phẩm
            $productDetail=$this->productModel->getAll("SELECT * FROM sanphams $chuoiSearch LIMIT $offset,$perPage");
            
            if(!empty($_SERVER['QUER_STRING'])){
                $queryString=$_SERVER['QUER_STRING'];
                $queryString=str_replace('&page='.$page,'',$queryString);
            }

            $data=[
                'productModel'=>$productDetail
            ];
                $this->renderView('layouts-part/product/list_product',$data);
        }

        public function detail() {
            $masanpham = $_GET['masanpham'] ?? null;

            if (!$masanpham) {
                die("Không tìm thấy mã sản phẩm!");
            }

            $product = $this->productModel->getDetail($masanpham);

            $this->renderView("layouts-part/product/detail_product", [
                'product' => $product
            ]);
        }

        public function search() {
            $this->renderView("layouts-part/search");
        }

        public function searchSP() {
            $filter = filterData();
            $keyword = $filter['keyword'] ?? '';

            $products = $this->productModel->searchProducts($keyword);

            $this->renderView("layouts-part/search_results", [
                'products' => $products,
                'keyword' => $keyword
            ]);
        }
    }

