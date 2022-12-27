<?php defined("BASEPATH") or exit();

class Init extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("init_model", "i");
	}

	public function index() {
		$this->load->view("login");
	}

	public function login() {
		$post = $this->corelib->escape($_POST);

		$post['password'] = sha1($post['password']);

		return $this->i->login($post);
	}

	public function logout() {
		session_destroy();
		redirect();
	}

}

?>