<?php 

/**
 * 
 */
class Investigation_model extends CI_Model
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
		if(array_key_exists('i.complaint_id', $conditions))
		{
			$this->db->select('c.*, i.id AS investigation_id, i.sender, i.sender_remarks, i.status AS inv_status, i.send_from, i.r_date, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
	
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			$this->db->where(array('i.status !=' => 'resolved', 'i.intended_for' => 'legal', 'i.type' => 'external'));

			if(!empty($conditions))
				$this->db->where($conditions);

			return $this->db->get('investigation AS i');
		}

		$this->db->select('MAX(i.r_date) AS r_date, MAX(i.status) AS status, c.id AS complaint_id, c.complaint_no, c.subject, c.name, c.contact_no, p.name AS province');
		$this->db->join('investigation AS i', 'c.id = i.complaint_id','left');
		$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');
		
		$this->db->group_by('c.id');

		if(!empty($conditions))
			$this->db->where($conditions);

		if(!array_key_exists('i.status', $conditions))
			$this->db->where('i.status !=', 'resolved');

		$this->db->limit($limit, $offset);

		return $this->db->get('complaint AS c');
	}

	function get_complaints_local($conditions=array(), $limit="", $offset="")
	{

		if(array_key_exists('i.complaint_id', $conditions))
		{	
			$this->db->select('c.*, i.id AS investigation_id, i.sender, i.sender_remarks, i.status AS inv_status, i.receiver, i.send_from, i.r_date, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
	
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			$this->db->where('i.intended_for', 'local');
			$this->db->where("(i.status = 'process' OR i.status = 'pending')");
			$this->db->where($conditions);
	
			$result = $this->db->get('investigation AS i');
		}
		else
		{
			$this->db->select('i.*, c.complaint_no, c.subject, c.name, c.contact_no, p.name AS province');
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');	
			$this->db->where('i.intended_for', 'local');
			
			$this->db->where("(i.status = 'process' OR i.status = 'pending')");
			$this->db->where($conditions);

			$this->db->limit($limit, $offset);
			$result = $this->db->get('investigation AS i');
		}


		return $result;
	}


	function get_complaints_internal($conditions=array(), $limit="", $offset="")
	{
		if(array_key_exists('ci.id', $conditions))
		{
			$this->db->select('ci.*, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS action_taken_by');
			$this->db->join('xin_companies AS xc', 'ci.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'ci.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'ci.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'ci.reason_id = ir.id', 'left');
			$this->db->join('employee_basic_info ebi', 'ci.employee_id = ebi.user_id', 'left');
			$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');
					
			$this->db->join('xin_employees atb', 'ci.action_by = atb.employee_id', 'left');
			$this->db->where($conditions);
			return $this->db->get('complaint_internal AS ci');
		}

		$this->db->select('ci.*, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name');
		$this->db->join('xin_companies AS xc', 'ci.project_id = xc.company_id', 'left');
		$this->db->join('xin_designations AS xd', 'ci.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments AS xds', 'ci.department_id = xds.department_id', 'left');
		$this->db->join('investigation_reasons AS ir', 'ci.reason_id = ir.id', 'left');
		$this->db->join('employee_basic_info ebi', 'ci.employee_id = ebi.user_id', 'left');
		$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');
		
		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

		return $this->db->get('complaint_internal AS ci');
	}

	function get_legal_internal($conditions=array(), $limit="", $offset="")
	{
		if(array_key_exists('i.complaint_id', $conditions))
		{	
			$this->db->select('ci.*, i.id AS investigation_id, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS action_taken_by');
			$this->db->join('complaint_internal ci', 'i.complaint_id = ci.id', 'left');
			$this->db->join('xin_companies AS xc', 'ci.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'ci.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'ci.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'ci.reason_id = ir.id', 'left');
			$this->db->join('employee_basic_info ebi', 'ci.employee_id = ebi.user_id', 'left');
			$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');
					
			$this->db->join('xin_employees atb', 'ci.action_by = atb.employee_id', 'left');

			$this->db->where(array('i.status !=' => 'resolved', 'i.intended_for' => 'legal', 'i.type' => 'internal'));

			$this->db->where($conditions);
			$result = $this->db->get('investigation AS i');
		}
		else
		{
			$this->db->select('ci.*, MAX(i.status) AS inv_status, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, MAX(CONCAT(xe.first_name, " ", IFNULL(xe.last_name, ""))) AS emp_name');
			$this->db->join('complaint_internal ci', 'i.complaint_id = ci.id', 'left');
			$this->db->join('xin_companies AS xc', 'ci.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'ci.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'ci.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'ci.reason_id = ir.id', 'left');
			$this->db->join('employee_basic_info ebi', 'ci.employee_id = ebi.user_id', 'left');
			$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');

			if(!array_key_exists('i.status', $conditions))
				$this->db->where('i.status !=', 'resolved');

			$this->db->where(array('i.intended_for' => 'legal', 'i.type' => 'internal'));
			$this->db->where($conditions);

			$this->db->group_by('i.complaint_id');
			$this->db->limit($limit, $offset);

			$result = $this->db->get('investigation AS i');
		}


		return $result;
	}

	function get_local_internal($conditions=array(), $limit="", $offset="")
	{
		if(array_key_exists('i.complaint_id', $conditions))
		{	
			$this->db->select('ci.*, i.id AS investigation_id, i.receiver, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS action_taken_by');
			$this->db->join('complaint_internal ci', 'i.complaint_id = ci.id', 'left');
			$this->db->join('xin_companies AS xc', 'ci.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'ci.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'ci.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'ci.reason_id = ir.id', 'left');
			$this->db->join('employee_basic_info ebi', 'ci.employee_id = ebi.user_id', 'left');
			$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');
		
			$this->db->join('xin_employees atb', 'ci.action_by = atb.employee_id', 'left');


			$this->db->where('i.intended_for', 'local');
			$this->db->where( 'i.type', 'internal');
			$this->db->where("(i.status = 'process' OR i.status = 'pending')");

			$this->db->where($conditions);

	
			$result = $this->db->get('investigation AS i');
		}
		else
		{
			$this->db->select('ci.*, MAX(i.status) AS inv_status, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, MAX(CONCAT(xe.first_name, " ", IFNULL(xe.last_name, ""))) AS emp_name');
			$this->db->join('complaint_internal ci', 'i.complaint_id = ci.id', 'left');
			$this->db->join('xin_companies AS xc', 'ci.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'ci.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'ci.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'ci.reason_id = ir.id', 'left');
			$this->db->join('employee_basic_info ebi', 'ci.employee_id = ebi.user_id', 'left');
			$this->db->join('xin_employees xe', 'ci.employee_id = xe.employee_id', 'left');

			$this->db->where('i.intended_for', 'local');
			$this->db->where( 'i.type', 'internal');
			$this->db->where("(i.status = 'process' OR i.status = 'pending')");
			
			$this->db->where($conditions);

			$this->db->group_by('i.complaint_id');
			$this->db->limit($limit, $offset);

			$result = $this->db->get('investigation AS i');
		}


		return $result;
	}
	
	/*****************************************************************************************/
	function add_complaint($data)
	{
		return $this->db->insert('complaint', $data);
	}

	function add_investigation($data)
	{
		return $this->db->insert('complaint_internal', $data);
	}


	function get_employees_by_designation($designation_id)
	{
		$this->db->select("e.employee_id, CONCAT(IFNULL(e.first_name, ''), ' ', IFNULL(e.last_name, '')) AS employee_name");
		return $this->db->get_where('xin_employees e', array('designation_id' => $designation_id))->result();
	}

	function check_complaint_existence($complaint_id)
	{
		return $this->db->get_where('investigation', array('complaint_id' => $complaint_id, 'status !=' => 'resolved', 'type' => 'external'));
	}

	function check_complaint_existence_internal($complaint_id)
	{
		return $this->db->get_where('investigation', array('complaint_id' => $complaint_id, 'status !=' => 'resolved', 'type' => 'internal'));
	}


	function get_project_head($complaint_id)
	{
		$this->db->select('e.first_name, e.last_name');
		$this->db->join('xin_employees e', 'c.remarks_by = e.user_id', 'left');
		$this->db->where('c.id', $complaint_id);
		return $this->db->get('complaint c')->row();
	}

	function get_project_head_internal($complaint_id)
	{
		$this->db->select('e.first_name, e.last_name');
		$this->db->join('xin_employees e', 'ci.remarks_by = e.user_id', 'left');
		$this->db->where('ci.id', $complaint_id);
		return $this->db->get('complaint_internal ci')->row();
	}


	function get_remarks($complaint_id, $type="")
	{
		$this->db->select('i.*, e.first_name, e.last_name');
		$this->db->order_by('r_date', 'asc');
		$this->db->join('xin_employees e', 'i.sender = e.employee_id', 'left');
		return $this->db->get_where('investigation i', array('i.complaint_id' => $complaint_id, 'i.type' => $type))->result_array();

	}

	function get_files($investigation_id)
	{
		return $this->db->get_where('investigation_files if', array('if.investigation_id' => $investigation_id))->result_array();
	}

	function close_investigation($data, $complaint_id)
	{
		$this->db->where(array('id' => $complaint_id));
		return $this->db->update('complaint', $data);
	}

	function close_investigation_internal($data, $complaint_id)
	{
		$this->db->where(array('id' => $complaint_id));
		return $this->db->update('complaint_internal', $data);
	}

	function update_investigation_status($complaint_id, $status)
	{
		$this->db->where('complaint_id', $complaint_id);
		return $this->db->update('investigation', array('status'=> $status));
	}

	function add($data)
	{
		return $this->db->insert('investigation', $data);
	}

	function update_complaint_status($complaint_id, $status)
	{
		$this->db->where('id', $complaint_id);
		return $this->db->update('complaint', array('status' => $status));
	}

	function update_complaint_status_internal($complaint_id, $status)
	{
		$this->db->where('id', $complaint_id);
		return $this->db->update('complaint_internal', array('status' => $status));
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
		return $this->db->update('investigation', array('status' => $status));
	}


	function investigation_local_existence($complaint_id)
	{
		return $this->db->get_where('investigation', array('complaint_id' => $complaint_id, 'intended_for' => 'local', 'status !=' => 'resolved', 'type' => 'external'));
	}

	function investigation_local_existence_internal($complaint_id)
	{
		return $this->db->get_where('investigation', array('complaint_id' => $complaint_id, 'intended_for' => 'local', 'status !=' => 'resolved', 'type' => 'internal'));
	}



	function update_local_status($complaint_id, $receiver_id, $status)
	{
		$this->db->where(array('complaint_id' => $complaint_id, 'intended_for' => 'local', 'status !=' => 'resolved', 'receiver' => $receiver_id));
		return $this->db->update('investigation', array('status' => $status));	
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

	// public function get_project_designations($conditions=array())
	// {

	// 	$this->db->select('DISTINCT(xd.designation_id) AS designation_id, xd.designation_name');
	// 	$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
	// 	$this->db->where($conditions);
	// 	return $this->db->get('xin_employees xe')->result();
	// }

	// public function get_project_employees($conditions=array())
	// {
	// 	$this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name');
	// 	$this->db->where($conditions);
	// 	return $this->db->get('xin_employees xe')->result();
	// }

	public function get_previous_inquiries($employee_id)
	{
		$this->db->select('ci.id AS complaint_id, ci.*, ir.reason_text');
		$this->db->join('investigation_reasons ir', 'ci.reason_id = ir.id', 'left');
		$this->db->where('employee_id', $employee_id);
		return $this->db->get('complaint_internal ci')->result();
	}

	public function add_disciplinary_action($complaint_id, $data)
	{
		$this->db->where('id', $complaint_id);
		return $this->db->update('complaint_internal', $data);
	}


	public function update_employee_status($complaint_id, $data)
	{
		$this->db->where('employee_id', $complaint_id);
		return $this->db->update('xin_employees', $data);
	}


	public function employee_info($conditions=array(), $limit="", $offset="", $user_roles=array())
	{
		$employee_basic_info_fileds = ", ebi.father_name, ebi.date_of_birth, ebi.cnic, ebi.cnic_expiry_date, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.other_languages, ebi.relation_id AS relation, ebi.gender, ebi.marital_status, ebi.tribe, ebi.ethnicity, ebi.language, ebi.nationality, ebi.religion, ebi.bloodgroup, xec.contract_type_id, xec.from_date AS date_of_joining, xec.to_date AS contract_expiry_date, g.gender_name, m.marital_name, c.country_name, r.religion_name, t.tribe_name, e.ethnicity_name, l.language_name, bg.blood_group_name";


		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.email AS email_address, xe.profile_picture, xc.company_id, g.gender_name,
		 xc.name as company_name, xdd.department_id, xdd.department_name, xd.designation_id, xd.designation_name, xol.location_name, xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.provience_id,
            epli.permanent_address_details, permanent_province, permanent_district, permanent_tehsil, permanent_uc,
            eri.resident_address_details, resident_province, resident_district, resident_tehsil, resident_uc $employee_basic_info_fileds");
		      
        $this->db->join('xin_employee_location xel', 'xe.employee_id = xel.employee_id', 'left');
        $this->db->join('xin_office_location xol', 'xel.office_location_id = xol.location_id', 'left');

        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');

        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        
        $this->db->join('xin_employee_contract xec', 'ebi.user_id = xec.employee_id', 'left');
        $this->db->join('xin_contract_type xct', 'xec.contract_type_id = xct.contract_type_id', 'left');

        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        $this->db->join('marital_status m', 'ebi.marital_status = m.marital_id', 'left');
        $this->db->join('xin_countries c', 'ebi.nationality = c.country_id', 'left');

        $this->db->join('religion r', 'ebi.religion = r.id', 'left');
        $this->db->join('tribe t', 'ebi.tribe = t.tribe_id', 'left');
        $this->db->join('ethnicity e', 'ebi.ethnicity = e.ethnicity_id', 'left');
        $this->db->join('language l', 'ebi.language = l.language_id', 'left');
        $this->db->join('blood_group bg', 'ebi.bloodgroup = bg.blood_group_id', 'left');

        $this->db->where($conditions);
        if(!empty($user_roles))
        	$this->db->where_not_in('xe.user_role_id', array(1, 2));
        
        $this->db->limit($limit, $offset);

        return $this->db->get('xin_employees xe');
	}



}