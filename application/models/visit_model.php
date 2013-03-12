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

}