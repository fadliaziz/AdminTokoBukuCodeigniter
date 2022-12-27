<?php defined("BASEPATH") or exit(); 

class Hapus_model extends CI_Model {

	public function __construct() {
		$this->load->database();		
	}

	public function distributor($post) {
		$post = $this->db->escape_str($post);

		if($this->db->delete("distributor", $post))
			return json_encode(['status' => "ok", "msg" => "Distributor telah di hapus !"]);
		else
			return json_encode(['status' => 'ok', "msg" => "Gagal menghapus distributor !"]);
	}

	public function buku($post) {
		$post = $this->db->escape_str($post);

		if($this->db->delete("buku", $post))
			return json_encode(["status" => "ok", "msg" => "Buku telah di hapus !"]);
		else
			return json_encode(['status' => "error", "msg" => "Gagal mengahpus buku !"]);
	}

}

?>