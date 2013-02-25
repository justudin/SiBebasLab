<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_webmaster');
    }

    public function index() {
        
        $data['dtmhs']=$this->m_webmaster->get_mhs();
        $data['dtbebaslab']=$this->m_webmaster->get_mhs_lab();
        
        $this->load->view('v_coba',$data);
        
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */