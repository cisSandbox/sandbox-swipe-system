<?php 

class Tutor_model extends CI_Model {

	function get_tutors() {
		$query = $this->db->get('tutor');
		return $query->result();
	}

	function get_tutor_names() {
		$query = $this->db->query("select firstName, lastName, t.studentID, tutorID from student s, tutor t where s.studentID = t.studentID");
		return $query->result();
	}

}