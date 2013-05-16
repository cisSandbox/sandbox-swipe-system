<?php 

ini_set('display_errors',1); 
error_reporting(E_ALL);

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

	function get_active_tutors() {
		$sql = "SELECT student.firstName, tutor_ability.courseID, tutor.imgPath
				FROM tutor
				INNER JOIN tutor_ability ON tutor.tutorID = tutor_ability.tutorID
				INNER JOIN student ON student.studentID = tutor.studentID
				INNER JOIN work_visit ON work_visit.tutorID = tutor.tutorID
				WHERE UNIX_TIMESTAMP(work_visit.endTime) = 0";
		$results = $this->db->query($sql)->result();

		$name = '';
		$final_results = array();
		$result_no = -1;
		foreach ($results as $key) {
			if($name == $key->firstName) {
				array_push($final_results[$result_no]['abilities'], $key->courseID);
			} else {
				$items = array(
					"firstName" => $key->firstName,
					"abilities" => array($key->courseID),
					"image"     => $key->imgPath
				);
				array_push($final_results, $items);
				$name = $key->firstName;
				$result_no++;
			}		
		}
		return $final_results;
	}

}