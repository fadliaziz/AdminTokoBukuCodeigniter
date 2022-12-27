<?php defined("BASEPATH") or exit(); 

class Load extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("admin/load_model", "l");

		if(!$this->session->has_userdata("id") && $this->session->userdata("akses") != true) redirect();
	}

	public function pages($page = "home") {
		$this->load->a_template($page);
	}

	private function buku($post) {
		$post = $this->corelib->escape($post);

		return $this->l->buku($post);
	}

	private function part_distributor($post) {
		$post = $this->corelib->escape($post);

		return $this->l->part_distributor($post);
	}

	private function grafik($post) {
		$post = $this->corelib->escape($post);

		return $this->l->grafik($post);
	}

	private function distributor($post) {
		$post = $this->corelib->escape($post);

		return $this->l->distributor($post);
	}

	private function part_buku($post) {
		$post = $this->corelib->escape($post);

		return $this->l->part_buku($post);
	}

	public function touch($func) {
		switch ($func) {
			case 'buku':
				echo self::buku($_POST);
				break;
			case "part_distributor" :
				echo self::part_distributor($_POST);
				break;
			case "grafik" :
				echo self::grafik($_POST);
				break;
			case "distributor" :
				echo self::distributor($_POST);
				break;
			case "part_buku" : 
				echo self::part_buku($_POST);
				break;
		}
	}

}

?>