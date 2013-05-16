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

	function get_all(){
		$query = $this->db->get('work_visit');
		return $query->result();
	}

	function get_tutor_abilities_by_tutor($id){
		$query = $this->db->query("SELECT courseID FROM tutor_ability WHERE tutorID = $id");
		return $query->result();
	}





	/* --- FEEL FREE TO DISREGARD THE STUFF BELOW --- 
	//Called when a tutor signs out, updates the record in work_visit by adding a timeOut
	function sign_out_by_id($id){
		$dt = date("Y-m-d H:i:s");
		$data = array(
			'timeOut' => $dt
		);
		$this->db->where('tutorID',$id);
		$this->db->update('work_visit',$data);
	}
	--- --- */


	

}