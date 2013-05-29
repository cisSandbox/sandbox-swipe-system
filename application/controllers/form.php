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
		$this->template->load('default', 'tutor_form', $data);
	}

	public function fill_out($var1 = 0, $var2 = ''){
		$this->load->model('student_model');
		$this->load->model('tutor_model');
		$this->load->model('block_model');
		$data = array(
			'title' => 'Tutor Form',
			'student' => $var1,
			'class' => $var2
		);
		$data['student_name'] = $this->student_model->get_student_by_id($var1);
		//add the tutor array here, and add the blocks
		$data['tutors'] = $this->tutor_model->get_tutor_names();
		$data['blocks'] = $this->block_model->get_blocks_by_course($var2, 's2013');
		$this->template->load('default', 'tutor_form', $data);
	}

	public function submit(){
		//need to get tutoredVisitID, tutorID, timeTutored, class, notes
		$data = array(
			/*-- cdc edit 05/28/2013 --*/
			'studentHash' => $this->input->post('studentHash'),
			'courseID' => $this->input->post('course'),
			'block' => $this->input->post('block'),
			'tutorID' => $this->input->post('tutorID'),				//got tutorID
			'notes' => $this->input->post('notes')					//got notes
		);

		// still need tutoredVisitID, timeTutored, class
		$this->load->model('visit_model');
		$data['tv_id'] = $this->visit_model->get_active_visit_for_student($data['studentHash']);			//got tutoredVisitID

		$this->load->model('class_model');
		$data['class'] = $this->class_model->get_class_by_block_and_course($data['block'], $data['courseID']);			//got class

		$data['timeTutored'] = date("Y-m-d H:i:s");			//got date

		$inserts = array(
			'tutoredVisitID' => $data['tv_id'][0]->visitID,
			'tutorID' => $data['tutorID'],
			'timeTutored' => $data['timeTutored'],
			'classTutored' => $data['class'][0]->CRN,
			'notes' => $data['notes']
		);			//got everything

		$this->load->model('tutored_visit_model');
		$this->tutored_visit_model->add_tutored_visit($inserts);

		// code to remove the student from the visit list

		redirect('/index.php/visit/tutor_queue');
	}



}