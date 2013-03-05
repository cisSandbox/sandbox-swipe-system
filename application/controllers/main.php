<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() {
		$data = array(
			'title' => 'Swipe it, yo' 
		);
		$this->template->load('default', 'main', $data);
	}

	public function check_student() {		
		$id = $this->input->post('id');
		$this->load->model('Student_model');
		$student = $this->Student_model->get_student_by_id($id);
		if($student) {
			echo $student[0]->firstName . " " . $student[0]->lastName;
		} else {
			echo "Student not found";
		}
	}

}