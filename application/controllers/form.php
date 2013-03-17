<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Form extends CI_Controller{

	public function index(){
		$data = array(
			'title' => 'Tutor Form'
		);
		$this->template->load('responsive', 'tutor_form', $data);
	}

	public function submit(){

	}


}