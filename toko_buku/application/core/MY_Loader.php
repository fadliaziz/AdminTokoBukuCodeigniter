<?php defined("BASEPATH") or exit(); 

class MY_Loader extends CI_Loader {

	public function a_template($temp = "", $data = []) {
		$this->view("templates/header", $data);
		$this->view("templates/top-bar", $data);
		$this->view("admin/templates/sidebar", $data);
		$this->view("admin/".$temp, $data);
		$this->view("templates/footer", $data);
	}

}

?>