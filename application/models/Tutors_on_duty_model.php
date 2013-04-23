<?php

class WorkVisit_model extends CI_Model{
	function get_all(){
		$query = $this->db->get('work_visit');
		return $query->result();
	}
}