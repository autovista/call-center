<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class tracker_model extends CI_model {
	function __construct() {
		parent::__construct();
	}

	function checkUserRights() {
		if ($_SESSION['role'] != 1) {
			//$process_id = $_SESSION['process_id'];
			$user_id = $_SESSION['user_id'];
			$this -> db -> select('g.group_id');
			$this -> db -> from('tbl_group g');
			$this -> db -> join('tbl_user_group u', 'u.group_id=g.group_id');
			$this -> db -> where('u.user_id', $user_id);
			$query1 = $this -> db -> get() -> result();
			$c = count($query1);
			if (count($query1) > 0) {
				$t = ' ( ';
				for ($i = 0; $i < $c; $i++) {
					if ($i == 0) {

						$t = $t . "group_id = '" . $query1[$i] -> group_id . "'";

					} else {
						$t = $t . " or group_id ='" . $query1[$i] -> group_id . "'";
					}
				}
				$st = $t . ')';

			}
			return $st;
		}
	}

	//Select Status
	function select_status() {
		$process_id = $_SESSION['process_id'];
		$this -> db -> select('s.status_name,s.status_id ');
		$this -> db -> from('tbl_status s');
		$this -> db -> join('tbl_process p', 's.process_id=p.process_id', 'left');
		$this -> db -> where('p.process_id', $process_id);
		$query = $this -> db -> get();
		//	echo $this->db->last_query();
		return $query -> result();

	}

	public function select_telecaller() {
		$st = $this -> checkUserRights();
		$this -> db -> select('id,fname,lname');
		$this -> db -> from('lmsuser l');
		$this -> db -> join('tbl_user_group u', 'u.user_id=l.id');
		$this -> db -> where('role', 3);
		if ($_SESSION['role'] != 1) {
			$this -> db -> where($st);
		}

		$this -> db -> group_by('l.id');
		$this -> db -> order_by('fname', 'asc');

		$query = $this -> db -> get();
		return $query -> result();

	}

	public function select_disposition() {
		$status_id = $this -> input -> post('status');
		$this -> db -> select('disposition_name,disposition_id');
		$this -> db -> from('tbl_disposition_status');
		if ($status_id != 0) {
			$this -> db -> where('status_id', $status_id);
		}
		$this -> db -> order_by('disposition_name', 'asc');
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}

	function select_campaign() {
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

	}

	/*public function select_campaign()
	 {
	 $this->db->select('DISTINCT (enquiry_for) as enquiry_for');
	 $this->db->from('lead_master');
	 $this->db->where('lead_source','Facebook');
	 $this->db->order_by('enquiry_for','asc');
	 $query=$this->db->get();
	 return $query->result();
	 }*/
	public function select_lead() {
		$today = date('Y-m-d');
		$status = $this -> input -> post('status');
		$fromdate = $this -> input -> post('fromdate');
		$todate = $this -> input -> post('todate');
		$campaign_name = $this -> input -> post('campaign_name');
		$dispostion = $this -> input -> post('dispostion');

		if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
			$assign_to = $_SESSION['user_id'];
		} else {
			$assign_to = $this -> input -> post('assign_to');
		}
		$this -> db -> select('v.variant_name,
	d.disposition_name,
	s.status_name,
	f.date,f.nextfollowupdate,f.comment,
	u.fname,u.lname,
	m.model_name as new_model_name,
	m1.model_name as old_model_name,
	m2.make_name,
	l.manf_year,l.color,l.km,l.ownership,l.accidental_claim,l.buy_status,l.buyer_type,l.lead_source,l.location,enq_id,name,l.assign_to_telecaller,l.email,contact_no,l.comment,enquiry_for,l.status,l.created_date ');
		$this -> db -> from('lead_master l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('lead_followup f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		if ($dispostion != '') {	$this -> db -> where('l.disposition', $dispostion);

		}
		if ($campaign_name != '' && $campaign_name!='All' ){
			if ($campaign_name == 'Website') {
				$this -> db -> where('lead_source', '');
			} else {
				$name = explode('%23', $campaign_name);
				if ($name[0] == 'Facebook') {
					$this -> db -> where('enquiry_for', $name[1]);
					$this -> db -> where('lead_source', 'Facebook');
				} else {
					$this -> db -> where('lead_source', $name[1]);
				}
			}
		}

		/*	if ($campaign_name != '' && $campaign_name != 'Website' && $campaign_name != 'All' && $campaign_name != 'IBC' && $campaign_name != 'Carwale' && $campaign_name != 'GSC' && $campaign_name != 'Zendesk' && $campaign_name != 'Nexa Pune Web') {
		 $this -> db -> where('enquiry_for', $campaign_name);
		 $this -> db -> where('lead_source', 'Facebook');

		 }
		 if ($campaign_name == 'Website') {
		 $this -> db -> where('lead_source', '');

		 }
		 if ($campaign_name == 'IBC' || $campaign_name == 'Carwale' || $campaign_name == 'GSC' || $campaign_name == 'Zendesk' || $campaign_name == 'Nexa Pune Web') {
		 $this -> db -> where('lead_source', $campaign_name);
		 }
		 */
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}
		if ($fromdate != '') {
			$this -> db -> where('f.date', $fromdate);
			//	$this->db->where('l.created_date<=',$todate);
		} else {
			$this -> db -> where('f.date', $today);

		}

		if ($assign_to != 0) {
			$this -> db -> where('assign_to_telecaller', $assign_to);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($status == 0 && $fromdate == '' && $todate == '') {
			$this -> db -> limit(50);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

	public function select_lead_csv() {
		$today = date('Y-m-d');
		$status = $this -> input -> get('status');
		$fromdate = $this -> input -> get('fromdate');
		$todate = $this -> input -> get('todate');
		$campaign_name = $this -> input -> get('campaign_name');
		$dispostion = $this -> input -> get('dispostion');

		if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
			$assign_to = $_SESSION['user_id'];
		} else {
			$assign_to = $this -> input -> post('assign_to');
		}
		$this -> db -> select('v.variant_name,
	d.disposition_name,
	s.status_name,
	f.date,f.nextfollowupdate,f.comment,
	u.fname,u.lname,
	m.model_name as new_model_name,
	m1.model_name as old_model_name,
	m2.make_name,
	l.manf_year,l.color,l.km,l.ownership,l.accidental_claim,l.buy_status,l.buyer_type,l.lead_source,l.location,enq_id,name,l.assign_to_telecaller,l.email,contact_no,l.comment,enquiry_for,l.status,l.created_date ');
		$this -> db -> from('lead_master l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('lead_followup f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		if ($dispostion != '') {	$this -> db -> where('l.disposition', $dispostion);

		}

		if ($campaign_name != '' && $campaign_name != 'Website' && $campaign_name != 'All') {
			$this -> db -> where('enquiry_for', $campaign_name);
			$this -> db -> where('lead_source', 'Facebook');

		}
		if ($campaign_name == 'Website') {
			$this -> db -> where('lead_source', '');

		}
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}
		if ($fromdate != '') {
			$this -> db -> where('f.date', $fromdate);
			//	$this->db->where('l.created_date<=',$todate);
		} else {
			$this -> db -> where('f.date', $today);

		}

		if ($assign_to != 0) {
			$this -> db -> where('assign_to_telecaller', $assign_to);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($status == 0 && $fromdate == '' && $todate == '') {
			$this -> db -> limit(50);
		}
		$query = $this -> db -> get();
		$delimiter = ",";
		$newline = "\r\n";
		return $this -> dbutil -> csv_from_result($query, $delimiter, $newline);
		$this -> load -> library('excel');
		echo $this -> dbutil -> csv_from_result($query);

	}

	public function lc_data() {

		$today = date('Y-m-d');
		$status = $this -> input -> post('status');
		$fromdate = $this -> input -> post('fromdate');
		$todate = $this -> input -> post('todate');
		$campaign_name = $this -> input -> post('campaign_name');
		$dispostion = $this -> input -> post('dispostion');

		if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
			$assign_to = $_SESSION['user_id'];
		} else {
			$assign_to = $this -> input -> post('assign_to');
		}
		$this -> db -> select('v.variant_name,
	d.disposition_name,
	s.status_name,
	f.date,f.nextfollowupdate,f.comment,
	u.fname,u.lname,
	m.model_name as new_model_name,
	m1.model_name as old_model_name,
	m2.make_name,
	l.manf_year,l.color,l.km,l.ownership,l.accidental_claim,l.buy_status,l.buyer_type,l.lead_source,l.location,enq_id,name,l.assign_to_telecaller,l.email,contact_no,l.comment,enquiry_for,l.status,l.created_date ');
		$this -> db -> from('lead_master_lc l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('lead_followup_lc f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		if ($dispostion != '') {	$this -> db -> where('l.disposition', $dispostion);

		}
		if ($campaign_name != '' && $campaign_name!='All' ) {
			if ($campaign_name == 'Website') {
				$this -> db -> where('lead_source', '');
			} else {
				$name = explode('%23', $campaign_name);
				if ($name[0] == 'Facebook') {
					$this -> db -> where('enquiry_for', $name[1]);
					$this -> db -> where('lead_source', 'Facebook');
				} else {
					$this -> db -> where('lead_source', $name[1]);
				}
			}
		}
		/*if ($campaign_name != '' && $campaign_name != 'Website' && $campaign_name != 'All' && $campaign_name != 'IBC' && $campaign_name != 'Carwale' && $campaign_name != 'GSC' && $campaign_name != 'Zendesk' && $campaign_name != 'Nexa Pune Web') {
		 $this -> db -> where('enquiry_for', $campaign_name);
		 $this -> db -> where('lead_source', 'Facebook');

		 }
		 if ($campaign_name == 'Website') {
		 $this -> db -> where('lead_source', '');

		 }
		 if ($campaign_name == 'IBC' || $campaign_name == 'Carwale' || $campaign_name == 'GSC' || $campaign_name == 'Zendesk' || $campaign_name == 'Nexa Pune Web') {
		 $this -> db -> where('lead_source', $campaign_name);
		 }*/

		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}
		if ($fromdate != '') {
			$this -> db -> where('f.date', $fromdate);
			//	$this->db->where('l.created_date<=',$todate);
		} else {
			$this -> db -> where('f.date', $today);

		}

		if ($assign_to != 0) {
			$this -> db -> where('assign_to_telecaller', $assign_to);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($status == 0 && $fromdate == '' && $todate == '') {
			$this -> db -> limit(50);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

	public function reopen($enq_id) {

		$query2 = $this -> db -> query("INSERT INTO lead_master(`enq_id`, `followup_id`, `remark_id`, `transfer_id`, `lead_source`, `manual_lead`, `name`, `address`, `email`, `contact_no`, `enquiry_for`, `enquiry_source`, `page_path`, `status`, `disposition`, `model_id`, `variant_id`, `buy_status`, `buyer_type`, `location`, `comment`, `assignby`, `assign_to_telecaller`, `created_date`, `created_time`, `assign_date`, `old_make`, `old_model`, `color`, `manf_year`, `ownership`, `km`, `accidental_claim`, `package_type`, `pick_up_date`, `package_price`, `reg_no`, `fuel_type`, `loan_amnt`, `make_id`, `refname`, `add_date`, `evaluation_sheet_sr_no`, `stock_location`, `engine_no`, `chasis_no`, `reg_date`, `current_milage`, `quoted_price`, `difference_price`, `insurance_company`, `insurance_type`, `car_loan`, `insurance_no`, `insurance_date`, `new_car_customer_name`, `new_car_customer_mobile_no`, `service_date`)
		SELECT `enq_id`, `followup_id`, `remark_id`, `transfer_id`, `lead_source`, `manual_lead`, `name`, `address`, `email`, `contact_no`, `enquiry_for`, `enquiry_source`, `page_path`, `status`, `disposition`, `model_id`, `variant_id`, `buy_status`, `buyer_type`, `location`, `comment`, `assignby`, `assign_to_telecaller`, `created_date`, `created_time`, `assign_date`, `old_make`, `old_model`, `color`, `manf_year`, `ownership`, `km`, `accidental_claim`, `package_type`, `pick_up_date`, `package_price`, `reg_no`, `fuel_type`, `loan_amnt`, `make_id`, `refname`, `add_date`, `evaluation_sheet_sr_no`, `stock_location`, `engine_no`, `chasis_no`, `reg_date`, `current_milage`, `quoted_price`, `difference_price`, `insurance_company`, `insurance_type`, `car_loan`, `insurance_no`, `insurance_date`, `new_car_customer_name`, `new_car_customer_mobile_no`, `service_date`
		FROM lead_master_lc lc left join tbl_status s on s.status_id=lc.status WHERE lc.enq_id = '$enq_id'");

		$del = $this -> db -> query("delete from lead_master_lc where enq_id='$enq_id'");

	}

	public function select_lead_dse() {

		//$lead_date=$this->input->post('lead_date');

		$today = date('Y-m-d');
		$status = $this -> input -> post('status');
		if ($this -> input -> post('fromdate') == '' && $this -> input -> post('todate') != '') {
			//echo "1";
			$fromdate = $today;
		} else {
			//echo "2";
			$fromdate = $this -> input -> post('fromdate');
		}
		if ($this -> input -> post('todate') == '' && $this -> input -> post('fromdate') != '') {
			//echo "3";
			$todate = $today;
		} else {
			//echo "4";
			$todate = $this -> input -> post('todate');
		}

		//$fromdate = $this -> input -> post('fromdate');
		//$todate = $this -> input -> post('todate');
		$campaign_name = $this -> input -> post('campaign_name');
		$dispostion = $this -> input -> post('dispostion');

		if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
			$assign_to = $_SESSION['user_id'];
		} else {
			$assign_to = $this -> input -> post('assign_to');
		}
		$this -> db -> select('v.variant_name,
	d.disposition_name,
	s.status_name,
	f.date,f.nextfollowupdate,f.comment,
	u.fname,u.lname,
	m.model_name as new_model_name,
	m1.model_name as old_model_name,
	m2.make_name,
	r.assign_to_telecaller,r.assign_by_id,
	l.transfer_id,l.manf_year,l.color,l.km,l.ownership,l.accidental_claim,l.buy_status,l.buyer_type,l.lead_source,l.location,enq_id,name,l.assign_to_telecaller,l.email,contact_no,l.comment,enquiry_for,l.status,l.created_date ');
		$this -> db -> from('lead_master l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('lead_followup f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('request_to_lead_transfer r', 'r.request_id=l.transfer_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		if ($dispostion != '') {	$this -> db -> where('l.disposition', $dispostion);

		}
		if ($campaign_name != '' && $campaign_name!='All' ) {
			if ($campaign_name == 'Website') {
				$this -> db -> where('lead_source', '');
			} else {
				$name = explode('%23', $campaign_name);
				if ($name[0] == 'Facebook') {
					$this -> db -> where('enquiry_for', $name[1]);
					$this -> db -> where('lead_source', 'Facebook');
				} else {
					$this -> db -> where('lead_source', $name[1]);
				}
			}
		}
		/*if ($campaign_name != '' && $campaign_name != 'Website' && $campaign_name != 'All' && $campaign_name!='IBC' && $campaign_name!='Carwale' && $campaign_name!='GSC' && $campaign_name!='Zendesk' && $campaign_name !='Nexa Pune Web') {
		 $this -> db -> where('enquiry_for', $campaign_name);
		 $this -> db -> where('lead_source', 'Facebook');

		 }
		 if ($campaign_name == 'Website') {
		 $this -> db -> where('lead_source', '');

		 }
		 if($campaign_name=='IBC' || $campaign_name=='Carwale' || $campaign_name=='GSC' || $campaign_name=='Zendesk' || $campaign_name=='Nexa Pune Web') {
		 $this -> db -> where('lead_source', $campaign_name);
		 }*/

		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}

		if ($fromdate != '' && $todate != '') {
			$this -> db -> where('l.created_date>=', $fromdate);
			$this -> db -> where('l.created_date<=', $todate);
		}
		//else {
		//$this -> db -> where('f.date', $today);

		//}

		if ($assign_to != 0) {
			$this -> db -> where('l.assign_to_telecaller', $assign_to);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($campaign_name == '' && $status == 0 && $fromdate == '' && $todate == '') {
			$this -> db -> limit(50);
		}
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();

	}

	public function lc_data_dse() {
		$today = date('Y-m-d');
		$status = $this -> input -> post('status');
		if ($this -> input -> post('fromdate') == '' && $this -> input -> post('todate') != '') {
			//echo "1";
			$fromdate = $today;
		} else {
			//echo "2";
			$fromdate = $this -> input -> post('fromdate');
		}
		if ($this -> input -> post('todate') == '' && $this -> input -> post('fromdate') != '') {
			//echo "3";
			$todate = $today;
		} else {
			//echo "4";
			$todate = $this -> input -> post('todate');
		}

		//$fromdate = $this -> input -> post('fromdate');
		//$todate = $this -> input -> post('todate');
		$campaign_name = $this -> input -> post('campaign_name');
		$dispostion = $this -> input -> post('dispostion');

		if ($_SESSION['role'] == 3 || $_SESSION['role'] == 4) {
			$assign_to = $_SESSION['user_id'];
		} else {
			$assign_to = $this -> input -> post('assign_to');
		}
		$this -> db -> select('v.variant_name,
	d.disposition_name,
	s.status_name,
	f.date,f.nextfollowupdate,f.comment,
	u.fname,u.lname,
	m.model_name as new_model_name,
	m1.model_name as old_model_name,
	m2.make_name,
	r.assign_to_telecaller,r.assign_by_id,
	l.transfer_id,l.manf_year,l.color,l.km,l.ownership,l.accidental_claim,l.buy_status,l.buyer_type,l.lead_source,l.location,enq_id,name,l.assign_to_telecaller,l.email,contact_no,l.comment,enquiry_for,l.status,l.created_date ');
		$this -> db -> from('lead_master_lc l');
		$this -> db -> join('tbl_disposition_status d', 'd.disposition_id=l.disposition', 'left');
		$this -> db -> join('lead_followup_lc f', 'f.id=l.followup_id', 'left');
		$this -> db -> join('request_to_lead_transfer r', 'r.request_id=l.transfer_id', 'left');
		$this -> db -> join('tbl_status s', 's.status_id=l.status', 'left');
		$this -> db -> join('lmsuser u', 'u.id=l.assign_to_telecaller', 'left');
		$this -> db -> join('model_variant v', 'v.variant_id=l.variant_id', 'left');
		$this -> db -> join('make_models m', 'm.model_id=l.model_id', 'left');
		$this -> db -> join('make_models m1', 'm1.model_id=l.old_model', 'left');
		$this -> db -> join('makes m2', 'm2.make_id=l.old_make', 'left');
		if ($dispostion != '') {	$this -> db -> where('l.disposition', $dispostion);

		}
		if ($campaign_name != '' && $campaign_name!='All' ) {
			if ($campaign_name == 'Website') {
				$this -> db -> where('lead_source', '');
			} else {
				$name = explode('%23', $campaign_name);
				if ($name[0] == 'Facebook') {
					$this -> db -> where('enquiry_for', $name[1]);
					$this -> db -> where('lead_source', 'Facebook');
				} else {
					$this -> db -> where('lead_source', $name[1]);
				}
			}
		}

		/*	if ($campaign_name != '' && $campaign_name != 'Website' && $campaign_name != 'All' && $campaign_name != 'IBC' && $campaign_name != 'Carwale' && $campaign_name != 'GSC' && $campaign_name != 'Zendesk' && $campaign_name != 'Nexa Pune Web') {
		 $this -> db -> where('enquiry_for', $campaign_name);
		 $this -> db -> where('lead_source', 'Facebook');

		 }
		 if ($campaign_name == 'Website') {
		 $this -> db -> where('lead_source', '');

		 }
		 if ($campaign_name == 'IBC' || $campaign_name == 'Carwale' || $campaign_name == 'GSC' || $campaign_name == 'Zendesk' || $campaign_name == 'Nexa Pune Web') {
		 $this -> db -> where('lead_source', $campaign_name);
		 }
		 */
		if ($status != 0) {
			$this -> db -> where('l.status', $status);
		}

		if ($status == 0) {
			$st = "(l.status=1 or l.status=2 or l.status=3 or l.status=4 or l.status=5)";
			$this -> db -> where($st);
		}

		if ($fromdate != '' && $todate != '') {
			$this -> db -> where('l.created_date>=', $fromdate);
			$this -> db -> where('l.created_date<=', $todate);
		}
		//else {
		//$this -> db -> where('f.date', $today);

		//}

		if ($assign_to != 0) {
			$this -> db -> where('l.assign_to_telecaller', $assign_to);
		}
		$this -> db -> group_by('l.enq_id');
		$this -> db -> order_by('l.enq_id', 'desc');
		if ($campaign_name == '' && $status == 0 && $fromdate == '' && $todate == '') {
			$this -> db -> limit(50);
		}
		$query = $this -> db -> get();
		//	echo $this->db->last_query();
		return $query -> result();

	}

}
?>