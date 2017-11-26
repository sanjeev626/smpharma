<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin page_model Model
 * @package Model
 * @subpackage Model
 * Date created:January 24, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class page_model extends CI_Model {

    private $table_page = 'tbl_page';

    public function __construct() {
        parent::__construct();
    }


    public function get_all_page(){
    	$this->db->select('id , title , cr_date , up_date');
    	$query =  $this->db->get($this->table_page);
    	if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_page_by_id($id){
    	$this->db->select();
    	$this->db->where('id',$id);
    	$query = $this->db->get($this->table_page);
    	if($query->num_rows() == 0){
    		return FALSE;
    	}else {
    		return $query->row();
    	}
    }

    public function update_page($id, $iconimage){
    	$up_date = date('Y-m-d h:i:s');
        $urlcode = $this->general_model->geturlcode($this->input->post('title'));
    	$data = array(
            'urlcode' => $urlcode,
    		'contents' => $this->input->post('contents'),
            'excerpt' => $this->input->post('excerpt'),
    		'up_date' =>$up_date,
            'metatitle' => $this->input->post('metatitle'),
            'metakeywords' => $this->input->post('metakeywords'),
            'metadescription' => $this->input->post('metadescription')
    		);

        if(!empty($iconimage)){
            $data['iconimage'] = $iconimage;
            $this->general_model->unlink_img('./././uploads/page/', $this->input->post('iconimage_prev'));
        }

    	$this->db->where('id',$id);
    	$this->db->update($this->table_page,$data);
    }

}

/* End of file page_model.php
 * Location: ./application/modules/admin/models/page_model.php */