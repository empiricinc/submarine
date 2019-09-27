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

	function add_complaint($data)
	{
		return $this->db->insert('complaint', $data);
	}

	function get_complaints($status=FALSE, $limit="", $offset="")
	{	
		$this->db->select('c.*, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
		$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');
		$this->db->join('district AS d', 'c.district_id = d.id', 'left');
		$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
		$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');

		$this->db->limit($limit, $offset);
		
		if($status === FALSE || $status == 'all')
		{
			$result = $this->db->get('complaint AS c');
		}
		else
		{
			$result = $this->db->get_where('complaint AS c', array('status' => $status));
		}
		
		
		return $result;
	}

	function get_employees_by_designation($designation_id)
	{
		$this->db->select("e.employee_id, CONCAT(e.first_name, ' ', e.last_name) AS employee_name");
		return $this->db->get_where('xin_employees e', array('designation_id' => $designation_id))->result();
	}

	function check_complaint_existence($complaint_id)
	{
		return $this->db->get_where('investigation', array('complaint_id' => $complaint_id, 'status !=' => 'resolved'));
	}

	function get_complaint_detail($complaint_id)
	{
		$this->db->select('c.*, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
		$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
		$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
		$this->db->join('district AS d', 'c.district_id = d.id', 'left');
		$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');
		return $this->db->get_where('complaint AS c', array('c.id' => $complaint_id))->row();
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
		$this->db->select('i.*, e.first_name, e.last_name');
		$this->db->order_by('r_date', 'asc');
		$this->db->join('xin_employees e', 'i.sender = e.employee_id', 'left');
		return $this->db->get_where('investigation i', array('i.complaint_id' => $complaint_id))->result_array();

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

	/* Legal View */

	function get_complaints_legal($id=FALSE, $status=FALSE, $limit="", $offset="")
	{
		
		

		if($id === FALSE)
		{	
			$this->db->select('i.*, c.complaint_no, c.subject, c.name, c.contact_no, p.name AS province');
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');
			if($status === FALSE || $status == 'all')
				$this->db->where('i.status !=', 'resolved');
			else
				$this->db->where('i.status', $status);
			
			$this->db->group_by('i.complaint_id');
			$this->db->where(array('i.intended_for' => 'legal'));
			$this->db->limit($limit, $offset);

			$result = $this->db->get('investigation AS i');
		}
		else
		{
			$this->db->select('c.*, i.id AS investigation_id, i.sender, i.sender_remarks, i.status AS inv_status, i.send_from, i.r_date, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
	
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			$this->db->where(array('i.status !=' => 'resolved', 'i.complaint_id' => $id, 'i.intended_for' => 'legal'));

	
			$result = $this->db->get_where('investigation AS i');
		}


		return $result;
	}

	// function legal_resolved($data)
	// {
	// 	return $this->db->insert('investigation', $data);
	// }

	function upload($files = array())
	{
		return $this->db->insert_batch('investigation_files', $files);
	}


	function update_status($complaint_id, $status, $intended_for)
	{
		$this->db->where(array('complaint_id' => $complaint_id, 'intended_for' => $intended_for, 'status !=' => 'resolved'));
		return $this->db->update('investigation', array('status' => $status));
	}

	function investigation_local_existence($complaint_id, $employee_id)
	{
		return $this->db->get_where('investigation', array('complaint_id' => $complaint_id, 'intended_for' => $employee_id, 'status !=' => 'resolved'));
	}


	/** Local View **/

	function get_complaints_local($id=FALSE)
	{
		
		

		if($id === FALSE)
		{	
			$this->db->select('i.*, c.complaint_no, c.subject, c.name, c.contact_no, p.name AS province');
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');	
			$this->db->where('i.intended_for', 'local');
			
			$this->db->where("(i.status = 'process' OR i.status = 'pending')");
			$result = $this->db->get('investigation AS i');
		}
		else
		{
			$this->db->select('c.*, i.id AS investigation_id, i.sender, i.sender_remarks, i.status AS inv_status, i.receiver, i.send_from, i.r_date, p.name AS province, d.name AS district, t.name AS tehsil, u.name AS uc');
	
			$this->db->join('complaint AS c', 'i.complaint_id = c.id','left');
			$this->db->join('union_councel AS u', 'c.uc_id = u.id', 'left');
			$this->db->join('tehsil AS t', 'c.tehsil_id = t.id', 'left');
			$this->db->join('district AS d', 'c.district_id = d.id', 'left');
			$this->db->join('provinces AS p', 'c.province_id = p.id', 'left');

			$this->db->where('i.intended_for', 'local');
			$this->db->where('i.complaint_id', $id);
			$this->db->where("(i.status = 'process' OR i.status = 'pending')");
	
			$result = $this->db->get_where('investigation AS i');
		}


		return $result;
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


}