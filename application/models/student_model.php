<?php 

class Student_model extends CI_Model {

	function get_students() {
		$query = $this->db->get('student');
		return $query->result();
	}

	function get_student_by_id($id) {
		$query = $this->db->query("select * from student where studentID = $id");
		return $query->result();
	}

}