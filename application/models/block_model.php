<?php

class Block_Model extends CI_Model{

	function get_all_blocks() {
		$query = $this->db->get('meeting_time');
		return $query->result();
	}

	function get_block_by_id($id){
		$query = $this->db->query('select block from meeting_time where meetingID = $id');
		return $query->result();	
	}

	function get_blocks_by_course($course, $semester){
		$query = $this->db->query('select block, c.meetingID from meeting_time m, class c where m.meetingID = c.meetingID and c.courseID = ? and c.semesterID = ?',[$course, $semester]);
		return $query->result();		
	}


}