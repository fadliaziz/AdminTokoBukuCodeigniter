<?php defined("BASEPATH") or exit(); 

class Datatable extends CI_Model {

	private static $table;
	private static $columns;
	private static $order;

	public function __construct() {
		$this->load->database();
	}

	public static function set_data($data = []) {
		self::$table = $data['table'];
		self::$columns = $data['columns'];
		self::$order = $data['order'];
	}

	private function count_all() {
		return $this->db
		->select("*")
		->from(self::$table)
		->count_all_results();
	}

	public function exec() {
		$this->db->select(self::$columns);
		$this->db->from(self::$table);

		if(isset($_POST['search']['value'])) {
			$this->db->like(array_values(array_filter(self::$columns))[0], $_POST['search']['value']);
			for ($i=0; $i < count(self::$columns); $i++) { 
				if($i == 0) continue;
				$this->db->or_like(array_values(array_filter(self::$columns))[$i], $_POST['search']['value']);
			}
		}

		if(isset($_POST['length']) > 0) 
			$this->db->limit($_POST['length'], $_POST['start']);

		$q = $this->db->get();
		
		return array(
			"data" => $q->result_array(),
			"recordsFiltered" => $q->num_rows(),
			"recordsTotal" => $this->count_all()
		);
	}

	public function get_data() {
		return $this->exec()['data'];
	}

	public function recordsFiltered() {
		return $this->exec()['recordsFiltered']; 
	}

	public function recordsTotal() {
		return $this->exec()['recordsTotal'];
	}

}

?>