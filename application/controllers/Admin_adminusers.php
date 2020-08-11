<?php

/*
  @Author : Vinod K Maurya
  Description: employee invoice
  Dated :  07/03/2018
 */
error_reporting(0);
require_once APPPATH . '/mpdf60/mpdf.php';
require_once APPPATH . '/spout-2.7.3/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class Admin_adminusers extends CI_Controller {

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */
    const VIEW_FOLDER = 'admin/adminusers';

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }
	
    function dashboard() {

        $data = array();
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/dashboard';
        $this->load->view('includes/template', $data);
    }
	
	
	
	
	
	
	
	

    /**
     * This function is used to load the user list
     */
    function userListing() {

        $data['role'] = $this->session->userdata('role');
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;


        $this->load->library('pagination');

        $count = $this->user_model->userListingCount($searchText);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;


        $data['userRecords'] = $this->user_model->userListing($searchText);

        $this->global['pageTitle'] = 'CodeInsect : User Listing';
        $data['totaldata'] = $this->user_model->user_total();


        $data['main_content'] = 'admin/adminusers/users';
        $this->load->view('includes/template', $data);
    }

    function addNew() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('user_model');
        $data['roles'] = $this->user_model->getUserRoles();

        $this->global['pageTitle'] = 'CodeInsect : Add New User';


        $data['main_content'] = 'admin/adminusers/addNew';
        $this->load->view('includes/template', $data);
    }

    function viewmasterbuget() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Masterbudget_model');
        $data['budget_records'] = $this->Masterbudget_model->Budgetlist();
        $data['main_content'] = 'admin/adminusers/viewmasterbuget';


        $this->load->view('includes/template', $data);
    }

    function viewgradelist() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Grade_model');
        $data['display_all_data'] = $this->Grade_model->GradeList();
        $data['main_content'] = 'admin/adminusers/viewgradelist';
        $this->load->view('includes/template', $data);
    }

    function addempgrade() {
        $data['role'] = $this->session->userdata('role');

        $this->load->model('Grade_model');
        $this->load->model('User_model');
        $data['division_records'] = $this->Grade_model->DivisionList();

        $data['role'] = $this->session->userdata('role');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('division', 'Division', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('Grade', 'Grade', 'trim|required');
        $this->form_validation->set_rules('gradename', 'Grade name', 'required');
        $this->form_validation->set_rules('Incentive', 'Incentive', 'trim|required|numeric');
        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
        } else {

            if ($this->input->post()) {



                $division = $this->input->post('division');
                $Grade = $this->input->post('Grade');
                $gradename = $this->input->post('gradename');
                $Incentive = $this->input->post('Incentive');


                $graderecord = array('grade' => $Grade, 'grade_name' => $gradename, 'incentive' => $Incentive);

                $this->load->model('Grade_model');
                $result = $this->Grade_model->addgrade($graderecord);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Grade added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Grade  failed');
                }
            }

            redirect('admin_adminusers/viewgradelist');
        }


        $data['main_content'] = 'admin/adminusers/addempgrade';
        $this->load->view('includes/template', $data);
    }

    

    /**
     * This function is used to add new user to the system
     */
    function addNewUser() {
        $data['role'] = $this->session->userdata('role');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'User creation failed');
            redirect('admin_adminusers/addNew');
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array('email' => $email, 'password' => md5($password), 'roleId' => $roleId, 'name' => $name,
                'mobile' => $mobile, 'createdBy' => $data['role'], 'createdDtm' => date('Y-m-d H:i:s'));

            $this->load->model('user_model');
            $result = $this->user_model->addNewUser($userInfo);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }

            redirect('admin_adminusers/userListing');
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser() {

        $data['role'] = $this->session->userdata('role');

        $userId = $this->input->post('userId');
        $userInfo = array('isDeleted' => 1, 'updatedBy' => $data['role'], 'updatedDtm' => date('Y-m-d H:i:s'));

        $result = $this->user_model->deleteUser($userId, $userInfo);

        if ($result > 0) {
            echo(json_encode(array('status' => TRUE)));
        } else {
            echo(json_encode(array('status' => FALSE)));
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL) {

        $data['role'] = $this->session->userdata('role');


        if ($userId == null) {
            redirect('admin_adminusers/userListing');
        }

        $data['roles'] = $this->user_model->getUserRoles();
        $data['userInfo'] = $this->user_model->getUserInfo($userId);



        $this->global['pageTitle'] = 'ATMC : Edit User';


        $data['main_content'] = 'admin/adminusers/editOld';
        $this->load->view('includes/template', $data);
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists() {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            echo("true");
        } else {
            echo("false");
        }
    }

    /**
     * This function is used to edit the user information
     */
    function editUser() {
        $data['role'] = $this->session->userdata('role');
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check data.');
            redirect('admin_adminusers/addNew');
        } else {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->input->post('password');
            $roleId = $this->input->post('role');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));

            $userInfo = array();

            if (empty($password)) {
                $userInfo = array('email' => $email, 'roleId' => $roleId, 'name' => $name,
                    'mobile' => $mobile, 'updatedBy' => $data['role'], 'updatedDtm' => date('Y-m-d H:i:s'));
            } else {
                $userInfo = array('email' => $email, 'password' => md5($password), 'roleId' => $roleId,
                    'name' => ucwords($name), 'mobile' => $mobile, 'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s'));
            }

            $result = $this->user_model->editUser($userInfo, $userId);

            if ($result == true) {
                $this->session->set_flashdata('success', 'User updated successfully');
            } else {
                $this->session->set_flashdata('error', 'User updation failed');
            }

            redirect('admin_adminusers/userListing');
        }
    }

    //******** import employee***/

    function importemployee() {
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/importemployee';
        $this->load->view('includes/template', $data);
    }

    function importdata() {

        $data['role'] = $this->session->userdata('role');
        $this->load->model('Employeelist_old_model');
        $this->load->model('Employeelist_model');
        $this->form_validation->set_rules('file', 'Please Select valid Excel File', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        if ($this->input->server('REQUEST_METHOD') === 'POST' && !empty($_FILES['file']['name'])) {

            // if ($this->form_validation->run()) {
            // Get File extension eg. 'xlsx' to check file is excel sheet
            $pathinfo = pathinfo($_FILES["file"]["name"]);

            // check file has extension xlsx, xls and also check 
            // file is not empty


            if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls') && $_FILES['file']['size'] > 0) {

                // Temporary file name
                $inputFileName = $_FILES['file']['tmp_name'];

                // Read excel file by using ReadFactory object.
                $reader = ReaderFactory::create(Type::XLSX);

                // Open file
                $reader->open($inputFileName);


                $countData = $this->Employeelist_model->checkEmployeelistData();
                if ($countData > 0) {
                    $this->Employeelist_model->deleteallrecord();
                }

                $count = 1;

                // Number of sheet in excel file
                foreach ($reader->getSheetIterator() as $sheet) {

                    // Number of Rows in Excel sheet
                    foreach ($sheet->getRowIterator() as $row) {


                        if ($count > 1) {

                            /*                             * *** Data of excel sheet * */
                            if ($row[0] != "") {
                                $data['Name'] = $row[0];
                            } else {
                                $data['Name'] = "";
                            }
                            if ($row[1] != "") {
                                $data['Reporting'] = $row[1];
                            } else {
                                $data['Reporting'] = "";
                            }
                            if ($row[2] != "") {
                                $data['Division'] = $row[2];
                            } else {
                                $data['Division'] = "";
                            }
                            if ($row[3] != "") {
                                $data['Department'] = $row[3];
                            } else {
                                $data['Department'] = "";
                            }
                            if ($row[4] != "") {
                                $data['Grade'] = $row[4];
                            } else {
                                $data['Grade'] = "";
                            }
                            if ($row[5] != "") {
                                $data['rating'] = $row[5];
                            } else {
                                $data['rating'] = "";
                            }
                            if ($row[6] != "") {
                                $data['email'] = $row[6];
                            } else {
                                $data['email'] = "";
                            }
                            if ($row[7] != "") {
                                $data['empcode'] = $row[7];
                            } else {
                                $data['empcode'] = "";
                            }

                            $joiningdate = $row[8];
                            if ($joiningdate != "") {

                                foreach ($joiningdate as $key => $date) {
                                    
                                }

                                $data['joining'] = $joiningdate->format('Y-m-d');
                            }
                            if ($row[9] != "") {
                                $data['mobile'] = $row[9];
                            } else {
                                $data['mobile'] = "";
                            }




                            $data_to_store = array(
                                'name' => $data['Name'],
                                'reporting_to' => $data['Reporting'],
                                'division' => $data['Division'],
                                'department' => $data['Department'],
                                'grade' => $data['Grade'],
                                'rating' => $data['rating'],
                                'email' => $data['email'],
                                'empcode' => $data['empcode'],
                                'grading_date' => date('Y-m-d'),
                                'join_date' => $data['joining'],
                                'mobile_no' => $data['mobile'],
                                'status' => '0',
                            );


                            $this->Employeelist_model->store_information_excel($data_to_store);
                            $this->Employeelist_old_model->store_old_record_excel($data_to_store);



                            $this->session->set_flashdata('updated', 'Imported  excel data successfully!');
                        }



                        $count++;
                    }
                }

                if ($data != "") {
                    redirect('/admin_adminusers/employeelist', 'refresh', $data);
                }


                $reader->close();
            } else {


                $this->session->set_flashdata('updated', 'Please Select Valid Excel File!');
            }
        }
        //}
        else {
            
        }

        $data['main_content'] = 'admin/adminusers/importemployee';
        $this->load->view('includes/template', $data);
    }

    function editdepartemployeelist($editid) {
        $data['edit_id'] = $editid;
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Employeelist_model');
        $data['userId'] = $this->session->userdata('userId');
        $this->load->model('Grade_model');
        $this->load->model('User_model');
        $data['manager_records'] = $this->User_model->managerunique($data['userId']);
        $data['employee_records'] = $this->Employeelist_model->employeeunique($data['manager_records'][0]['email']);
        $data['all_employee_records'] = $this->Employeelist_model->manageremplist($data['employee_records'][0]['name']);
        $data['rating_records'] = $this->Grade_model->fetchrating();
        $data['emplist_records'] = $this->Employeelist_model->employeelist();
        $data['empedit_record'] = $this->Employeelist_model->employeelistedit($editid);

        $data['main_content'] = 'admin/adminusers/editdepartemployeelist';
        $this->load->view('includes/template', $data);
    }

    function updateratingemployee() {
        $updateid = $this->input->post('updateid');
        $data['role'] = $this->session->userdata('role');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('reasonrating', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('reporting', 'Reporting', 'trim|required');

        $this->form_validation->set_rules('employeename', 'Employee', 'trim|required');

        $this->form_validation->set_rules('Rating', 'Department', 'trim|required');







        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/editdepartemployeelist');
        } else {


            $updateRecord = array();
            $empid = $this->input->post('employeename');
            $updateRecord['name'] = $this->security->xss_clean($this->input->post('reporting'));

            $Rating = $this->security->xss_clean($this->input->post('Rating'));

            $reasonrating = $this->security->xss_clean($this->input->post('reasonrating'));

            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('tbl_employeelist', $updateRecord);

            $this->session->set_flashdata('success', 'Record update successfully');

            redirect('admin_adminusers/employeelist', 'refresh');
        }


        die;
    }

    function employeelist() {
        $data['role'] = $this->session->userdata('role');
        $this->load->model('Employeelist_model');
        $data['emplist_records'] = $this->Employeelist_model->employeelist();
        $data['main_content'] = 'admin/adminusers/employeelist';
        $this->load->view('includes/template', $data);
    }

    function editemplist($editid) {
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/editemplist';
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['grade_records'] = $this->Grade_model->GradeList();
        $data['division_records'] = $this->Grade_model->DivisionList();
        $data['department_records'] = $this->Grade_model->departmentlist();
        $data['manager_records'] = $this->User_model->managerlist();
        $data['editemp'] = $this->Employeelist_model->employeelistedit($editid);

        $this->load->view('includes/template', $data);
    }

    function updateemplist() {


        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('grade', 'Grade', 'trim|required');

        $this->form_validation->set_rules('reporting', 'Reporting Manager', 'trim|required');

        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('division', 'division', 'trim|required');


        $this->form_validation->set_rules('joindate', 'joindate', 'trim|required');
        $this->form_validation->set_rules('probation_date', 'probation date', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]');
        $this->form_validation->set_rules('Empcode', 'Empcode', 'trim|required|max_length[255]');

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');


        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/addstaff');
        } else {

            $this->load->model('Employeelist_model');
            $updateid = $this->input->post('updateid');
            $this->load->model('Employeelist_model');
            $jdate = explode("-", $this->input->post('joindate'));
            $jdateformat = $jdate[2] . "-" . $jdate[1] . "-" . $jdate[0];
            $provationdt = explode("-", $this->input->post('probation_date'));
            $provationdate = $provationdt[2] . "-" . $provationdt[1] . "-" . $provationdt[0];

            $updateRecord = array();
            $updateRecord['name'] = $this->input->post('fname');
            $updateRecord['grade'] = $this->input->post('grade');
            $updateRecord['reporting_to'] = $this->input->post('reporting');
            $updateRecord['department'] = $this->input->post('department');
            $updateRecord['division'] = $this->input->post('division');
            $updateRecord['join_date'] = $jdateformat;
            $updateRecord['probation_date'] = $provationdate;
            $updateRecord['email'] = $this->input->post('email');
            $updateRecord['empcode'] = $this->input->post('Empcode');
            $updateRecord['mobile_no'] = $this->input->post('mobile');
            $updateRecord['status'] = '0';


            $this->db->where('id', $updateid);
            $resultdata = $this->db->update('tbl_employeelist', $updateRecord);

            $this->session->set_flashdata('success', 'Record update successfully');

            redirect('admin_adminusers/employeelist', 'refresh');
        }
    }

    function addgrade() {

        $data['role'] = $this->session->userdata('role');
        $data['userId'] = $this->session->userdata('userId');
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['grade_records'] = $this->Grade_model->GradeList();

        $data['department_records'] = $this->Grade_model->departmentlist();
        $data['manager_records'] = $this->User_model->managerunique($data['userId']);

        $data['employee_records'] = $this->Employeelist_model->employeeunique($data['manager_records'][0]['email']);


        $data['all_employee_records'] = $this->Employeelist_model->manageremplist($data['employee_records'][0]['name']);

        $data['rating_records'] = $this->Grade_model->fetchrating();




        $data['main_content'] = 'admin/adminusers/addgrade';
        $this->load->view('includes/template', $data);
    }

    function viewdepartemployeelist() {


        $departmentdata = $this->input->post('departmentdata');
        $managername = $this->input->post('managername');
        $empname = $this->input->post('empname');







        $data['role'] = $this->session->userdata('role');
        $data['userId'] = $this->session->userdata('userId');
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['manager_records'] = $this->User_model->managerunique($data['userId']);

        $data['employee_records'] = $this->Employeelist_model->employeeunique($data['manager_records'][0]['email']);

        if ($data['role'] == 2) {
            $data['all_employee_records'] = $this->Employeelist_model->manageremplist($data['employee_records'][0]['name']);
        }
        if ($data['role'] == 1) {



            $data['search_managers'] = $this->Employeelist_model->searchManagerlist();
            $data['search_department'] = $this->Employeelist_model->searchdepartlist();


            $data['all_employee_records'] = $this->Employeelist_model->manageremplistadmin($departmentdata, $managername, $empname);
        }


        $data['main_content'] = 'admin/adminusers/viewdepartemployeelist';
        $this->load->view('includes/template', $data);
    }

    function checkmanagerlist() {
        $this->load->model('Employeelist_model');
        $depdata = $this->input->post('depdata');
        $data['search_managers_data'] = $this->Employeelist_model->searchManagerbydepartment($depdata);
        $dataval = '<select class="form-control" id="managername" name="managername" style="width:200px;" onchange="findmanager(this.value);>
        <option value="0">Select managers</option>';

        foreach ($data['search_managers_data'] as $val) {


            $dataval .= '<option  value=' . trim($val["id"]) . ' style="color:#000;">' . $val["reporting_to"] . '</option>';
        }

        $dataval .= '</select>';
        echo $dataval;
        die;
    }

    function checkEmplist() {
        $this->load->model('Employeelist_model');
        $managerid = $this->input->post('managerData');

        $data['check_man_data'] = $this->Employeelist_model->searchmname($managerid);
        $recordname = $data['check_man_data'][0]['reporting_to'];

        $data['check_all_data'] = $this->Employeelist_model->searchempname($recordname);

        $dataval = '<select class="form-control" style="width:200px" id="empname" name="empname" >
       <option value="0">Select Employee</option>';
        foreach ($data['check_all_data'] as $val) {

            $dataval .= '<option  value=' . $val["id"] . ' style="color:#000;">' . $val["name"] . '</option>';
        }


        $dataval .= '</select>';
        echo $dataval;
        die;
    }

    function editrating($editid) {
        $data1['role'] = $this->session->userdata('role');
        $editid = base64_decode($editid);
        $this->load->model('Rating_model');

        $data1['record'] = $this->Rating_model->editrecord($editid);

        $data1['main_content'] = 'admin/adminusers/editrating';
        $this->load->view('includes/template', $data1);
    }

    function updaterating() {
        $data1['role'] = $this->session->userdata('role');


        $updateRecord['month_name'] = $this->input->post('monthname');
        $updateid = $this->input->post('updateid');
        $updateRecord['firstrating'] = $this->input->post('firstrating');
        $updateRecord['firstpercentage'] = $this->input->post('firstpercentage');
        $updateRecord['secondrating'] = $this->input->post('secondrating');
        $updateRecord['secondpercentage'] = $this->input->post('secondpercentage');
        $updateRecord['thirdrating'] = $this->input->post('thirdrating');
        $updateRecord['thirdpercentage'] = $this->input->post('thirdpercentage');

        $this->db->where('id', $updateid);
        $resultdata = $this->db->update('tbl_master_rating', $updateRecord);
        if ($resultdata) {

            $this->session->set_flashdata('success', 'Rating updated successfully.');
            redirect('admin_adminusers/viewratinglist');
        }
    }

    function viewratinglist() {
        $this->load->model('Rating_model');
        $data['display_all_data'] = $this->Rating_model->ratinglist($recordname);
        $data['role'] = $this->session->userdata('role');
        $data['main_content'] = 'admin/adminusers/viewratinglist';
        $this->load->view('includes/template', $data);
    }

    function addratingemployee() {
        $data['role'] = $this->session->userdata('role');
        $empid = $this->input->post('employeename');
        $Rating = $this->input->post('Rating');
        $reasonrating = $this->input->post('reasonrating');
        $reporting = $this->input->post('reporting');

        $updateRecord['rating'] = $Rating;
        $updateRecord['rating_reason'] = $reasonrating;


        $this->db->where('id', $empid);
        $resultdata = $this->db->update('tbl_employeelist', $updateRecord);
        if ($resultdata) {

            $this->session->set_flashdata('success', 'Rating updated successfully.');
            redirect('admin_adminusers/viewdepartemployeelist');
        }
    }

    function checkdivision() {
        $depid = $this->input->post('depid');


        $this->load->model('Grade_model');
        $data['division_records'] = $this->Grade_model->DivisionListcheck($depid);
        foreach ($data['division_records'] as $val) {
            $divisionid = $val['id'];

            $dataval = '<select class="form-control required" id="division" name="division" onchange="checkmanager(' . $depid . ',' . $divisionid . ')">
                                            <option value="0">Select division</option>
                                            <option value=' . $val['id'] . '>' . $val['division_name'] . '</option>
                                        </select>';
            echo $dataval;
        }
        die;
    }

    function checkmanagerdata() {
        $departid = $this->input->post('departid');
        $divisionid = $this->input->post('divisionid');
        $this->load->model('Employeelist_model');
        $this->load->model('Grade_model');
        $data['departname_records'] = $this->Grade_model->departnameListcheck($departid);
        $departmentname = trim($data['departname_records'][0]['department_name']);


        $data['deivision_records'] = $this->Grade_model->divisionname($divisionid);
        $divisionname = $data['deivision_records'][0]['division_name'];

        $data['manager_records'] = $this->Employeelist_model->managerCheckrecord(
                $departmentname, $divisionname);
        foreach ($data['manager_records'] as $val) {

            $dataval = '<select class="form-control required" id="reporting" name="reporting">
                                            
                                             <option value=' . $val['id'] . '>' . $val['reporting_to'] . '</option>
                                           
                                        </select>';



            echo $dataval;
        }
        die;
    }

    function addstaff() {
        $data['role'] = $this->session->userdata('role');
        //echo CI_VERSION;
        $this->load->model('Grade_model');
        $this->load->model('User_model');

        $data['grade_records'] = $this->Grade_model->GradeList();
        $data['division_records'] = $this->Grade_model->DivisionList();
        $data['department_records'] = $this->Grade_model->departmentlist();
        $data['manager_records'] = $this->User_model->managerlist();

        $data['main_content'] = 'admin/adminusers/addstaff';
        $this->load->view('includes/template', $data);
    }

    function addstaffmember() {



        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('grade', 'Grade', 'trim|required');

        $this->form_validation->set_rules('reporting', 'Reporting Manager', 'trim|required');

        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('division', 'division', 'trim|required');


        $this->form_validation->set_rules('joindate', 'joindate', 'trim|required');
        $this->form_validation->set_rules('probation_date', 'probation date', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]');
        $this->form_validation->set_rules('Empcode', 'Empcode', 'trim|required|max_length[255]');

        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            //$this->editOld($userId);

            $this->session->set_flashdata('error', 'Please check fill data.');
            redirect('admin_adminusers/addstaff');
        } else {



            $this->load->model('Employeelist_model');
            $jdate = explode("-", $this->input->post('joindate'));
            $jdateformat = $jdate[2] . "-" . $jdate[1] . "-" . $jdate[0];
            $provationdt = explode("-", $this->input->post('probation_date'));
            $provationdate = $provationdt[2] . "-" . $provationdt[1] . "-" . $provationdt[0];

            $insertRecord = array();
            $insertRecord['name'] = $this->input->post('fname');
            $insertRecord['grade'] = $this->input->post('grade');
            $insertRecord['reporting_to'] = $this->input->post('reporting');
            $insertRecord['department'] = $this->input->post('department');
            $insertRecord['division'] = $this->input->post('division');
            $insertRecord['join_date'] = $jdateformat;
            $insertRecord['probation_date'] = $provationdate;
            $insertRecord['email'] = $this->input->post('email');
            $insertRecord['empcode'] = $this->input->post('Empcode');
            $insertRecord['mobile_no'] = $this->input->post('mobile');
            $insertRecord['status'] = '0';

            $data['insert_record'] = $this->Employeelist_model->store_information_excel($insertRecord);

            if ($data['insert_record']) {
                $this->session->set_flashdata('success', 'staff memeber added successfully');
                redirect('admin_adminusers/employeelist');
            }
        }
    }

    /**
     * This function used to create new password for user
     */
    function olddateajax() {

        $this->load->model('Members_invoice_old_model');
        $empcode = $this->input->post('empcode');
        $mname = $this->input->post('mname');
        if ($mname < 10) {

            $mname1 = $this->input->post('mname');
            $mname = str_pad($mname1, 2, '0', STR_PAD_LEFT);
        }

        $yname = $this->input->post('yname');
        $startdate = $yname . '-' . $mname . "-" . '01';

        $endday = cal_days_in_month(CAL_GREGORIAN, $mname, $yname); // 31
        $enddaymonth = $yname . "-" . $mname . "-" . $endday;


        //$startdatemain=explode("-",$startdate);
        //$startdate=$startdatemain[2]."-".$startdatemain[1]."-".$startdatemain[0];
        //$endatemain=explode("-",$enddaymonth);
        //$enddate=$endatemain[2]."-".$endatemain[1]."-".$endatemain[0];
        $record = $this->Members_invoice_old_model->detailssearchData($startdate, $enddaymonth, $empcode);


        $data = '<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Invoice No</th>
                <th>Currency</th>
                <th>Amount</th>
				<th>Country</th>
				<th>Approved By</th>
				<th>Nature</th>
				<th>Acoount Details</th>
				<th>Remarks</th>
				<th>Email Id</th>
				<th>Pan No</th>
				<th>Address</th>
				
				
				
            </tr>
        </thead>';
        $data .= '<tbody>';
        if ($record > 0) {
            foreach ($record as $valrecord) {

                $dataval = explode("-", $valrecord["Date"]);
                $validdateformat = $dataval[2] . "-" . $dataval[1] . "-" . $dataval[0];
                $data .= '<tr>
			<td>' . $valrecord["id"] . '</td>
			<td>' . $validdateformat . '</td>
			<td>' . $valrecord["Name"] . '</td>
			<td>' . $valrecord["invoice_no"] . '</td>
			<td>' . $valrecord["Currency"] . '</td>
			<td>' . $valrecord["Amount"] . '</td>
			<td>' . $valrecord["Country"] . '</td>
			<td>' . $valrecord["Approved_by"] . '</td>
			<td>' . $valrecord["Nature"] . '</td>
			<td>' . $valrecord["Account_Details"] . '</td>
			<td>' . $valrecord["Remarks"] . '</td>
			<td>' . $valrecord["email_id"] . '</td>
			<td>' . $valrecord["pan_no"] . '</td>
			<td>' . $valrecord["emp_address"] . '</td>
			
			
			</tr>';
            }


            $data .= '</tbody>
                </tr>
                </table>';
        } else {
            $data .= '<tr>
			<td colspan="19" align="center">No Record found</td>
			</tr>';
        }



        echo $data;

        die;
    }

}

?>