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

	function get_active_tutors($tutor_id) {
		$sql = 'SELECT s\.firstName, ta\.courseID, t\.imgPath FROM tutor t, tutor_ability ta, student s WHERE t\.tutorID = ta\.tutorID and t\.studentID = s\.studentID and t\.tutorID = ' . $this->db->escape($tutor_id);
		$query = $this->db->query($sql);
		return $query->result();
	}

}