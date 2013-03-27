<?php 

class WorkVisit_model extends CI_Model {
	function add_work_visit_by_id($id) {
		
		$day = date("l");
		$day_id = $this->db->query("select DayID from day where day.dayName = '$day'")->result_array();

		$data = array(
			'dayID' => $day_id[0]['DayID'],
			'tutorID' => $id
		);

		$this->db->insert('work_visit', $data);
	}
}