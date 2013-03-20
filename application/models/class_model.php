<?php

class class_model extends CI_Model{

	function get_all_classes(){
		$query = $this->db->get('class');
		return $query->result();
	}

	function get_class_by_block_and_course($block, $course){
		$query = $this->db->query("select CRN from class where meetingID = ? and courseID = ?", [$block, $course]);
		return $query->result();
	}

}