<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class website_lead_model extends CI_model {
	function __construct() {
		parent::__construct();
	}


	public function select_campaign() {
		/*---check count as per group & user--*/
		if ($_SESSION['role'] != 1) {

			$user_id = $_SESSION['user_id'];

			$this -> db -> select('c.campaign_name');
			$this -> db -> from('tbl_user_group u');
			$this -> db -> join('tbl_campaign c', 'c.group_id=u.group_id');
			$this -> db -> where('u.user_id', $user_id);
			$query1 = $this -> db -> get() -> result();

			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {
						if ($query1[$i] -> campaign_name == 'New Car') {
							$t = $t . "enquiry_for != 'Used Car'";
						} else {
							$t = $t . "enquiry_for = '" . $query1[$i] -> campaign_name . "'";
						}
					} else {
						$t = $t . " or enquiry_for ='" . $query1[$i] -> campaign_name . "'";
					}
				}
			
				$st = $t . ')';

			}
			$st;
		}

		$this -> db -> select('enquiry_for');
		$this -> db -> from('lead_master u');
		$this -> db -> join('tbl_campaign c', 'c.campaign_name=u.enquiry_for');
		$this -> db -> where('lead_source', 'Facebook');
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}
		$this -> db -> group_by('u.enquiry_for');
		$query = $this -> db -> get();
		return $query -> result();

		/*$this -> db -> select('DISTINCT (enquiry_for) as enquiry_for ');
		 $this -> db -> from('lead_master');
		 $this -> db -> where('lead_source', 'Facebook');
		 $query = $this -> db -> get();
		 //echo $this->db->last_query();
		 return $query -> result();*/

	}

	function select_manager_remark($id) {

		$this -> db -> select('remark ');
		$this -> db -> from('tbl_manager_remark');
		$this -> db -> where('lead_id', $id);
		$this -> db -> order_by('remark_id', 'desc');
		$query = $this -> db -> get();
		//	echo $this->db->last_query();
		return $query -> result();
	}

	//Select Status
	function select_status1() {
		$process_id = $_SESSION['process_id'];
		$this -> db -> select('s.status_name,s.status_id ');
		$this -> db -> from('tbl_status s');
		$this -> db -> join('tbl_process p', 's.process_id=p.process_id', 'left');
		$this -> db -> where('p.process_id', $process_id);

		$query = $this -> db -> get();
		//	echo $this->db->last_query();
		return $query -> result();

	}

	function select_status() {
		$process_id = $_SESSION['process_id'];
		$this -> db -> select('s.status_name,s.status_id ');
		$this -> db -> from('tbl_status s');
		$this -> db -> join('tbl_process p', 's.process_id=p.process_id', 'left');
		$this -> db -> where('p.process_id', $process_id);
		$this -> db -> where('s.status_name!=', 'Not Yet');

		$query = $this -> db -> get();
		//	echo $this->db->last_query();
		return $query -> result();

	}

	//Select Group
	function select_group() {
		$this -> db -> select('group_id,group_name');
		$this -> db -> from('tbl_group');
		$query = $this -> db -> get();
		return $query -> result();

	}

	//Select CSE name
	public function select_telecaller() {
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser');
		$this -> db -> where('role', 3);
		$this -> db -> order_by('fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();

	}

	// Select All Lead Details
	public function select_lead($enq) {

		/*---check count as per group & user--*/
		if ($_SESSION['role'] != 1) {

			$user_id = $_SESSION['user_id'];

			$this -> db -> select('c.campaign_name');
			$this -> db -> from('tbl_user_group u');
			$this -> db -> join('tbl_campaign c', 'c.group_id=u.group_id');
			$this -> db -> where('u.user_id', $user_id);
			$query1 = $this -> db -> get() -> result();

			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {
						if ($query1[$i] -> campaign_name == 'New Car') {
							$t = $t . "enquiry_for != 'Used Car'";
						} else {
							$t = $t . "enquiry_for = '" . $query1[$i] -> campaign_name . "'";
						}
					} else {
						$t = $t . " or enquiry_for ='" . $query1[$i] -> campaign_name . "'";
					}
				}
				$t = $t . " or lead_source ='' ";
				$st = $t . ')';

			}
			
			
			$st;
		}

		$filter_status = $this -> input -> post('filter_status');
		$filter_disposition = $this -> input -> post('filter_disposition');
		$filter_fromdate = $this -> input -> post('filter_fromdate');

		$filter_campaign_name = $this -> input -> post('filter_campaign_name');

		$enq = str_replace('%20', ' ', $enq);
		if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
			$assign_to = $_SESSION['user_id'];
		} else {
			$assign_to = $this -> input -> post('filter_assign');
		}
		$view = $_SESSION['view'];
		//Check Add manager remark right
		if ($view[10] == 1) {
			$this -> db -> select('
			u.fname,u.lname,
			r.remark,
			f1.date,f1.nextfollowupdate,f1.comment,
			d.disposition_name,
			s.status_name,
			l.eagerness,l.enq_id,name,l.assign_to_telecaller,l.email,contact_no,enquiry_for,l.status,l.assignby,l.created_date,l.created_time,l.buyer_type,l.buy_status,l.model_id,l.variant_id,l.old_make,l.old_model,l.ownership,l.manf_year,l.color,l.km');
		} else {
			$this -> db -> select('
			f1.date,f1.nextfollowupdate,f1.comment,
			d.disposition_name,
			s.status_name,
			l.eagerness,l.enq_id,name,l.assign_to_telecaller,l.email,contact_no,enquiry_for,l.status,l.assignby,l.created_date,l.created_time,l.buyer_type,l.buy_status,l.model_id,l.variant_id,l.old_make,l.old_model,l.ownership,l.manf_year,l.color,l.km');
		}
		$this -> db -> from('lead_master l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		if ($view[10] == 1) {
			$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller', 'left');
			$this -> db -> join('tbl_manager_remark r', 'r.remark_id=l.remark_id', 'left');
		}
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		//	$this -> db -> join('lead_followup f', 'f.leadid=l.enq_id', 'left');
		$this -> db -> join('lead_followup f1', 'f1.id=l.followup_id', 'left');
		if ($filter_disposition != '') {
			$this -> db -> where('l.disposition', $filter_disposition);

		}

		if ($enq != 'All' && $enq != 'Website' && $enq != '' && $enq!='Carwale') {
			$this -> db -> where('l.enquiry_for', $enq);
			$this -> db -> where('l.lead_source', 'Facebook');
		}
		if ($enq == 'Website') {
			
			$this -> db -> where('l.lead_source', '');
		}
if ($enq == 'Carwale') {
			
			$this -> db -> where('l.lead_source', 'Carwale');
		}
		if ($enq == 'All') {
			if ($_SESSION['role'] == 2) {
				$this -> db -> where($st);
			}
		}
		if ($filter_status != 0) {
			$this -> db -> where('l.status', $filter_status);
		}

		if ($filter_status == 0) {

			$this -> db -> where('l.status!=', '');
		}
		if ($filter_fromdate != '') {
			$this -> db -> where('l.created_date', $filter_fromdate);

		}
		if ($assign_to != '') {
			$this -> db -> where('assign_to_telecaller', $assign_to);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($filter_campaign_name == '' && $filter_status == 0 && $filter_fromdate == '') {
			$this -> db -> limit(100);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

	public function lms_details($id) {
		//Get user all details
		$this -> db -> select('l.eagerness,l.buy_make,l.buy_model,l.budget_to,l.budget_from,l.enq_id,l.name,l.email,l.address,l.location,l.contact_no,l.buy_status,bm1.make_name as buy_make_name,bm2.model_name as buy_model_name,s.status_name,m.model_name as new_model,l.buyer_type ,m1.model_name as old_model,v.variant_name,m2.make_name');
		$this -> db -> from('lead_master l');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		$this -> db -> join('makes bm1', 'bm1.make_id=l.buy_make', 'left');
		$this -> db -> join('make_models bm2', 'bm2.model_id=l.buy_model', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');

		$this -> db -> where('l.enq_id', $id);

		$query = $this -> db -> get();

		return $query -> result();
		}
public function select_additional_info($id)
{
	$this -> db -> select('*');
		$this -> db -> from('tbl_additional_car_info a');
		$this -> db -> join('makes m','a.car_make=m.make_id');
		$this -> db -> join('make_models m1','a.car_model=m1.model_id');
	
		$this -> db -> where('lead_id', $id);

		$query = $this -> db -> get();

		return $query -> result();
}
	public function followup_detail($id) {
		//Get user All Followup Details
		$this -> db -> select('u.fname,u.lname,
		s.status_name,
		d.disposition_name,
		l.location,l.status,l.created_date as lead_date,l.buyer_type,
		f.activity,f.assign_to,f.date as call_date,f.comment,f.nextfollowupdate,f.visit_location,f.visit_status,f.visit_booked,f.visit_booked_date,f.sale_status,f.car_delivered ');
		$this -> db -> from('lead_master l');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('lead_followup f', 'f.leadid=l.enq_id');
		$this -> db -> join('lmsuser u', 'u.id=f.assign_to', 'left');

		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=f.disposition', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=d.status_id', 'left');
		$this -> db -> where('f.leadid', $id);
		$this -> db -> order_by('f.id', 'desc');
		$query = $this -> db -> get();
		return $query -> result();

	}


	public function select_disposition($status) {

		$this -> db -> select('disposition_name,disposition_id');
		$this -> db -> from('tbl_disposition_status ');
		if ($status != 0) {
			$this -> db -> where('status_id', $status);
		}
		$this -> db -> order_by('disposition_name', 'asc');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}

	public function select_model() {
		$this -> db -> select('model_name,model_id');
		$this -> db -> from('make_models');
		$this -> db -> where('make_id', 1);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_all_model() {
		$this -> db -> select('model_name,model_id');
		$this -> db -> from('make_models');

		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_variant($new_model) {
		$this -> db -> select('variant_name,variant_id');
		$this -> db -> from('model_variant');
		$this -> db -> where('model_id', $new_model);
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_variant_new() {
		$this -> db -> select('variant_name,variant_id');
		$this -> db -> from('model_variant');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_make() {
		$this -> db -> select('make_name,make_id');
		$this -> db -> from('makes');
		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_model_id($old_make) {
		$this -> db -> select('model_name,model_id');
		$this -> db -> from('make_models');
		$this -> db -> where('make_id', $old_make);
		$query = $this -> db -> get();
		return $query -> result();

	}

	function lmsuser($location) {
		$role = "(role!=1 and role!=2)";
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser u');
		$this -> db -> join('tbl_location l', 'l.location_id=u.location', 'left');
		$this -> db -> where('status !=', 0);
		$this -> db -> where($role);
		$this -> db -> where('l.location', $location);
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}

	public function select_location() {
		$this -> db -> select('location_id,location');
		$this -> db -> from('tbl_location');
		$query = $this -> db -> get();

		return $query -> result();
	}

}
?>
