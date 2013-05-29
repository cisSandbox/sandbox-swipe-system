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

	//[DONE] add logic to select only students who need help
	//[edit] added studentId to select
	function get_students_who_need_help(){
		$query = $this->db->query("SELECT s.studentID, firstName, lastName, courseID, timeIn FROM student s, visit v WHERE v.studentID = s.studentID and v.needHelp = 1 and v.timeOut is null"); 
		return $query->result();
	}

	function get_active_visits(){
		$query = $this->db->query("SELECT firstName, lastName, courseID, timeIn FROM student s, visit v WHERE v.studentID = s.studentID and v.timeOut is null"); 
		return $query->result();	
	}

	function get_active_visit_for_student($id){
		/*-- cdc edit 05/28/2013 --*/
		$query = $this->db->query("SELECT visitID FROM visit WHERE studentHash = ? and timeOut is null", $id);
		/*-- /cdc --*/
		return $query->result();
	}

	function get_tutor_queue(){
		/* -- cdc edit 05/28/2013 -- */
		$query = $this->db->query("SELECT firstName, lastName, s.studentHash, courseID, timeIn FROM student s, visit v LEFT JOIN tutored_visit t on t.tutoredVisitID = v.visitID WHERE v.studentHash = s.studentHash and v.needHelp = 1 and v.timeOut is null and t.tutoredVisitID is null");
		/* -- /cdc -- */
		return $query->result();
	}

	function get_tapout_queue(){
		/* -- cdc edit 05/28/2013 -- */
		$query = $this->db->query("SELECT firstName, lastName, s.studentHash FROM student s, visit v WHERE v.studentHash = s.studentHash and v.timeOut is null");
		/* -- /cdc -- */
		return $query->result();
	}

	//$data = timeOut, studentID
	function close_visit_for_student($data){
		$query = $this->db->query("UPDATE visit SET timeOut = ? WHERE studentHash = ? and timeOut is null", $data);
	}


}