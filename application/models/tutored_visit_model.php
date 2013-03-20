<?php

class tutored_visit_model extends CI_Model{

	function get_all_tutored_visits(){
		$query = $this->db->get('tutored_visit');
		return $query->result();
	}

	// $visitID, $tutorID, $timeTutored, $class, $notes
	function add_tutored_visit($data) {
		$this->db->insert('tutored_visit', $data);
	}

}