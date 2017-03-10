<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reporting_dashboard_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	public function filter_record() {

		$fromdate = date('Y-m-d');
		$this -> db -> select('l.created_date,l.enquiry_for,l.lead_source,l.status,count(enq_id)as enqcount,enq_id');
		$this -> db -> from('lead_master l');

		$this -> db -> where('lead_source', 'Facebook');
		$this -> db -> where('l.created_date', $fromdate);
		$this -> db -> group_by('l.enquiry_for');
		$query = $this -> db -> get();
	//	echo $this -> db -> last_query();
		return $query -> result();

	}

	public function select_record1() {

		$fromdate = $this -> input -> post('fromdate');
		$todate = $this -> input -> post('todate');
		if ($fromdate == '') {
			$fromdate = date('Y-m-d');
		}
		if ($todate == '') {
			$todate = date('Y-m-d');
		}

		$q = $this -> db -> query('select created_date from lead_master where created_date >="' . $fromdate . '" and created_date <= "' . $todate . '" group by created_date') -> result();
	//	echo count($q);

		foreach ($q as $row) {
			$date = $row -> created_date;
			$this -> db -> select('l.created_date,l.enquiry_for,l.lead_source,l.status,count(enq_id)as enqcount,enq_id');
			$this -> db -> from('lead_master l');

			$this -> db -> where('lead_source', 'Facebook');
			$this -> db -> where('l.created_date ', $date);

			$this -> db -> group_by('l.enquiry_for');
			$query = $this -> db -> get();
			$v[] = $query -> result();
		}

		return $v;

	}

}
?>