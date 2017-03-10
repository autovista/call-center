<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class add_rights_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	function checkUserRights()
	{
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
	public function select_user() {
			$st = $this -> checkUserRights();
			$query=$this->db->query("select user_id from tbl_rights group by user_id");
			$query1_result = $query->result();
 		 $id= array();
  		foreach($query1_result as $row){
     		$id[] = $row->user_id;
   			}
 			 $id1 = implode(",",$id);
  			$ids = explode(",", $id1);
		$this -> db -> select('*');
		$this -> db -> from('lmsuser l');
		$this -> db -> join('tbl_user_group u', 'u.user_id=l.id');
		
		$this -> db -> where('status', '1');
	
		$this->db->where_not_in('l.id', $ids);
		if($_SESSION['role'] !=1)
		{
			$this -> db -> where('role !=',1);
			//$this -> db -> where('process_id',$_SESSION['process_id']);
			$this -> db -> where($st);
		}
		$this->db->group_by('u.user_id');
		$this->db->order_by('l.fname','asc');
		
		$query = $this -> db -> get();
		//echo $this->db->last_query();
		return $query -> result();
	}
	public function select_rights_user() {
		$this -> db -> select('l.*,r.form_name');
		$this -> db -> from('lmsuser l');
		$this -> db -> join('tbl_rights r','r.user_id=l.id','left');
		$this -> db -> where('status', '1');
		if($_SESSION['role'] !=1)
		{
			$this -> db -> where('role !=',1);
			$this -> db -> where('process_id',$_SESSION['process_id']);
		}
		$this->db->group_by('r.user_id');
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function insert_right() {
		echo $user_id = $this -> input -> post('user_name');
		$q=$this->db->query('select * from tbl_rights where user_id="'.$user_id.'"')->result();
		if(count($q)>0)
		{			
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Rights Already Assigned ...!</strong>');
		}
		else {		
		
		$form_location = $this -> input -> post('form_location');
		$form_user = $this -> input -> post('form_user');
		$form_group = $this -> input -> post('form_group');
		$form_campaign = $this -> input -> post('form_campaign');
		$form_status = $this -> input -> post('form_status');
		$form_disposition = $this -> input -> post('form_disposition');
		$form_right = $this -> input -> post('form_right');
		$form_new_lead = $this -> input -> post('form_new_lead');
		$form_assign_lead = $this -> input -> post('form_assign_lead');
		$form_follow_up = $this -> input -> post('form_follow_up');
		$form_manager_remark = $this -> input -> post('form_manager_remark');
		$form_transfer_lead = $this -> input -> post('form_transfer_lead');
		$form_upload_lead = $this -> input -> post('form_upload_lead');
		$form_tracker = $this -> input -> post('form_tracker');
		$form_transferred = $this -> input -> post('form_transferred');
		$calling_notification = $this -> input -> post('calling_notification');
		/*$form_name12=$this->input->post('form_name12');
		 $form_name13=$this->input->post('form_name13');
		 $form_name14=$this->input->post('form_name14');*/
		$controller_location = $this -> input -> post('controller_location');
		$controller_user = $this -> input -> post('controller_user');
		$controller_group = $this -> input -> post('controller_group');
		$controller_campaign = $this -> input -> post('controller_campaign');
		$controller_status = $this -> input -> post('controller_status');
		$controller_disposition = $this -> input -> post('controller_disposition');
		$controller_right = $this -> input -> post('controller_right');
		$controller_new_lead = $this -> input -> post('controller_new_lead');
		$controller_assign_lead = $this -> input -> post('controller_assign_lead');
		$controller_follow_up = $this -> input -> post('controller_follow_up');
		$controller_manager_remark = $this -> input -> post('controller_manager_remark');
		$controller_transfer_lead = $this -> input -> post('controller_transfer_lead');
		$controller_upload_lead = $this -> input -> post('controller_upload_lead');
		$controller_tracker = $this -> input -> post('controller_tracker');
		$controller_transferred = $this -> input -> post('controller_transferred');
		$controller_calling_notification = $this -> input -> post('controller_calling_notification');
		/*$controller_name13=$this->input->post('controller_name13');
		 $controller_name14=$this->input->post('controller_name14');*/
		if ($this -> input -> post('add_location_view') == '') {
			echo $add_location_view = $this -> input -> post('add_location_view1');
		} else {
			echo $add_location_view = $this -> input -> post('add_location_view');
		}
		if ($this -> input -> post('add_location_insert') == '') {
			echo $add_location_insert = $this -> input -> post('add_location_insert1');
		} else {
			echo $add_location_insert = $this -> input -> post('add_location_insert');
		}
		if ($this -> input -> post('add_location_modify') == '') {
			echo $add_location_modify = $this -> input -> post('add_location_modify1');
		} else {
			echo $add_location_modify = $this -> input -> post('add_location_modify');
		}
		if ($this -> input -> post('add_location_delete') == '') {
			echo $add_location_delete = $this -> input -> post('add_location_delete1');
		} else {
			echo $add_location_delete = $this -> input -> post('add_location_delete');
		}

		if ($this -> input -> post('manager_remark_view') == '') {
			echo $manager_remark_view = $this -> input -> post('manager_remark_view1');
		} else {
			echo $manager_remark_view = $this -> input -> post('manager_remark_view');
		}
		if ($this -> input -> post('manager_remark_insert') == '') {
			echo $manager_remark_insert = $this -> input -> post('manager_remark_insert1');
		} else {
			echo $manager_remark_insert = $this -> input -> post('manager_remark_insert');
		}
		if ($this -> input -> post('manager_remark_modify') == '') {
			echo $manager_remark_modify = $this -> input -> post('manager_remark_modify1');
		} else {
			echo $manager_remark_modify = $this -> input -> post('manager_remark_modify');
		}
		if ($this -> input -> post('manager_remark_delete') == '') {
			echo $manager_remark_delete = $this -> input -> post('manager_remark_delete1');
		} else {
			echo $manager_remark_delete = $this -> input -> post('manager_remark_delete');
		}

		if ($this -> input -> post('add_followup_view') == '') {
			echo $add_followup_view = $this -> input -> post('add_followup_view1');
		} else {
			echo $add_followup_view = $this -> input -> post('add_followup_view');
		}
		if ($this -> input -> post('add_followup_insert') == '') {
			echo $add_followup_insert = $this -> input -> post('add_followup_insert1');
		} else {
			echo $add_followup_insert = $this -> input -> post('add_followup_insert');
		}
		if ($this -> input -> post('add_followup_modify') == '') {
			echo $add_followup_modify = $this -> input -> post('add_followup_modify1');
		} else {
			echo $add_followup_modify = $this -> input -> post('add_followup_modify');
		}
		if ($this -> input -> post('add_followup_delete') == '') {
			echo $add_followup_delete = $this -> input -> post('add_followup_delete1');
		} else {
			echo $add_followup_delete = $this -> input -> post('add_followup_delete');
		}

		if ($this -> input -> post('add_right_view') == '') {
			echo $add_right_view = $this -> input -> post('add_right_view1');
		} else {
			echo $add_right_view = $this -> input -> post('add_right_view');
		}
		if ($this -> input -> post('add_right_insert') == '') {
			echo $add_right_insert = $this -> input -> post('add_right_insert1');
		} else {
			echo $add_right_insert = $this -> input -> post('add_right_insert');
		}
		if ($this -> input -> post('add_right_modify') == '') {
			echo $add_right_modify = $this -> input -> post('add_right_modify1');
		} else {
			echo $add_right_modify = $this -> input -> post('add_right_modify');
		}
		if ($this -> input -> post('add_right_delete') == '') {
			echo $add_right_delete = $this -> input -> post('add_right_delete1');
		} else {
			echo $add_right_delete = $this -> input -> post('add_right_delete');
		}

		if ($this -> input -> post('new_lead_view') == '') {
			echo $new_lead_view = $this -> input -> post('new_lead_view1');
		} else {
			echo $new_lead_view = $this -> input -> post('new_lead_view');
		}
		if ($this -> input -> post('new_lead_insert') == '') {
			echo $new_lead_insert = $this -> input -> post('new_lead_insert1');
		} else {
			echo $new_lead_insert = $this -> input -> post('new_lead_insert');
		}
		if ($this -> input -> post('new_lead_modify') == '') {
			echo $new_lead_modify = $this -> input -> post('new_lead_modify1');
		} else {
			echo $new_lead_modify = $this -> input -> post('new_lead_modify');
		}
		if ($this -> input -> post('new_lead_delete') == '') {
			echo $new_lead_delete = $this -> input -> post('new_lead_delete1');
		} else {
			echo $new_lead_delete = $this -> input -> post('new_lead_delete');
		}

		if ($this -> input -> post('add_new_user_view') == '') {
			echo $add_new_user_view = $this -> input -> post('add_new_user_view1');
		} else {
			echo $add_new_user_view = $this -> input -> post('add_new_user_view');
		}
		if ($this -> input -> post('add_new_user_insert') == '') {
			echo $add_new_user_insert = $this -> input -> post('add_new_user_insert1');
		} else {
			echo $add_new_user_insert = $this -> input -> post('add_new_user_insert');
		}
		if ($this -> input -> post('add_new_user_modify') == '') {
			echo $add_new_user_modify = $this -> input -> post('add_new_user_modify1');
		} else {
			echo $add_new_user_modify = $this -> input -> post('add_new_user_modify');
		}
		if ($this -> input -> post('add_new_user_delete') == '') {
			echo $add_new_user_delete = $this -> input -> post('add_new_user_delete1');
		} else {
			echo $add_new_user_delete = $this -> input -> post('add_new_user_delete');
		}

		if ($this -> input -> post('add_group_view') == '') {
			echo $add_group_view = $this -> input -> post('add_group_view1');
		} else {
			echo $add_group_view = $this -> input -> post('add_group_view');
		}
		if ($this -> input -> post('add_group_insert') == '') {
			echo $add_group_insert = $this -> input -> post('add_group_insert1');
		} else {
			echo $add_group_insert = $this -> input -> post('add_group_insert');
		}
		if ($this -> input -> post('add_group_modify') == '') {
			echo $add_group_modify = $this -> input -> post('add_group_modify1');
		} else {
			echo $add_group_modify = $this -> input -> post('add_group_modify');
		}
		if ($this -> input -> post('add_group_delete') == '') {
			echo $add_group_delete = $this -> input -> post('add_group_delete1');
		} else {
			echo $add_group_delete = $this -> input -> post('add_group_delete');
		}

		if ($this -> input -> post('assign_leads_view') == '') {
			echo $assign_leads_view = $this -> input -> post('assign_leads_view1');
		} else {
			echo $assign_leads_view = $this -> input -> post('assign_leads_view');
		}
		if ($this -> input -> post('assign_leads_insert') == '') {
			echo $assign_leads_insert = $this -> input -> post('assign_leads_insert1');
		} else {
			echo $assign_leads_insert = $this -> input -> post('assign_leads_insert');
		}
		if ($this -> input -> post('assign_leads_modify') == '') {
			echo $assign_leads_modify = $this -> input -> post('assign_leads_modify1');
		} else {
			echo $assign_leads_modify = $this -> input -> post('assign_leads_modify');
		}
		if ($this -> input -> post('assign_leads_delete') == '') {
			echo $assign_leads_delete = $this -> input -> post('assign_leads_delete1');
		} else {
			echo $assign_leads_delete = $this -> input -> post('assign_leads_delete');
		}

		if ($this -> input -> post('add_campaign_view') == '') {
			echo $add_campaign_view = $this -> input -> post('add_campaign_view1');
		} else {
			echo $add_campaign_view = $this -> input -> post('add_campaign_view');
		}
		if ($this -> input -> post('add_campaign_insert') == '') {
			echo $add_campaign_insert = $this -> input -> post('add_campaign_insert1');
		} else {
			echo $add_campaign_insert = $this -> input -> post('add_campaign_insert');
		}
		if ($this -> input -> post('add_campaign_modify') == '') {
			echo $add_campaign_modify = $this -> input -> post('add_campaign_modify1');
		} else {
			echo $add_campaign_modify = $this -> input -> post('add_campaign_modify');
		}
		if ($this -> input -> post('add_campaign_delete') == '') {
			echo $add_campaign_delete = $this -> input -> post('add_campaign_delete1');
		} else {
			echo $add_campaign_delete = $this -> input -> post('add_campaign_delete');
		}

		if ($this -> input -> post('add_status_view') == '') {
			echo $add_status_view = $this -> input -> post('add_status_view1');
		} else {
			echo $add_status_view = $this -> input -> post('add_status_view');
		}
		if ($this -> input -> post('add_status_insert') == '') {
			echo $add_status_insert = $this -> input -> post('add_status_insert1');
		} else {
			echo $add_status_insert = $this -> input -> post('add_status_insert');
		}
		if ($this -> input -> post('add_status_modify') == '') {
			echo $add_status_modify = $this -> input -> post('add_status_modify1');
		} else {
			echo $add_status_modify = $this -> input -> post('add_status_modify');
		}
		if ($this -> input -> post('add_status_delete') == '') {
			echo $add_status_delete = $this -> input -> post('add_status_delete1');
		} else {
			echo $add_status_delete = $this -> input -> post('add_status_delete');
		}

		if ($this -> input -> post('add_disposition_view') == '') {
			echo $add_disposition_view = $this -> input -> post('add_disposition_view1');
		} else {
			echo $add_disposition_view = $this -> input -> post('add_disposition_view');
		}
		if ($this -> input -> post('add_disposition_insert') == '') {
			echo $add_disposition_insert = $this -> input -> post('add_disposition_insert1');
		} else {
			echo $add_disposition_insert = $this -> input -> post('add_disposition_insert');
		}
		if ($this -> input -> post('add_disposition_modify') == '') {
			echo $add_disposition_modify = $this -> input -> post('add_disposition_modify1');
		} else {
			echo $add_disposition_modify = $this -> input -> post('add_disposition_modify');
		}
		if ($this -> input -> post('add_disposition_delete') == '') {
			echo $add_disposition_delete = $this -> input -> post('add_disposition_delete1');
		} else {
			echo $add_disposition_delete = $this -> input -> post('add_disposition_delete');
		}

		if ($this -> input -> post('upload_xls_view') == '') {
			echo $upload_xls_view = $this -> input -> post('upload_xls_view1');
		} else {
			echo $upload_xls_view = $this -> input -> post('upload_xls_view');
		}
		if ($this -> input -> post('upload_xls_insert') == '') {
			echo $upload_xls_insert = $this -> input -> post('upload_xls_insert1');
		} else {
			echo $upload_xls_insert = $this -> input -> post('upload_xls_insert');
		}
		if ($this -> input -> post('upload_xls_modify1') == '') {
			echo $upload_xls_modify = $this -> input -> post('upload_xls_modify');
		} else {
			echo $upload_xls_modify = $this -> input -> post('upload_xls_modify1');
		}
		if ($this -> input -> post('upload_xls_delete1') == '') {
			echo $upload_xls_delete = $this -> input -> post('upload_xls_delete');
		} else {
			echo $upload_xls_delete = $this -> input -> post('upload_xls_delete1');
		}

		if ($this -> input -> post('request_lead_transfer_view') == '') {
			echo $request_lead_transfer_view = $this -> input -> post('request_lead_transfer_view1');
		} else {
			echo $request_lead_transfer_view = $this -> input -> post('request_lead_transfer_view');
		}
		if ($this -> input -> post('request_lead_transfer_insert') == '') {
			echo $request_lead_transfer_insert = $this -> input -> post('request_lead_transfer_insert1');
		} else {
			echo $request_lead_transfer_insert = $this -> input -> post('request_lead_transfer_insert');
		}
		if ($this -> input -> post('request_lead_transfer_modify1') == '') {
			echo $request_lead_transfer_modify = $this -> input -> post('request_lead_transfer_modify');
		} else {
			echo $request_lead_transfer_modify = $this -> input -> post('request_lead_transfer_modify1');
		}
		if ($this -> input -> post('request_lead_transfer_delete1') == '') {
			echo $request_lead_transfer_delete = $this -> input -> post('request_lead_transfer_delete');
		} else {
			echo $request_lead_transfer_delete = $this -> input -> post('request_lead_transfer_delete1');
		}

		if ($this -> input -> post('cse_dashboard_view') == '') {
			echo $cse_dashboard_view = $this -> input -> post('cse_dashboard_view1');
		} else {
			echo $cse_dashboard_view = $this -> input -> post('cse_dashboard_view');
		}
		if ($this -> input -> post('cse_dashboard_insert1') == '') {
			echo $cse_dashboard_insert = $this -> input -> post('cse_dashboard_insert');
		} else {
			echo $cse_dashboard_insert = $this -> input -> post('cse_dashboard_insert1');
		}
		if ($this -> input -> post('cse_dashboard_modify1') == '') {
			echo $cse_dashboard_modify = $this -> input -> post('cse_dashboard_modify');
		} else {
			echo $cse_dashboard_modify = $this -> input -> post('cse_dashboard_modify1');
		}
		if ($this -> input -> post('cse_dashboard_delete1') == '') {
			echo $cse_dashboard_delete = $this -> input -> post('cse_dashboard_delete');
		} else {
			echo $cse_dashboard_delete = $this -> input -> post('cse_dashboard_delete1');
		}

		if ($this -> input -> post('tl_dashboard_view') == '') {
			echo $tl_dashboard_view = $this -> input -> post('tl_dashboard_view1');
		} else {
			echo $tl_dashboard_view = $this -> input -> post('tl_dashboard_view');
		}
		if ($this -> input -> post('tl_dashboard_insert1') == '') {
			echo $tl_dashboard_insert = $this -> input -> post('tl_dashboard_insert');
		} else {
			echo $tl_dashboard_insert = $this -> input -> post('tl_dashboard_insert1');
		}
		if ($this -> input -> post('tl_dashboard_modify1') == '') {
			echo $tl_dashboard_modify = $this -> input -> post('tl_dashboard_modify');
		} else {
			echo $tl_dashboard_modify = $this -> input -> post('tl_dashboard_modify1');
		}
		if ($this -> input -> post('tl_dashboard_delete1') == '') {
			echo $tl_dashboard_delete = $this -> input -> post('tl_dashboard_delete');
		} else {
			echo $tl_dashboard_delete = $this -> input -> post('tl_dashboard_delete1');
		}

		if ($this -> input -> post('all_tracker_view') == '') {
			echo $all_tracker_view = $this -> input -> post('all_tracker_view1');
		} else {
			echo $all_tracker_view = $this -> input -> post('all_tracker_view');
		}
		if ($this -> input -> post('all_tracker_insert1') == '') {
			echo $all_tracker_insert = $this -> input -> post('all_tracker_insert');
		} else {
			echo $all_tracker_insert = $this -> input -> post('all_tracker_insert1');
		}
		if ($this -> input -> post('all_tracker_modify1') == '') {
			echo $all_tracker_modify = $this -> input -> post('all_tracker_modify');
		} else {
			echo $all_tracker_modify = $this -> input -> post('all_tracker_modify1');
		}
		if ($this -> input -> post('all_tracker_delete1') == '') {
			echo $all_tracker_delete = $this -> input -> post('all_tracker_delete');
		} else {
			echo $all_tracker_delete = $this -> input -> post('all_tracker_delete1');
		}

		if ($this -> input -> post('cse_tracker_view') == '') {
			echo $cse_tracker_view = $this -> input -> post('cse_tracker_view1');
		} else {
			echo $cse_tracker_view = $this -> input -> post('cse_tracker_view');
		}
		if ($this -> input -> post('cse_tracker_insert1') == '') {
			echo $cse_tracker_insert = $this -> input -> post('cse_tracker_insert');
		} else {
			echo $cse_tracker_insert = $this -> input -> post('cse_tracker_insert1');
		}
		if ($this -> input -> post('cse_tracker_modify1') == '') {
			echo $cse_tracker_modify = $this -> input -> post('cse_tracker_modify');
		} else {
			echo $cse_tracker_modify = $this -> input -> post('cse_tracker_modify1');
		}
		if ($this -> input -> post('cse_tracker_delete1') == '') {
			echo $cse_tracker_delete = $this -> input -> post('cse_tracker_delete');
		} else {
			echo $cse_tracker_delete = $this -> input -> post('cse_tracker_delete1');
		}

		if ($this -> input -> post('transferred_leads_view') == '') {
			echo $transferred_leads_view = $this -> input -> post('transferred_leads_view1');
		} else {
			echo $transferred_leads_view = $this -> input -> post('transferred_leads_view');
		}
		if ($this -> input -> post('transferred_leads_insert1') == '') {
			echo $transferred_leads_insert = $this -> input -> post('transferred_leads_insert');
		} else {
			echo $transferred_leads_insert = $this -> input -> post('transferred_leads_insert1');
		}
		if ($this -> input -> post('transferred_leads_modify1') == '') {
			echo $transferred_leads_modify = $this -> input -> post('transferred_leads_modify');
		} else {
			echo $transferred_leads_modify = $this -> input -> post('transferred_leads_modify1');
		}
		if ($this -> input -> post('transferred_leads_delete1') == '') {
			echo $transferred_leads_delete = $this -> input -> post('transferred_leads_delete');
		} else {
			echo $transferred_leads_delete = $this -> input -> post('transferred_leads_delete1');
		}
if ($this -> input -> post('calling_notification_view') == '') {
			echo $calling_notification_view = $this -> input -> post('calling_notification_view1');
		} else {
			echo $calling_notification_view = $this -> input -> post('calling_notification_view');
		}
		
			echo $calling_notification_insert = $this -> input -> post('calling_notification_insert1');
		
			echo $calling_notification_modify = $this -> input -> post('calling_notification_modify1');
		
			echo $calling_notification_delete = $this -> input -> post('calling_notification_delete1');
		

		$form_array = array($form_location, $form_new_lead, $form_user, $form_group, $form_assign_lead, $form_campaign, $form_status, $form_disposition, $form_right, $form_follow_up, $form_manager_remark, $form_upload_lead, $form_transfer_lead, $form_tracker, $form_transferred,$calling_notification);
		$controller_array = array($controller_location, $controller_new_lead, $controller_user, $controller_group, $controller_assign_lead, $controller_campaign, $controller_status, $controller_disposition, $controller_right, $controller_follow_up, $controller_manager_remark, $controller_upload_lead, $controller_transfer_lead, $controller_tracker, $controller_transferred,$controller_calling_notification);

		$view_array = array($add_location_view, $new_lead_view, $add_new_user_view, $add_group_view, $assign_leads_view, $add_campaign_view, $add_status_view, $add_disposition_view, $add_right_view, $add_followup_view, $manager_remark_view, $upload_xls_view, $request_lead_transfer_view, $all_tracker_view, $transferred_leads_view,$calling_notification_view);

		$insert_array = array($add_location_insert, $new_lead_insert, $add_new_user_insert, $add_group_insert, $assign_leads_insert, $add_campaign_insert, $add_status_insert, $add_disposition_insert, $add_right_insert, $add_followup_insert, $manager_remark_insert, $upload_xls_insert, $request_lead_transfer_insert, $all_tracker_insert, $transferred_leads_insert,$calling_notification_insert);

		$modify_array = array($add_location_modify, $new_lead_modify, $add_new_user_modify, $add_group_modify, $assign_leads_modify, $add_campaign_modify, $add_status_modify, $add_disposition_modify, $add_right_modify, $add_followup_modify, $manager_remark_modify, $upload_xls_modify, $request_lead_transfer_modify, $all_tracker_modify, $cse_tracker_modify, $transferred_leads_modify,$calling_notification_modify);
		$delete_array = array($add_location_delete, $new_lead_delete, $add_new_user_delete, $add_group_delete, $assign_leads_delete, $add_campaign_delete, $add_status_delete, $add_disposition_delete, $add_right_delete, $add_followup_delete, $manager_remark_delete, $upload_xls_delete, $request_lead_transfer_delete, $all_tracker_delete, $transferred_leads_delete,$calling_notification_delete);

		$view_count = count($view_array);
		for ($i = 0; $i < $view_count; $i++) {
			$query = $this -> db -> query("INSERT INTO `tbl_rights`(`user_id`, `form_name`,`controller_name`,`view`, `insert`, `modify`, `delete`) VALUES ('$user_id','$form_array[$i]','$controller_array[$i]','$view_array[$i]','$insert_array[$i]','$modify_array[$i]','$delete_array[$i]')");

		}

		if ($query) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Rights added Successfully ...!</strong>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Right Not added ...!</strong>');

		}
		}
	}

	public function select_data() {
		$this -> db -> select('u.fname,u.lname,u.email,u.role_name,u.mobileno,l.location,r.right_id,r.view,r.insert,r.modify,r.delete,r.form_name,u.id,p.process_name');
		$this -> db -> from('tbl_rights r');
		$this -> db -> join('lmsuser u', 'u.id=r.user_id');
		$this -> db -> join('tbl_location l', 'l.location_id=u.location');
		$this -> db -> join('tbl_process p', 'p.process_id=u.process_id');
		if($_SESSION['role'] !=1)
		{
			$this -> db -> where('u.role !=',1);
			$this -> db -> where('p.process_id',$_SESSION['process_id']);
		}
		$this -> db -> group_by('r.user_id');		
		$this -> db -> order_by('u.fname', 'asc');
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function select_right_data($id) {
		$this -> db -> select('u.fname,u.lname,u.email,u.mobileno,r.right_id,r.view,r.insert,r.modify,r.delete,r.form_name,u.id');
		$this -> db -> from('tbl_rights r');
		$this -> db -> join('lmsuser u', 'u.id=r.user_id');

		$this -> db -> where('user_id', $id);
		$this -> db -> order_by('right_id', 'asc');
		$query = $this -> db -> get();
		return $query -> result();
	}

	public function delete_rights() {
		$user_id = $this -> input -> post('user_name');
		$this -> db -> where('user_id', $user_id);
		$this -> db -> delete('tbl_rights');
		$this -> insert_right();
	}

	public function delete_all_rights($id) {

		$this -> db -> where('user_id', $id);
		$query = $this -> db -> delete('tbl_rights');

		if ($query) {
			$this -> session -> set_flashdata('message', '<div class="alert alert-success">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Rights Deleted Successfully ...!</strong>');

		} else {
			$this -> session -> set_flashdata('message', '<div class="alert alert-danger">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong> Right Not Deleted ...!</strong>');

		}

	}

}
