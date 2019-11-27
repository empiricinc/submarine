<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public $limit = 10;
    public $num_links = 3;
    public $permissions = array();

    public function __construct() {

        parent::__construct();    

        $ci =& get_instance();

        $ci->load->helper('language');

        $siteLang = $ci->session->userdata('site_lang');

        if ($siteLang) {

            $ci->lang->load('workablezone',$siteLang);

        } else {

            $ci->lang->load('workablezone','english');

        } 


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

    function pagination_initializer($limit=10, $num_links=10, $total_rows=0, $url='', $query_string=FALSE)
    {
        $this->load->library('pagination');
        $config['base_url'] = base_url().$url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['num_links'] = $num_links;

        if($query_string == TRUE)
        {
            $config['page_query_string'] = TRUE;
            $config['enable_query_string'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['query_string_segment'] = 'page';
        }

        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = 'next &raquo;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "prev &laquo;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";

        $this->pagination->initialize($config);
    }


}

?>