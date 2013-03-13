<?php 

class Visit_model extends CI_Model {

	function get_all_visits() {
		$query = $this->db->get('visit');
		return $query->result();
	}

	function get_visit_by_id($id) {
		$query = $this->db->query("select * from visit where visitID = $id");
		return $query->result();
	}

	// $visitID, $roomID = "smi234", $studentID, $classID, $timeIn, $timeOut = null
	function add_visit($data) {
		$this->db->insert('visit', $data);
	}

	//[TODO] add logic to select only students who need help
	function get_students_who_need_help(){
		$query = $this->db->query("SELECT firstName, lastName, courseID, timeIn FROM student s, visit v WHERE v.studentID = s.studentID"); 
		return $query->result();
	}

}