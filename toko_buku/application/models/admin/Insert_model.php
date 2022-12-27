<?php defined("BASEPATH") or exit(); 

class Insert_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function buku($post){
		$post = $this->db->escape_str($post);

		$pasok_data = array(
			"iddistributor" => $post['iddistributor'],
			"idbuku" => $post['idbuku'],
			"jumlah" => $post['stok'],
			"tanggal" => date("Y-m-d H:i:s")
		);

		if($this->db->insert("buku", $post)) {
			if($this->db->insert("pasok", $pasok_data))
				return json_encode(['status' => "ok", "msg" => "Buku telah ditambahkan"]);
			else 
				return json_encode(['status' => "error", "msg" => "Gagal menambahkan buku"]);
		}
	}

	public function distributor($post) {
		$post = $this->db->escape_str($post);

		if($this->db->insert("distributor", $post))
			return json_encode(['status' => "ok", "msg" => "Distributor baru telah di tambah !", "text" => $post['namadistributor'], "id" => $post['iddistributor']]);
		else
			return json_encode(['status' => "error", "msg" => "Gagal menambahkan distributor"]);
	}

	public function pasok($post) {
		$post = $this->db->escape_str($post);

		$return = false;

		for ($i=0; $i < count($post['iddistributor']) ; $i++) { 
			$buku = array(
				"diskon" => $post['diskon'][$i],
				"ppn" => $post['ppn'][$i],
				"harga_pokok" => $post['harga_pokok'][$i],
				"harga_jual" => $post['harga_jual'][$i]
			);

			$this->db->where("idbuku", $post['idbuku'][$i]);
			if($this->db->update("buku", $buku)) {
				$pasok = array(
					"iddistributor" => $post['iddistributor'][$i],
					"idbuku" => $post['idbuku'][$i],
					"jumlah" => $post['stok'][$i],
					"tanggal" => date("y-m-d H:i:s")
				);

				if($this->db->insert("pasok", $pasok)) $return = true;
			}
		}

		if($return)
			return json_encode(['status' => "ok", "msg" => "Pasokan buku telah di tambah"]);
		else
			return json_encode(['status' => "error", "msg" => "Gagal menambah pasokan"]);	
	}

	public function penjualan($post) {
		$post = $this->db->escape_str($post);

		for ($i=0; $i < count($post['idbuku']); $i++) { 
			$data = array(
				"idbuku" => $post['idbuku'][$i],
				"jumlah" => $post['jumlah'][$i],
				"idkasir" => $this->session->userdata("id"),
				"tanggal" => date("Y-m-d H:i:s"),
				"total" => $post['jumlah'][$i] * (($post['harga_jual'][$i] - ($post['diskon'][$i] / 100 * $post['harga_jual'][$i])) + ($post['ppn'][$i] / 100 * $post['harga_jual'][$i]))
			);

			$this->db->insert("penjualan", $data);
		}

		return json_encode(['status' => "ok", "msg" => "Buku berhasil terjual"]);
	}

}

?>