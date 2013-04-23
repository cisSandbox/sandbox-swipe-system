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

	function get_tutor_image_path_by_tutor($id){
		$query = $this->db->query("SELECT imgPath FROM tutor WHERE tutorID = $id");
		return $query->result();
	}

}