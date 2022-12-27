<?php defined("BASEPATH") or exit(); 

class Init_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function login($post) {
		$post = $this->db->escape_str($post);

		$data = $this->db->get_where("kasir", $post);

		if($data->num_rows() > 0) {
			foreach($data->result_array() as $d) {
				$this->session->set_userdata("id", $d['username']);
				$this->session->set_userdata("akses", true);

				redirect("admin/p/home");
			}
		}	
		else {
			$this->session->set_userdata("msg", "<div class='alert alert-danger'>Kombinasi username / password tidak benar !</div>");
			redirect();
		}
	}

}

?>