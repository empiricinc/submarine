<?php 

/**
 * 
 */
class Field_joining extends MY_Controller
{
	var $session_data;
	function __construct()
	{
		parent::__construct();
		if(empty($this->session->username))
            redirect(base_url());
		
		$roles = array(1, 2, 3);
        $user_role = $this->session->username['user_role'];

        $project_id = $this->session->username['project_id'];
        $province_id = $this->session->username['provience_id'];
        
        if(!in_array($user_role, $roles))
            redirect(base_url().'User_panel');

        if($user_role == 1 || $user_role == 2)
        {
            $project_id = '';
            $province_id = '';
        }

        $this->session_data = array(
                                'user_id' => $this->session->username['employee_id'], 
                                'project_id' => $project_id, 
                                'province_id' => $province_id
                            );

		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'html'));

		$this->load->database();


		$this->load->model(
			array(
				'Field_joining_model',
			 	'Reports_model',
			 	'Province_model',
				'Departments_model',
				'Designations_model',
				'Projects_model'
				)
			);
	}

	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	public function index()
	{
		$employee_id = $this->session_data['user_id'];

		$conditions = [ 
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.status' => '1'
					];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = "Field Joining Management Dashboard";
		$data['unverified'] = $this->Field_joining_model->get_employees($filtered_conditions, 5, "", "unverified")->result();

		$data['cnic_verified'] = $this->Field_joining_model->get_employees($filtered_conditions, 5, "", "cnic")->result();
		$data['doj_verified'] = $this->Field_joining_model->get_employees($filtered_conditions, 5, "", "doj")->result();
		$data['both_verified'] = $this->Field_joining_model->get_employees($filtered_conditions, 5, "", "both")->result();

		$data['content'] = $this->load->view('field_joining/dashboard', $data, TRUE);
		$this->load->view('field_joining/_template', $data);
	}


	function employees()
	{
		$offset = $this->input->get('page');
		$data['type'] = $record_type = $this->input->get('record_type');

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'], 
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.status' => '1'
					];


		if(isset($_GET['search']))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = $this->input->get('province');
			$project = $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;

			if($project != '')
				$conditions['xe.company_id'] = $project;
			if($province != '')
				$conditions['xe.provience_id'] = $province;
			
		} 
	
		$filtered_conditions = $this->remove_empty_entries($conditions);

		/* Pagination */

		$total_rows = $this->Field_joining_model->get_employees($filtered_conditions, "", "", $record_type)->num_rows();
		
		$url = 'Field_joining/employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url, TRUE);

		$data['query_string'] = $_SERVER['QUERY_STRING'];
		$data['title'] = 'List of Employees';
		$data['employees'] = $this->Field_joining_model->get_employees($filtered_conditions, $this->limit, $offset, $record_type)->result();

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['marital_status'] = $this->db->get('marital_status')->result();

		$data['employees_table'] = $this->load->view('field_joining/employees-table', $data, TRUE);
		$data['content'] = $this->load->view('field_joining/employees', $data, TRUE);
		$this->load->view('field_joining/_template', $data);
	}


	public function add_doj()
	{
		$entry_by = $this->session_data['user_id'];
		$office_location_id = $this->session->location_id;

		$date = date('Y-m-d');

		if(isset($_POST))
		{
			$employee_id = $this->input->post('employee_id');
			$source = $this->input->post('source_field_joining');
			$doj = $this->input->post('doj');
			$action = $this->input->post('action');

			$data = array(
						'employee_id' => $employee_id,
						'office_location_id' => $office_location_id,
						'verified_through' => $source,
						'doj' => $doj,
						'doj_entry_by' => $entry_by,
						'doj_entry_at' => $date
						);

			$result = '';
			if($action == 'add')
			{
				$result = $this->Field_joining_model->add_employee_doj($data);

			}

			elseif($action == 'update')
			{
				$where = array('employee_id' => $employee_id, 'office_location_id' => $office_location_id);
				$result = $this->Field_joining_model->update_field_joining($data, $where);
			}

			if($result)
				$this->session->set_flashdata('success', '<label>Success!</label> Action Performed Successfully.');
			else
				$this->session->set_flashdata('error', '<label>Error!</label> Server Problem.');
			
			

			redirect('Field_joining/employees', 'refresh');
		}
		else
		{
			show_404();
		}
	}

	public function cnic_check()
	{
		$entry_by = $this->session_data['user_id'];
		$office_location_id = $this->session->location_id;

		$date = date('Y-m-d');

		if(isset($_POST))
		{
			$employee_id = $this->input->post('employee_id');
			$cnic_no = $this->input->post('cnic_no');
			$cnic_expiry = $this->input->post('cnic_expiry');
			$dob = $this->input->post('dob');
			$marital_status = $this->input->post('marital_status');

			$action = $this->input->post('action');

			$data = array(
						'employee_id' => $employee_id,
						'office_location_id' => $office_location_id,
						'marital_status' => $marital_status,
						'cnic_no' => $cnic_no,
						'cnic_expiry' => $cnic_expiry,
						'dob' => $dob,
						'cnic_entry_by' => $entry_by,
						'cnic_entry_at' => $date
						);

			$result = '';
			if($action == 'add')
			{
				$result = $this->Field_joining_model->doj_cnic_check($data);

			}

			elseif($action == 'update')
			{
				$where = array('employee_id' => $employee_id, 'office_location_id' => $office_location_id);
				$result = $this->Field_joining_model->update_field_joining($data, $where);
			}

			if($result)
				$this->session->set_flashdata('success', '<label>Success!</label> Action Performed Successfully.');
			else
				$this->session->set_flashdata('error', '<label>Error!</label> Server Problem.');
			
			

			redirect('Field_joining/employees', 'refresh');
		}
		else
		{
			show_404();
		}
	}

	public function reportXLS()
	{
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $data['type'] = $type = $this->input->get('record_type');

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'], 
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.status' => '1'
					];


		if(isset($_GET['search']))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;

			if($project != 0)
				$conditions['xe.company_id'] = $project;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			
		} 
	
		$filtered_conditions = $this->remove_empty_entries($conditions);

        $field_joining = $this->Field_joining_model->get_employees($filtered_conditions, "", "", $type)->result();

        if(count($field_joining) == 0)
        	exit('No Records found');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();  

        foreach(range('A','L') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:J1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'Province');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Gender');
        $sheet->SetCellValue('D1', 'Designation');
        $sheet->SetCellValue('E1', 'DOB');       
        $sheet->SetCellValue('F1', 'CNIC');       
        $sheet->SetCellValue('G1', 'DOJ');                      
        $sheet->SetCellValue('H1', 'Verified through');  
        $sheet->SetCellValue('I1', 'DOJ Entry Date');  
        $sheet->SetCellValue('J1', 'CNIC Check Date');             
        // set Row
        $rowCount = 2;
        foreach ($field_joining as $e) {
        	
			$cnic_no = ($e->cnic_no == '') ? 'Unverified' : $e->cnic_no; 
			$doj = ($e->doj == '') ? 'Unverified' : date('d-m-Y', strtotime($e->doj));

            $sheet->SetCellValue('A' . $rowCount, ucfirst($e->province));
            $sheet->SetCellValue('B' . $rowCount, ucwords($e->emp_name));
            $sheet->SetCellValue('C' . $rowCount, ucfirst($e->gender));
            $sheet->SetCellValue('D' . $rowCount, ucfirst($e->designation_name));
            $sheet->SetCellValue('E' . $rowCount, date('d-m-Y', strtotime($e->date_of_birth)));
            $sheet->SetCellValue('F' . $rowCount, $cnic_no);
            $sheet->SetCellValue('G' . $rowCount, $doj);
            $sheet->SetCellValue('H' . $rowCount, $e->verified_through);
            $sheet->SetCellValue('H' . $rowCount, date('d-m-Y', strtotime($e->doj_entry_at)));
            $sheet->SetCellValue('I' . $rowCount, date('d-m-Y', strtotime($e->cnic_entry_at)));
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
		// download file
       	header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="field_joining.xlsx"');
        $objWriter->save('php://output');       
	}


}







 ?>