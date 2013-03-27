<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visit extends CI_Controller{

	public function index() {
		$this->tapout_queue();
	}

	public function tutor_queue(){
		$data = array(
			'title' => 'Waiting to be Tutored'
		);
		$this->load->model('Visit_model');
		$data['records'] = $this->Visit_model->get_tutor_queue();
		$this->template->load('responsive','tutor_queue', $data);
	}

	public function tapout_queue(){
		$data = array(
			'title' => 'Tapout, yo!'
		);
		$this->load->model('Visit_model');
		$data['records'] = $this->Visit_model->get_tapout_queue();
		$this->template->load('responsive','tapout_queue', $data);
	}

	public function tapout($id){
		$data = array(
			'timeOut' => date("Y-m-d H:i:s"),
			'studentID' => $id
		);
		$this->load->model('visit_model');
		$this->visit_model->close_visit_for_student($data);

		redirect('/index.php/visit/tapout_queue');
	}

}