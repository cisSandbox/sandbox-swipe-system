<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Form extends CI_Controller{

	public function index(){
		$data = array(
			'title' => 'Tutor Form',
			'student' => null,
			'class' => null,
			'student_name' => null,
			'tutors' => null
		);
		$this->template->load('responsive', 'tutor_form', $data);
	}

	public function fill_out($var1 = null, $var2 = null){
		$this->load->model('student_model');
		$this->load->model('tutor_model');
		$data = array(
			'title' => 'Tutor Form',
			'student' => $var1,
			'class' => $var2
		);
		$data['student_name'] = $this->student_model->get_student_by_id($var1);
		//add the tutor array here, and add the blocks
		$data['tutors'] = $this->tutor_model->get_tutor_names();
		$this->template->load('responsive', 'tutor_form', $data);
	}



}