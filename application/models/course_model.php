<?php 

class Course_model extends CI_Model {

	function get_all_courses() {
		$this->db->select('courseID');
		$this->db->from('course');
		$this->db->order_by('courseID', 'desc');
		$query = $this->db->get(); 
		return $query->result();
	}

}