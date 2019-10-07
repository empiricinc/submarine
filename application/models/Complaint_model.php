<?php 

/**
 * 
 */
class Complaint_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function get_complaints($conditions=array(), $limit="", $offset="")
	{
		
		if(array_key_exists('c.id', $conditions))
		{
			$this->db->select('c.*, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			return $this->db->get_where('complaint AS c', $conditions)->row();
		}

		$this->db->select('c.*, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
		$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');
		$this->db->join('district AS d', 'c.district_id = d.id', 'left');
		$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
		$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

		return $this->db->get('complaint AS c');
	}

	function get_complaints_legal($conditions=array(), $limit="", $offset="")
	{
		if(array_key_exists('cr.complaint_id', $conditions))
		{
			$this->db->select('c.*, cr.id AS remarks_id, cr.sender, cr.sender_remarks, cr.status AS inv_status, cr.send_from, cr.r_date, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
	
			$this->db->join('complaint AS c', 'cr.complaint_id = c.id','left');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			$this->db->where(array('cr.status !=' => 'resolved', 'cr.intended_for' => 'legal'));

			if(!empty($conditions))
				$this->db->where($conditions);

			return $this->db->get('complaint_remarks AS cr');
		}

		$this->db->select('MAX(cr.r_date) AS r_date, MAX(cr.status) AS status, c.id AS complaint_id, c.complaint_no, c.subject, c.name, c.contact_no, p.name AS province');
		$this->db->join('complaint_remarks AS cr', 'c.id = cr.complaint_id','left');
		$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');
		
		$this->db->group_by('c.id');

		if(!empty($conditions))
			$this->db->where($conditions);

		if(!array_key_exists('cr.status', $conditions))
			$this->db->where('cr.status !=', 'resolved');

		$this->db->limit($limit, $offset);

		return $this->db->get('complaint AS c');
	}

	function get_complaints_local($conditions=array(), $limit="", $offset="")
	{

		if(array_key_exists('cr.complaint_id', $conditions))
		{	
			$this->db->select('c.*, cr.id AS remarks_id, cr.sender, cr.sender_remarks, cr.status AS inv_status, cr.receiver, cr.send_from, cr.r_date, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
	
			$this->db->join('complaint AS c', 'cr.complaint_id = c.id','left');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			$this->db->where('cr.intended_for', 'local');
			$this->db->where("(cr.status = 'process' OR cr.status = 'pending')");
			$this->db->where($conditions);
	
			$result = $this->db->get('complaint_remarks AS cr');
		}
		else
		{
			$this->db->select('cr.*, c.complaint_no, c.subject, c.name, c.contact_no, p.name AS province');
			$this->db->join('complaint AS c', 'cr.complaint_id = c.id','left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');	
			$this->db->where('cr.intended_for', 'local');
			
			$this->db->where("(cr.status = 'process' OR cr.status = 'pending')");
			$this->db->where($conditions);

			$this->db->limit($limit, $offset);
			$result = $this->db->get('complaint_remarks AS cr');
		}


		return $result;
	}


	function add_complaint($data)
	{
		return $this->db->insert('complaint', $data);
	}


	function get_employees_by_designation($designation_id)
	{
		$this->db->select("e.employee_id, CONCAT(IFNULL(e.first_name, ''), ' ', IFNULL(e.last_name, '')) AS employee_name");
		return $this->db->get_where('xin_employees e', array('designation_id' => $designation_id))->result();
	}

	function check_complaint_existence($complaint_id, $intended_for="", $employee_id="")
	{
		if($intended_for != "")
			$this->db->where(array('intended_for' => $intended_for));
		if($employee_id != "")
			$this->db->where(array('receiver' => $employee_id));

		return $this->db->get_where('complaint_remarks', array('complaint_id' => $complaint_id, 'status !=' => 'resolved'));
	}

	function get_project_head($complaint_id)
	{
		$this->db->select('e.first_name, e.last_name');
		$this->db->join('xin_employees e', 'c.remarks_by = e.user_id', 'left');
		$this->db->where('c.id', $complaint_id);
		return $this->db->get('complaint c')->row();
	}

	function get_remarks($complaint_id)
	{
		$this->db->select('cr.*, e.first_name, e.last_name');
		$this->db->order_by('r_date', 'asc');
		$this->db->join('xin_employees e', 'cr.sender = e.employee_id', 'left');
		return $this->db->get_where('complaint_remarks cr', array('cr.complaint_id' => $complaint_id))->result_array();

	}

	function get_files($remarks_id)
	{
		return $this->db->get_where('complaint_files cf', array('cf.complaint_remarks_id' => $remarks_id))->result_array();
	}

	function resolve_complaint($data, $complaint_id)
	{
		$this->db->where(array('id' => $complaint_id));
		return $this->db->update('complaint', $data);
	}

	// function update_complaint_status($complaint_id, $status)
	// {
	// 	$this->db->where('complaint_id', $complaint_id);
	// 	return $this->db->update('complaint_remarks', array('status'=> $status));
	// }

	function add_detail($data)
	{
		return $this->db->insert('complaint_remarks', $data);
	}

	function update_complaint_status($complaint_id, $status)
	{
		$this->db->where('id', $complaint_id);
		return $this->db->update('complaint', array('status' => $status));
	}

	function update_detail_status($complaint_id, $status)
	{
		$this->db->where('complaint_id', $complaint_id);
		return $this->db->update('complaint_remarks', array('status' => $status));
	}


	function upload($files = array())
	{
		return $this->db->insert_batch('investigation_files', $files);
	}

	function upload_files($files = array())
	{
		return $this->db->insert_batch('complaint_files', $files);
	}


	function update_status($complaint_id, $status, $intended_for)
	{
		$this->db->where(array('complaint_id' => $complaint_id, 'intended_for' => $intended_for, 'status !=' => 'resolved'));
		return $this->db->update('complaint_remarks', array('status' => $status));
	}




	function update_local_status($complaint_id, $receiver_id, $status)
	{
		$this->db->where(array('complaint_id' => $complaint_id, 'intended_for' => 'local', 'status !=' => 'resolved', 'receiver' => $receiver_id));
		return $this->db->update('complaint_remarks', array('status' => $status));	
	}

	function get_last_id()
	{
		$this->db->select('id');
		$result = $this->db->get('complaint')->last_row();
		return $result->id;
	}

	public function get_complainee_reply($complaint_id)
	{
		$this->db->select('ci.complainee_reply, ci.forward_date, ci.reply_date, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name');
		$this->db->where('ci.id', $complaint_id);
		$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');
		return $this->db->get('complaint_internal ci')->row();
	}

	public function get_project_provinces($project_id)
	{
		$this->db->select('DISTINCT(p.id), CONCAT(UCASE(LEFT(p.name, 1)), SUBSTRING(p.name, 2)) AS name');
		$this->db->join('provinces p', 'xol.province_id = p.id', 'left');
		$this->db->where('xol.company_id', $project_id);
		return $this->db->get('xin_office_location xol')->result();
	}

	public function get_project_districts($province_id, $project_id)
	{
		$this->db->select('DISTINCT(d.id),  CONCAT(UCASE(LEFT(d.name, 1)), SUBSTRING(d.name, 2)) AS name');
		$this->db->join('district d', 'xol.district_id = d.id', 'left');
		$this->db->where(array('xol.province_id' => $province_id, 'xol.company_id' => $project_id));
		return $this->db->get('xin_office_location xol')->result();
	}

	public function get_project_tehsils($district_id, $project_id)
	{
		$this->db->select('DISTINCT(t.id), CONCAT(UCASE(LEFT(t.name, 1)), SUBSTRING(t.name, 2)) AS name');
		$this->db->join('tehsil t', 'xol.tehsil_id = t.id', 'left');
		$this->db->where(array('xol.district_id' => $district_id, 'xol.company_id' => $project_id));
		return $this->db->get('xin_office_location xol')->result();
	}

	public function get_project_ucs($tehsil_id, $project_id)
	{
		$this->db->select('DISTINCT(u.id), CONCAT(UCASE(LEFT(u.name, 1)), SUBSTRING(u.name, 2)) AS name');
		$this->db->join('union_councel u', 'xol.uc_id = u.id', 'left');
		$this->db->where(array('xol.tehsil_id' => $tehsil_id, 'xol.company_id' => $project_id));
		return $this->db->get('xin_office_location xol')->result();
	}

	public function get_project_designations($project_id, $loc_id="", $loc_type="")
	{
		if($loc_type == 'province')
		{
			$table = 'provinces p';
			$join = 'xol.province_id = p.id';
			$condition = array('xol.province_id' => $loc_id);
		}
		elseif($loc_type == 'district')
		{
			$table = 'district d';
			$join = 'xol.district_id = d.id';
			$condition = array('xol.district_id' => $loc_id);
		}
		elseif($loc_type == 'tehsil')
		{
			$table = 'tehsil t';
			$join = 'xol.tehsil_id = t.id';
			$condition = array('xol.tehsil_id' => $loc_id);
		}
		elseif($loc_type == 'uc')
		{
			$table = 'union_councel u';
			$join = 'xol.uc_id = u.id';
			$condition = array('xol.uc_id' => $loc_id);
		}
		$this->db->select('DISTINCT(xd.designation_id), xd.designation_name');
		$this->db->join('xin_employees xe', 'xol.company_id = xe.company_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		if($loc_type != "")
		{
			$this->db->join($table, $join, 'left');
			$this->db->where($condition);
		}
		$this->db->where(array('xol.company_id' => $project_id));
		return $this->db->get('xin_office_location xol')->result();
	}

	public function get_project_employees($project_id, $loc_id="", $loc_type="")
	{
		if($loc_type == 'province')
		{
			$table = 'provinces p';
			$join = 'xol.province_id = p.id';
			$condition = array('xol.province_id' => $loc_id);
		}
		elseif($loc_type == 'district')
		{
			$table = 'district d';
			$join = 'xol.district_id = d.id';
			$condition = array('xol.district_id' => $loc_id);
		}
		elseif($loc_type == 'tehsil')
		{
			$table = 'tehsil t';
			$join = 'xol.tehsil_id = t.id';
			$condition = array('xol.tehsil_id' => $loc_id);
		}
		elseif($loc_type == 'uc')
		{
			$table = 'union_councel u';
			$join = 'xol.uc_id = u.id';
			$condition = array('xol.uc_id' => $loc_id);
		}

		$this->db->select('xd.designation_id, xd.designation_name, xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_employee_location xel', 'xe.employee_id = xel.employee_id', 'left');
		$this->db->join('xin_office_location xol', 'xel.location_id = xol.location_id', 'left');
		if($loc_type != "")
		{
			$this->db->join($table, $join, 'left');
			$this->db->where($condition);
		}
		$this->db->where('xol.company_id', $project_id);
		$this->db->order_by('xd.designation_id', 'ASC');
		return $this->db->get('xin_employees xe')->result();
	}


	public function update_employee_status($complaint_id, $data)
	{
		$this->db->where('employee_id', $complaint_id);
		return $this->db->update('xin_employees', $data);
	}



}