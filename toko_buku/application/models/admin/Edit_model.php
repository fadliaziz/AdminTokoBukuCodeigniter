<?php defined("BASEPATH") or exit(); 

class Edit_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function distributor($post) {
		$post = $this->db->escape_str($post);

		$this->db->where("iddistributor", $post['iddistributor']);
		if($this->db->update("distributor", $post))
			return json_encode(['status' => "ok", "msg" => "Distributor telah di edit !"]);
		else
			return json_encode(['status' => "error", "msg" => "Gagal mengedit distributor"]);
	}

	public function buku($post) {
		$post = $this->db->escape_str($post);

		$this->db->where("idbuku", $post['idbuku']);
		if($this->db->update("buku", $post))
			return json_encode(['status' => "ok", "msg" => "Buku berhasil di edit !"]);
		else
			return json_encode(['status' => "error", "msg" => "Gagal mengedit buku"]);
	}

}

?>