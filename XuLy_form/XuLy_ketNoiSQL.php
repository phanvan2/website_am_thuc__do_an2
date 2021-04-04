<?php
	class connectSQL
	{
		public $ten_database = "amthuc_webcuoiky3";
		private $conn ; // kết nối tới mysql
		private $result ; // kết quả khi query 
		public function getTenbang(){
			echo "hello";
		}
		public function setconnect()
		{
			$this->conn = mysqli_connect("localhost" , "root" , "" , $this->ten_database);
		}
		public function getConnect(){
			return $this->conn;
		}
		
		
	}
	class bang 
	{

		private $result ;
		private $ten_bang ; 
		private $conn; 
		private $result_select ; 
		private $result_insert;
		private $result_delete;
		private $result_update;		
		// 
	
		function __construct( $conn , $ten_bang){
			$this->conn  = $conn ; 	
			$this->ten_bang = $ten_bang; 
		}
		//------------------------------------------
		public function setTenbang($ten_bang)
		{
			$this->ten_bang = $ten_bang;
		}
		public function getTenbang(){
			return $this->ten_bang ; 
		}
		// ---------------------------------------
		public function setConnect($conn)
		{
			$this->conn = $conn;
		}
		public function getConnect(){
			return $this->conn ; 
		}
		// ----------------Lấy dữ liệu trong bảng----------------
		public function setResult_select($thanhphan, $dieuKien, $sapxep)
		{
			$this->result_select = mysqli_query($this->conn, "SELECT $thanhphan FROM $this->ten_bang WHERE $dieuKien ORDER BY $sapxep");
		}
		public function getResult_select(){ 
			return $this->result_select ; 
		}

		//---------------------Chèn dữ liệu vào trong bảng--------------
		public function setResult_insert($row, $values)
		{
			$this->result_insert = mysqli_query($this->conn, "INSERT INTO ".$this->ten_bang." ($row) VALUES($values)");
		}
		public function getResult_insert(){
			return $this->result_insert;
		}
		//----------------Xóa dữ liệu trong bảng=------------------
		public function setResult_delete($dk)
		{

			$this->result_delete =  mysqli_query($this->conn , "DELETE FROM ".$this->ten_bang." WHERE $dk ;");
		}
		public function getResult_delete(){
			return $this->result_delete;
		}
		// ----------cật nhật lại dữ liệu trong bảng ------------------
		public function setResult_update($sua , $dk ){
			$this->result_update = mysqli_query($this->conn , "UPDATE ".$this->ten_bang." SET $sua WHERE $dk");

		}
		public function getResult_update(){
			return $this->result_update; 
		}
		// ---------------Đếm xem truy vấn được bao nhiêu dữ liệu phù hợp
		public function getCount($result){
			return mysqli_num_rows($result);
		}
	}
?>
