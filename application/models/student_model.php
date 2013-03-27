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

	function get_filtered_student_by_id($id) {
		$results = array(
			'query_result' => null,
			'is_tutor' => false
		);

		$qstudent = $this->db->query("select * from visit where studentID = $id and timeOut is null")->result();
		$is_tutor = $this->db->query("select * from tutor where studentID = $id")->result();

		if($qstudent) {
			return false;
		} else {
			$results['query_result'] = $this->db->query("select firstName, lastName from student where studentID = $id")->result();
			if($is_tutor) {
				$results['is_tutor'] = $this->db->query("select tutorID from tutor where studentID = $id")->result();		
			} 
			return $results;
		}
	}
}