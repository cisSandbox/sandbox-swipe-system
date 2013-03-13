<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visit extends CI_Controller{

	public function index() {
		$data = array(
			'title' => 'Who\'s here?'
		);
		$this->load->model('Visit_model');
		$data['records'] = $this->Visit_model->get_students_who_need_help();
		$this->template->load('default','visit_list', $data);
	}

	public function active() {
		$data = array(
			'title' => 'Who\'s here?'
		);
		$this->load->model('Visit_model');
		$data['records'] = $this->Visit_model->get_active_visits();
		$this->template->load('default','visit_list', $data);
	}

}