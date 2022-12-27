<?php defined("BASEPATH") or exit(); 

class Load_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function buku($post) {
		$post = $this->db->escape_str($post);

		$data_table = function() use ($post) {

			$d = array(
				"table" => "buku",
				"columns" => ["idbuku", "judul", "noisbn", "stok"],
				"order" => [null, "judul", null, "stok"]
			);

			Datatable::set_data($d);

			$row = [];
			foreach($this->dt->get_data() as $data) {
				$col = [];
				$col[] = ucfirst($data['judul']);
				$col[] = $data['noisbn'];
				$col[] = $data['stok'];
				$col[] = "<a href=\"javascript:void(0)\" class=\"btn btn-primary btn-sm\" data-action=\"detail\" id=\"".$data['idbuku']."\" >Detail</a> ";
				$col[] = "<a href=\"javascript:void(0)\" class=\"btn btn-warning btn-sm\" data-action=\"edit\" id=\"".$data['idbuku']."\" >Edit</a> ";
				$col[] = "<a href=\"javascript:void(0)\" class=\"btn btn-danger btn-sm\" data-action=\"hapus\" id=\"".$data['idbuku']."\" >Hapus</a> ";
				
				$row[] = $col;
			}

			return json_encode([
				"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
				"data" => $row,
				"recordsTotal" => $this->dt->recordsTotal(),
				"recordsFiltered" => $this->dt->recordsFiltered()
			]);
		};

		$select2 = function() use ($post) {
			$this->db->select("idbuku as id, concat(judul, \" [ \", idbuku, \" ] \") as text");
			$this->db->from("buku");

			if(isset($post['q'])) {
				$this->db->like("judul", $post['q']);
				$this->db->or_like("idbuku", $post['q']);
			}

			$q = $this->db->get();

			return json_encode([
				"items" => $q->result_array(),
				"pagination" => ["more" => true]
			]);
		};

		return (isset($_POST['tipe']) && $_POST['tipe'] == "select2") ? $select2() : $data_table();
	}

	public function part_buku($post) {
		$post = $this->db->escape_str($post);

		$q = $this->db->get_where("buku", $post);

		return json_encode([
			"total" => $q->num_rows(),
			"data" => $q->result_array()
		]);
	}

	public function part_distributor($post) {
		$post = $this->db->escape_str($post);

		$q = $this->db->get_where("distributor", $post);

		return json_encode(array(
				"total" => $q->num_rows(),
				"data" => $q->result_array()
			));
	}

	public function distributor($post) {
		$post = $this->db->escape_str($post);

		$data_table = function() use ($post) {
			$d = array(
				"table" => "distributor",
				"columns" => ["iddistributor", "namadistributor", "telepon"],
				"order" => [null, "namadistributor", null]
			);

			Datatable::set_data($d);

			$row = [];
			foreach($this->dt->get_data() as $d) {
				$col = [];
				$col[] = $d['iddistributor'];
				$col[] = ucfirst($d['namadistributor']);
				$col[] = $d['telepon'];
				$col[] = "<a href=\"javascript:void(0)\" id=\"".$d["iddistributor"]."\" class=\"btn btn-sm btn-primary\" data-action=\"detail\">Detail</a> ";
				$col[] = "<a href=\"javascript:void(0)\" id=\"".$d["iddistributor"]."\" class=\"btn btn-sm btn-warning\" data-action=\"edit\">Edit</a> ";
				$col[] = "<a href=\"javascript:void(0)\" id=\"".$d["iddistributor"]."\" class=\"btn btn-sm btn-danger\" data-action=\"hapus\">Hapus</a> ";
				$row[] = $col;
			}

			return json_encode(array(
				"draw" => isset($_POST['draw']) ? $_POST['draw'] : 0,
				"data" => $row,
				"recordsFiltered" => $this->dt->recordsFiltered(),
				"recordsTotal" => $this->dt->recordsTotal()
			));
		};

		$select2 = function() use ($post) {
			$this->db->select("iddistributor as id, CONCAT(namadistributor , \" [ \", iddistributor, \" ]\") as text");
			$this->db->from("distributor");

			if(isset($post['q'])) {
				$this->db->like("iddistributor", $post['q']);
				$this->db->or_like("namadistributor", $post['q']);
			}

			$params = $this->db->get();

			return json_encode(['items' => $params->result_array(), 'pagination' => ['more' => true]]);
		};

		return (isset($_POST['tipe']) && $_POST['tipe'] == "select2") ?  $select2() : $data_table();
	}

	public function grafik($post) {
		$penjualan = function() {
			$store = [];
			$return = [];

			$cur_penjualan = $this->db->get("v_grafik_penjualan")->result_array();

			foreach($cur_penjualan as $d) {
				$store[$d['bulan']] = $d;
			}

			for ($i=1; $i <= 12 ; $i++) { 
				if(empty($store[$i])) {
					$store[$i] = array(
						"jumlah" => 0,
						"bulan" => $i
					);
				}
				
				$return['penjualan'][] = $store[$i]['jumlah'];
			}

			return json_encode($return);

		};

		return $penjualan();
	}
} 

?>