<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Api Api_model Model
 * @package Model
 * @subpackage Model
 * Date created:March 08, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_expire_job_within_week(){
        $afterWeek = date("Y-m-d", strtotime("+1 week"));
        $today = date('Y-m-d');

        $this->db->select('jb.id as job_id,e.id as e_id,jb.*,e.*');
        $this->db->from('jobs as jb');
        $this->db->join('employer as e','e.id = jb.eid');
        $this->db->where('jb.applybefore >=',$today);
        $this->db->where('jb.applybefore <=',$afterWeek);
        $this->db->where('jb.eid !=',0);
        $query = $this->db->get();
        if($query->num_rows() == 0){
            return FALSE;
        }else{
            return $query->result();
        }
    }

    public function get_expire_job(){
        $today = date('Y-m-d');

        $this->db->select('jb.id as job_id,e.id as e_id,jb.*,e.*');
        $this->db->from('jobs as jb');
        $this->db->join('employer as e','e.id = jb.eid');
        $this->db->where('jb.applybefore <',$today);
        $this->db->where('jb.eid !=',0);
        $query = $this->db->get();
        if($query->num_rows() == 0){
            return FALSE;
        }else{
            return $query->result();
        }
    }


}
/* End of file Api_model.php
 * Location: ./application/modules/Api/models/Api_model.php */
