<?php 

/**
 * 
 */
class Employee_cards extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();

		$this->load->model(array(
							'Reports_model',
							'Investigation_model',
							'Resignations_model',
							'Terminations_model',
							'User_panel_model'
						));


	}

	function index()
	{
		$data['title'] = 'Employee Cards Dashboard';

		$data['cards'] = $this->Reports_model->get_employee_cards("", "", 20, "")->result();
		// echo $this->db->last_query(); exit;
		// var_dump($data['cards']); exit;
		$data['content'] = $this->load->view('employee-cards/dashboard', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}


	public function view()
	{
		$card_status = $this->uri->segment(3);
		if($card_status == "")
			$status = $card_status = $this->input->get('card_status');

		if($card_status == '1')
			$card_status = 'pending';
		elseif($card_status == '2')
			$card_status = 'printed';
		elseif($card_status == '3')
			$card_status = 'delivered';
		elseif($card_status == '4')
			$card_status = 'received';
		else
			show_404();

		$this->security->xss_clean($card_status);

		$employee_id = $employee_name = $designation_id = $project_id = $location_id = $province_id = $district_id = $tehsil_id = $uc_id = "1";
		$employee_type = "current";
		$conditions = "";
		if(isset($_GET['search']))
		{
			$employeeID = $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = $this->input->get('province');
			$district = $this->input->get('district');
			$tehsil = $this->input->get('tehsil');
			$uc = $this->input->get('uc');
			$project = $this->input->get('project');
			$designation = $this->input->get('designation');
			$location = $this->input->get('location');

			$employee_type = $this->input->get('employee_type');
			
			if($employeeID != "")
				$employee_id = "xe.employee_id = $employeeID";
			if($employeeName != "")
				$employee_name = "CONCAT_WS(' ', xe.first_name, xe.last_name) LIKE '%".$employeeName."%'";
			
			if($province != "")
				$province_id = "(pp.id = $province OR rp.id = $province)";
			if($district != "")
				$district_id = "(pd.id = $district OR rd.id = $district)";
			if($tehsil != "")
				$tehsil = "(pt.id = $tehsil OR rt.id = $tehsil)";
			if($uc != "")
				$uc_id = "(pu.id = $uc OR ru.id = $uc)";
			if($designation != "")
				$designation_id = "xd.designation_id = $designation";
			if($project != "")
				$project_id = "xc.company_id = $project";

			if($location != "")
				$location_id = "xol.location_id = $location";

			$conditions = "$employee_id AND $employee_name AND $designation_id AND $project_id AND $location_id AND $province_id AND $district_id AND $tehsil_id AND $uc_id";
		} 
		
		$data['title'] = 'Employee Cards';
		$data['employees'] = $this->Reports_model->get_employee_cards($conditions, $card_status, "", "")->result();
		// echo $this->db->last_query(); exit;
		$total_rows = $this->Reports_model->get_employee_cards()->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['designations'] = $this->Reports_model->get_designations();
		$data['provinces'] = $this->Reports_model->get_provinces();
		$data['projects'] = $this->Reports_model->get_companies();
		$data['locations'] = $this->Reports_model->get_locations();

		$data['card_status'] = $card_status;
		$data['content'] = $this->load->view('employee-cards/view', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}

	public function print_cards()
	{
		$status = $card_status = $this->uri->segment(3);
		$ids = $this->uri->segment(4);
		$employee_ids = explode('-', $ids);

		if($card_status == "")
			$card_status = $this->input->get('card_status');

		if($card_status == '1')
			$card_status = 'pending';
		elseif($card_status == '2')
			$card_status = 'printed';
		elseif($card_status == '3')
			$card_status = 'delivered';
		elseif($card_status == '4')
			$card_status = 'received';

		$data['title'] = 'Employee Cards';

		$employees = array();
		
		if($employee_ids[0] != "")
		{
			for ($i=0; $i < count($employee_ids); $i++) { 
				$condition = "ec.employee_id = " . $employee_ids[$i];
				$emp_data = $this->Reports_model->get_employee_cards($condition, $card_status, "", "")->row();
				array_push($employees, $emp_data);
			}
			$data['employees'] = $employees;
		}
		else
		{
			$data['employees'] = $this->Reports_model->get_employee_cards("", $card_status, "", "")->result();
		}
		
		// var_dump($employees);
		// echo $this->db->last_query(); exit;
		$total_rows = $this->Reports_model->get_employee_cards()->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['designations'] = $this->Reports_model->get_designations();
		$data['provinces'] = $this->Reports_model->get_provinces();
		$data['projects'] = $this->Reports_model->get_companies();
		$data['locations'] = $this->Reports_model->get_locations();
		$data['content'] = $this->load->view('employee-cards/print-view', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}

	public function received()
	{

		$card_status = 'delivered';
		$ids = $this->uri->segment(3);
		$employee_ids = explode('-', $ids);

		$data['title'] = 'Employee Cards';

				$employee_id = $employee_name = $designation_id = $project_id = $location_id = $province_id = $district_id = $tehsil_id = $uc_id = "1";
		$employee_type = "current";
		$conditions = "";
		if(isset($_GET['search']))
		{
			$employeeID = $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = $this->input->get('province');
			$district = $this->input->get('district');
			$tehsil = $this->input->get('tehsil');
			$uc = $this->input->get('uc');
			$project = $this->input->get('project');
			$designation = $this->input->get('designation');
			$location = $this->input->get('location');

			$employee_type = $this->input->get('employee_type');
			
			if($employeeID != "")
				$employee_id = "xe.employee_id = $employeeID";
			if($employeeName != "")
				$employee_name = "CONCAT_WS(' ', xe.first_name, xe.last_name) LIKE '%".$employeeName."%'";
			
			if($province != "")
				$province_id = "(pp.id = $province OR rp.id = $province)";
			if($district != "")
				$district_id = "(pd.id = $district OR rd.id = $district)";
			if($tehsil != "")
				$tehsil = "(pt.id = $tehsil OR rt.id = $tehsil)";
			if($uc != "")
				$uc_id = "(pu.id = $uc OR ru.id = $uc)";
			if($designation != "")
				$designation_id = "xd.designation_id = $designation";
			if($project != "")
				$project_id = "xc.company_id = $project";

			if($location != "")
				$location_id = "xol.location_id = $location";

			$conditions = "$employee_id AND $employee_name AND $designation_id AND $project_id AND $location_id AND $province_id AND $district_id AND $tehsil_id AND $uc_id";
		} 
		
		$data['title'] = 'Employee Cards';
		$data['employees'] = $this->Reports_model->get_employee_cards($conditions, $card_status, "", "")->result();
		// echo $this->db->last_query(); exit;
		$total_rows = $this->Reports_model->get_employee_cards()->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['designations'] = $this->Reports_model->get_designations();
		$data['provinces'] = $this->Reports_model->get_provinces();
		$data['projects'] = $this->Reports_model->get_companies();
		$data['locations'] = $this->Reports_model->get_locations();

		$data['card_status'] = $card_status;
		$data['content'] = $this->load->view('employee-cards/card-received', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}


	public function change_status()
	{	

		$ids = $this->uri->segment(3);
		$employee_ids = explode('-', $ids);

		$status = $card_status = $this->uri->segment(4);
		$is_dash = $this->uri->segment(5);
		
		if($card_status == "")
			show_404();


		$employees = array();
		$date = date('Y-m-d');
		$date_type = '';

		if($card_status == "")
			$card_status = $this->input->get('card_status');

		if($card_status == '1')
		{
			$card_status = 'printed';
			$date_type = 'print_date';
		}
		elseif($card_status == '2')
		{
			$card_status = 'delivered';
			$date_type = 'deliver_date';
		}
		elseif($card_status == '3')
		{
			$card_status = 'received';
			$date_type = 'receive_date';
		}

		$data['title'] = 'Employee Cards';

		
		if($employee_ids[0] != "")
		{
			for ($i=0; $i < count($employee_ids); $i++) { 
				$this->db->update('employee_cards', 
									array('card_status' => $card_status, $date_type => $date), 
									array('employee_id' => $employee_ids[$i])
								);
			}
		}
		else
		{
			$this->db->update('employee_cards', 
								array('card_status' => $card_status)
							);
		}
		// echo $this->db->last_query(); exit;

		
		if($is_dash == '1')
			redirect('Employee_cards/index');
		else if($card_status == 'received')
			redirect('Employee_cards/received');
		redirect(base_url().'Employee_cards/view/'.$status, 'refresh');
	}





}

