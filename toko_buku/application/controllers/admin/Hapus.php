<?php defined("BASEPATH") or exit(); 

class Hapus extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin/hapus_model", "h");
	}

	private function distributor($post) {
		$post = $this->corelib->escape($post);

		return $this->h->distributor($post);
	}

	private function buku($post) {
		$post = $this->corelib->escape($post);

		return $this->h->buku($post);
	}

	public function touch($func) {
		switch ($func) {
			case 'distributor':
				echo self::distributor($_POST);
				break;
			case "buku" :
				echo self::buku($_POST);
				break;
		}
	}

}

?>