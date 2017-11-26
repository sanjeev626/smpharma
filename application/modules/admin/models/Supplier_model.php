<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Supplier Model
 * @supplier Model
 * @subsupplier Model
 * Date created:June 5, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class supplier_model extends CI_Model {

    private $table_supplier = 'tbl_supplier';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_supplier($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("fullname","ASC");
        $query =  $this->db->get($this->table_supplier,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_supplier." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_supplier);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_supplier);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function delete_supplier($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_supplier);


    }

    public function add_supplier(){
        $slug = $this->general_model->geturlcode($this->input->post('fullname'));
        $data = array(
            'slug' => $slug,
            'fullname' => $this->input->post('fullname'),
            'pan_number' => $this->input->post('pan_number'),
            'dda_regd' => $this->input->post('dda_regd'),
            'address' => $this->input->post('address'),
            'landline' => $this->input->post('landline'),
            'mobile' => $this->input->post('mobile')
        );

        $clist = '';
        for($i=0;$i<count($_POST['companylist']);$i++)
        {
            $clist = $clist.$_POST['companylist'][$i].',';
        }
        $clist = substr($clist,0,-1);
        $data['companylist'] = $clist;

        $this->db->insert($this->table_supplier,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_supplier($cid){
        //print_r($_POST);
        $slug = $this->general_model->geturlcode($this->input->post('fullname'));
        $data = array(
            'slug' => $slug,
            'fullname' => $this->input->post('fullname'),
            'pan_number' => $this->input->post('pan_number'),
            'dda_regd' => $this->input->post('dda_regd'),
            'address' => $this->input->post('address'),
            'landline' => $this->input->post('landline'),
            'mobile' => $this->input->post('mobile')
        );

        $clist = '';
        for($i=0;$i<count($_POST['companylist']);$i++)
        {
            $clist = $clist.$_POST['companylist'][$i].',';
        }
        $clist = substr($clist,0,-1);
        $data['companylist'] = $clist;

        //print_r($data); exit();
        $this->db->where('id',$cid);
        $this->db->update($this->table_supplier,$data);
    }

    function get_supplier($q){
        $this->db->select('*');
        $this->db->like('fullname', $q,'after');
        $query = $this->db->get('tbl_supplier');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['fullname']));
            $new_row['value']=htmlentities(stripslashes($row['fullname']));
            $new_row['the_link']=base_url()."admin/Supplier/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Supplier_model.php
 * Location: ./application/modules/admin/models/Dropdown_model.php */