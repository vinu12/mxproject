<?php

class Eventreg_controllers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_register_model');
        $this->load->library('upload');
        // load form and url helpers
        $this->load->helper(array('form', 'url'));
        // load form_validation library
        $this->load->library('form_validation');
        //   $this->load->library('upload');
    }

    public function register() {
        // convert date formate process start here 
        date_default_timezone_set('Europe/London');
        $new_date_one = date('Y-m-d', strtotime($this->input->post('Start_date')));
        $new_date_two = date('Y-m-d', strtotime($this->input->post('end_date')));
        // convert date formate process end here 
        // validtion for event created start here 
        $this->form_validation->set_rules('event_title', 'Event Title', 'required|max_length[140]');


        // set alart red massage for view page
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['main_content'] = 'admin/event/event_register';
            $this->load->view('includes/template', $data);
            // $this->load->view('admin/event/event_register');
        } else {

            // images upload process start here 
            $output_dir = "../images/event_images/";
            $fileName = $_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], $output_dir . $fileName);
            $path_banner = $output_dir . $fileName;

            $output_dirr = "../images/event_images/";
            $fileNamee = $_FILES["file1"]["name"];
            move_uploaded_file($_FILES["file1"]["tmp_name"], $output_dirr . $fileNamee);
            $path_smoll = $output_dirr . $fileNamee;
            // images upload process end here 

            $data = array(
                'event_title' => $this->input->post('event_title'),
                'event_date_time' => $new_date_one,
                'event_start_t' => $this->input->post('start_time'),
                'event_date_time_end' => $new_date_two,
                'event_end_t' => $this->input->post('end_time'),
                'event_description' => $this->input->post('event_description'),
                'name' => $this->input->post('organiser_name'),
                'email' => $this->input->post('organiser_email'),
                'phone' => $this->input->post('organiser_phone'),
                'country' => $this->input->post('county'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'landmark' => $this->input->post('landmark'),
                'image_url' => substr($path_banner, 3),
                'image_url_smoll' => substr($path_smoll, 3),
                'fb_link' => $this->input->post('facebook_link'),
                'tw_link' => $this->input->post('twitter_link'),
                'create_date' => date('Y-m-d H:i:s'),
                'status' => 0
//                 'image_url'=>$this->input->post('userfile'),                 
//            $config['upload_path'] = base_url() .'uploads/',
//            $config['allowed_types'] = 'gif|jpg|png',
//            $config['max_size'] = '100',
//            $config['max_width'] = '1024',
//            $config['max_height'] = '768'
            );
            //$this->load->library('upload', $config);
            //if($this->upload->do_upload())
            //{ 
            //$data = array('upload_data' => $this->upload->data());
            //$this->load->view('event/event_register',$data);
            //}
            //else
            //{
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('event/event_register', $error);
            //}



            if ($this->input->post('submit')) {
                //  print_r($data); die;
                $this->Event_register_model->event_register($data);
                if ($data != NULL) :
                    $this->session->set_flashdata('message_name', '<font color="#098338" size="4px;">event are created successfully please wait for admin activation :)</font> ');
                else :
                    $this->session->set_flashdata('message_name', '<font color="#cc2c10;size="4px;">You have an issu Your event data is not updated Please try again !!</font>');
                endif;
                //$this->load->view('events');
                redirect('admin/event');
            }

            else {
                // $this->load->view('admin/event/event_register');
                $data['main_content'] = 'admin/event/event_reg_active';
                $this->load->view('includes/template', $data);
            }
        }
    }

    public function active_banner() {
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['recordinfo'] = $this->Event_register_model->info($page);
        $data['showedata'] = $this->Event_register_model->show_event();

        $data['main_content'] = 'admin/event/event_reg_active';
        $this->load->view('includes/template', $data);
    }

    public function active_event() {
        $url = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['recordinfo'] = $this->Event_register_model->activate($url);
        redirect('Eventreg_controllers/active_banner');
    }
    
    public function in_active_event() {
        $url = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['recordinfo'] = $this->Event_register_model->inactivate($url);
        redirect('Eventreg_controllers/active_banner');
    }

}

?>
