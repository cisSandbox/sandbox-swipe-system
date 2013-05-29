<?php 

class Student_model extends CI_Model {

	function get_students() {
		$query = $this->db->get('student');
		return $query->result();
	}

	function get_student_by_id($id) {
		/*-- cdc edit 05/28/2013 --*/
		$query = $this->db->query("select * from student where studentHash = ?", $id);
		/*-- /cdc --*/
		return $query->result();
	}

	function get_filtered_student_by_id($id) {
		$results = array(
			'query_result' => null,
			'is_tutor' => false
		);

		/* -- cdc edit 05/28/2013 -- */
		//I had to bind the queries in order to get them to work.. I kept getting a db error because it thought that the hash value
		// was a column name. Either way, this is working now.
		//$qstudent = $this->db->query("select * from visit where studentID = $id and timeOut is null")->result();
		//$is_tutor = $this->db->query("select * from tutor where studentID = $id")->result();
		$qstudent = $this->db->query("select * from visit where studentHash = ? and timeOut is null", $id)->result();	//note that I kept the same parameter name, $id
		$is_tutor = $this->db->query("select * from tutor where studentHash = ?", $id)->result();
		
		if($qstudent) {
			return false;
		} else {
			$results['query_result'] = $this->db->query("select firstName, lastName from student where studentHash = ?", $id)->result();
			if($is_tutor) {
				$results['is_tutor'] = $this->db->query("select tutorID from tutor where studentHash = ?", $id)->result();		
				/* -- /cdc --*/
			} 
			return $results;
		}
	}
}