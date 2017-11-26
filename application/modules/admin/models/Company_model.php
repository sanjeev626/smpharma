<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Company Model
 * @company Model
 * @subcompany Model
 * Date created:June 5, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class company_model extends CI_Model {

    private $table_company = 'tbl_company';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_company($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("fullname","ASC");
        $query =  $this->db->get($this->table_company,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_company." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_company);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_company);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function insert_dropdown(){
        $data = array(
            'fid' => $this->input->post('fid'),
            'dropvalue' => $this->input->post('dropvalue')
            );
        $this->db->insert($this->table_company,$data);
    }

    public function delete_company($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_company);


    }

    public function add_company(){
        $slug = $this->general_model->geturlcode($this->input->post('fullname'));
        $parent_id = $this->input->post('parent_id');
        if(empty($parent_id))
            $parent_id=0;
        $data = array(
            'slug' => $slug,
            'status' => '1',
            'parent_id' => $parent_id,
            'fullname' => $this->input->post('fullname'),
            'address' => $this->input->post('address'),
            'landline' => $this->input->post('landline'),
            'mobile' => $this->input->post('mobile')
        );

        $this->db->insert($this->table_company,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_company($cid){
        
        $slug = $this->general_model->geturlcode($this->input->post('fullname'));
        $parent_id = $this->input->post('parent_id');
        if(empty($parent_id))
            $parent_id=0;
        $data = array(
            'slug' => $slug,
            'status' => '1',
            'parent_id' => $parent_id,
            'fullname' => $this->input->post('fullname'),
            'address' => $this->input->post('address'),
            'landline' => $this->input->post('landline'),
            'mobile' => $this->input->post('mobile')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_company,$data);
    }

    public function add_edit_itinerary($cid){

        for($i=0;$i<count($this->input->post('itinerary_id'));$i++)
        {
           $itinerary_id = $_POST['itinerary_id'][$i];
           $data='';
           $data = array(
            'pid' => $cid,
            'day' => $_POST['day_old'][$i],
            'title' => $_POST['title_old'][$i],
            'services' => $_POST['services_old'][$i],
            'description' => $_POST['description_old'][$i]
            );
           $this->db->where('id',$itinerary_id);
           $this->db->update('tbl_itinerary',$data);
        }

        for($i=0;$i<count($this->input->post('day'));$i++)
        {
           if(!empty($_POST['day'][$i]))
           {
               $data='';
               $data = array(
                'pid' => $cid,
                'day' => $_POST['day'][$i],
                'title' => $_POST['title'][$i],
                'services' => $_POST['services'][$i],
                'description' => $_POST['description'][$i]
                );
               $this->db->insert('tbl_itinerary',$data);
           }
        }
    }

    function get_company($q){
        $this->db->select('*');
        $this->db->like('fullname', $q,'after');
        $query = $this->db->get('tbl_company');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['fullname']));
            $new_row['value']=htmlentities(stripslashes($row['fullname']));
            $new_row['the_link']=base_url()."admin/Company/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Dropdown_model.php
 * Location: ./application/modules/admin/models/Dropdown_model.php */