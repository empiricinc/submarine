<?php 

/**
 * 
 */
class Reports extends MY_Controller
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
		$data['title'] = 'Reports Dashboard';
		$data['content'] = $this->load->view('reports/dashboard', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}


	function employees($offset=NULL)
	{
		$employee_id = $employee_name = $designation_id = $project_id = $location_id = $province_id = $district_id = $tehsil_id = $uc_id = "1";
		$employee_type = "current";
		$conditions = "";
		if(isset($_POST['search']))
		{
			$employeeID = $this->input->post('employee_id');
			$employeeName = $this->input->post('employee_name');
			$province = $this->input->post('province');
			$district = $this->input->post('district');
			$tehsil = $this->input->post('tehsil');
			$uc = $this->input->post('uc');
			$project = $this->input->post('project');
			$designation = $this->input->post('designation');
			$location = $this->input->post('location');

			$employee_type = $this->input->post('employee_type');
			
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
		
		/* Pagination */

		$total_rows = $this->Reports_model->get_employees()->num_rows();
		$url = 'Reports/employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		/* end pagination */

		
		/* Store values in session variable. 
		   If user click export than employee list based on these values will
		   be generated. */
		if($employee_type != 'current')
		{
			$employee_search = array(
							'emp_search_conditions' => $conditions,
							'emp_search_type' => $employee_type
							);
			$this->session->set_userdata($employee_search);
		}
		else
		{
			unset(
			        $_SESSION['emp_search_conditions'],
			        $_SESSION['emp_search_type']
			);
		}
		
		/* Session variables are set. */

		$data['title'] = 'List of Employees';
		$data['employees'] = $this->Reports_model->get_employees($conditions, $employee_type, $this->limit, $offset)->result();
		
		$data['designations'] = $this->Reports_model->get_designations();
		$data['provinces'] = $this->Reports_model->get_provinces();
		$data['projects'] = $this->Reports_model->get_companies();
		$data['locations'] = $this->Reports_model->get_locations();
		$data['content'] = $this->load->view('reports/employees', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}


	function ajax_check()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
	}

	public function json_response($data)
	{
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode(array('data' => $data)));
	}


	public function district_for_province()
	{
		$this->ajax_check();
		$province_id = $this->input->post('province_id');
		$districts = $this->Reports_model->get_district_province($province_id);

		$this->json_response($districts);
	}

	public function tehsil_for_district()
	{
		$this->ajax_check();
		$district_id = $this->input->post('district_id');
		$tehsils = $this->Reports_model->get_tehsil_district($district_id);

		$this->json_response($tehsils);
	}

	public function uc_for_tehsil()
	{
		$this->ajax_check();
		$tehsil_id = $this->input->post('tehsil_id');
		$union_councils = $this->Reports_model->get_uc_tehsil($tehsil_id);

		$this->json_response($union_councils);
	}


	function resignations()
	{	
		$total_rows = $this->Resignations_model->get_resignations()->num_rows();
		$url = 'Reports/resignations';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		$data['r_employees'] = $this->Resignations_model->get_resignations()->result();
		
		$data['title'] = 'List of Resigned Employees';
		$data['content'] = $this->load->view('reports/resignations', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	function terminations()
	{
		$total_rows = $this->Terminations_model->get_terminations()->num_rows();
		$url = 'Reports/terminations';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['title'] = "List of terminated employees";
		// $data['terminated'] = $this->Terminations_model->get_terminations();
		$data['terminated'] = $this->Terminations_model->get_terminations()->result();
		$data['content'] = $this->load->view("reports/terminations", $data, TRUE);
		$this->load->view('reports/_template', $data);
	}


	function complaints($offset="")
	{
		$total_rows = $this->Investigation_model->get_complaints()->num_rows();
		$url = 'Reports/complaints';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$complaint_status = array(
						'complaint_status' => 'all'
						);
		$this->session->set_userdata($complaint_status);
		
		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints(FALSE, $this->limit, $offset)->result();
		
		$data['complaints_table'] = $this->load->view('reports/tables/complaints-table', $data, TRUE);
		$data['content'] = $this->load->view('reports/complaints', $data, TRUE);

		$this->load->view('reports/_template', $data);
	}


	function get_complaints_table()
    {
    	$status = $this->input->get('status');
    	$total_rows = $this->Investigation_model->get_complaints($status)->num_rows();
    	$url = 'Reports/complaints';

    	$complaint_status = array(
						'complaint_status' => $status
						);
		$this->session->set_userdata($complaint_status);

    	$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
    	$data['title'] = 'List of Complaints'; 
		$data['complaints'] = $this->Investigation_model->get_complaints($status, $this->limit)->result();
		$output = $this->load->view('reports/tables/complaints-table', $data, TRUE);
		echo $output;																																	  
    }



	public function employee_detail($employee_id)
	{
		$id = 6;

		if(!empty($id))
		{
			$data['title'] = 'Employee Detail';

			// $emp_info = $data['basic_info'] = $this->User_panel_model->emp_basic_info($id);
			$emp_info = $data['detail'] = $this->Reports_model->get_employee_detail($id);

			$data['title'] = "Employee Detail";
			// $data['terminated'] = $this->Terminations_model->get_terminations();
			$data['detail'] = $this->Reports_model->get_employee_detail($employee_id);
			$data['content'] = $this->load->view('reports/employee-detail', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
		
	}


	public function createEmployeeXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');
        $empInfo = $this->Reports_model->get_employees($this->session->emp_search_conditions, $this->session->emp_search_type)->result();
        // var_dump($empInfo); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'DOB');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Contact_No');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Residentail Address');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Permanent Address');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Company Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Department');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Designation');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Location');  

        if($this->session->emp_search_type == "resigned")
        {
	        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Resignation Reason');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Other Reason');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Description');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Resignation Date');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Accepted By');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Accepted Date');  
        }    
        elseif($this->session->emp_search_type == "terminated")
        {
	        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Termination Reason');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Other Reason');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Description');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Notice Date');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Terminated By');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Termination Date');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Termination Accepted By');  
	        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Accepted Date');  
        }   

        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->employee_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->emp_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->gender);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, date('d-m-Y', strtotime($element->date_of_birth)));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->contact_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->r_address);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->p_address);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->company_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->department_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element->designation_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element->location_name);

            if($this->session->emp_search_type == 'resigned')
       		{
	            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element->reason_text);
	            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element->other_reason);
	            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element->description);
	            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element->termination_date);
	            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element->resignation_accepted_by);
	            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $element->accepted_date);
        	}
        	elseif($this->session->emp_search_type == 'terminated')
       		{
	            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element->reason_text);
	            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element->other_reason);
	            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element->description);
	            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element->notice_date);
	            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element->termination_by);
	            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $element->terminated_at);
	            $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $element->termination_accepted_by);
	            $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $element->confirmed_date);
        	}
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect($fileName);        
    }


    public function createComplaintsXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $status = $this->session->complaint_status;
        $complaints = $this->Investigation_model->get_complaints($status)->result();
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Complaint No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Contact');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Subject');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Description');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Province');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'District');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Tehsil');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'UC');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Filing Date');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Status');       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Closing Remarks');       
        // set Row
        $rowCount = 2;
        foreach ($complaints as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->complaint_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->contact_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->subject);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->complaint_desc);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->province);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->district);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->tehsil);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->uc);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element->created_at);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element->status);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element->closing_remarks);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect($fileName);        
    }


    public function resignationsXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');
        $resignations = $this->Resignations_model->get_resignations();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Designation');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Other Reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Subject');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Description'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Resignation Date'); 


        // set Row
        $rowCount = 2;
        foreach ($resignations as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->employee_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, ucwords($element->first_name . ' ' . $element->last_name));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->designation_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->reason_text);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->reason);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->subject);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->description);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->resignation_date);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect($fileName);        
    }


    public function terminationsXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');
        $terminations = $this->Terminations_model->get_terminations()->result();
        // var_dump($terminations); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Designation');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Other Reason');   
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Description'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Notice Date'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Terminated by'); 


        // set Row
        $rowCount = 2;
        foreach ($terminations as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->user_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element->employee_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->designation_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->reason_text);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->other_reason);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->description);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->notice_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->terminator);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect($fileName);        
    }

}

