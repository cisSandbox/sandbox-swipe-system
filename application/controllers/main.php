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
		$student = $this->Student_model->get_student_by_id($id);
		if($student) {
			echo $student[0]->firstName . " " . $student[0]->lastName;
		} else {
			echo "error";
		}
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
			'timeIn' => $this->input->post('timeIn'),
			'needHelp' => $this->input->post('needHelp')
		);
		$this->load->model('Visit_model');
		$this->Visit_model->add_visit($data);
	}

	public function visit_list() {
		$data = array(
			'title' => 'Who\'s here?',
		);
		$sql = "SELECT firstName, lastName, courseID, timeIn FROM student s, visit v WHERE v.studentID = s.studentID";
		$res = $this->db->query($sql);
		$data['records'] = $res->result();
		$this->template->load('default','visit_list', $data);
	}

}