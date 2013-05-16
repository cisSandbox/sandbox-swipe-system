<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() {
		$data = array(
			'title' => 'Swipe it, yo' 
		);
		$this->template->load('default', 'main', $data);
	}

	public function verify_student() {		
		$id = $this->input->post('id');
		$this->load->model('Student_model');
		echo json_encode($this->Student_model->get_filtered_student_by_id($id));
	}

	public function add_student_visit() {
		if($this->input->post('courseID') == "") {
			$courseID = null;
		} else {
			$courseID = $this->input->post('courseID');
		}

		$data = array(
			'roomID' => $this->input->post('roomID'), 
			'studentID' => $this->input->post('studentID'),
			'courseID' => $courseID,
			'timeIn' => date("Y-m-d H:i:s"),
			'needHelp' => $this->input->post('needHelp')
		);
		$this->load->model('Visit_model');
		$this->Visit_model->add_visit($data);
	}

	public function add_work_visit() {
		$tutor_id = $this->input->post('tutorID');
		$this->load->model('WorkVisit_model');
		$this->WorkVisit_model->add_work_visit_by_id($tutor_id);
	}

	public function get_courses() {
		$this->load->model('Course_model');
		echo json_encode($this->Course_model->get_all_courses());
	}

	public function get_tutors_on_duty(){
		$this->load->model('WorkVisit_model');
		echo json_encode($this->WorkVisit_model->get_tutors_on_duty());		
	}


}