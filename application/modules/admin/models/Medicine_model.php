<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Medicine Model
 * @medicine Model
 * @submedicine Model
 * Date created:June 5, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class medicine_model extends CI_Model {

    private $table_medicine = 'tbl_medicine';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_medicine($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("medicine_name","ASC");
        $query =  $this->db->get($this->table_medicine,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_medicine." LIMIT ".$limit.", ".$offset;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_medicine);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_medicine);  
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
        $this->db->insert($this->table_medicine,$data);
    }

    public function delete_medicine($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_medicine);
    }

    public function add_medicine(){
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

        $this->db->insert($this->table_medicine,$data);
        $cid = $this->db->insert_id();        
    }

    public function update_medicine($cid){
        
        $slug = $this->general_model->geturlcode($this->input->post('medicine_name'));        
        $data = array(
            'slug' => $slug,
            'parent_company_id' => $this->input->post('parent_company_id'),
            'company_id' => $this->input->post('company_id'),
            'medicine_name' => $this->input->post('medicine_name'),            
            'composition' => $this->input->post('composition'),
            'indications' => $this->input->post('indications'),
            'side_effects' => $this->input->post('side_effects'),
            'form' => $this->input->post('form'),
            'packing' => $this->input->post('packing'),
            'category' => $this->input->post('category'),
            'available_in_nepal' => $this->input->post('available_in_nepal'),
            'admin_remarks' => $this->input->post('admin_remarks')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_medicine,$data);
    }

    public function get_companyname_by_medicine_id($medicine_id){
        $company_id = $this->get_field_by_id('company_id',$medicine_id);
        $this->db->select('fullname');
        $this->db->where('id',$company_id);
        $q = $this->db->get('tbl_company');
        //echo $this->db->last_query();
        //exit();
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data['fullname'];
    }

    public function merge_medicine($correct_medicine_id,$wrong_medicine_id)
    {
        //UPDATE in tbl_order, tbl_orderreview, tbl_temporder
        $data = array(
            'medicine_id' => $correct_medicine_id,
            'medicine_name' => $_POST['correct_name']
        );        
        $this->db->where('medicine_id',$wrong_medicine_id);
        $this->db->update('tbl_order',$data);
        $this->db->update('tbl_orderreview',$data);
        $this->db->update('tbl_temporder',$data);

        //UPDATE in tbl_stock
        $data2 = array(
            'medicine_id' => $correct_medicine_id,
            'item_description' => $_POST['correct_name']
        ); 
        $this->db->where('medicine_id',$wrong_medicine_id);
        $this->db->update('tbl_stock',$data2);

        //DELETE from tbl_medicine
        $this->delete_medicine($wrong_medicine_id);
    }

    function get_medicine_info($medicine_id){
        $this->db->select('tbl_medicine.medicine_name,tbl_stock.stock,tbl_stock.sales,tbl_stock.cp_per_unit,tbl_stock.sp_per_unit,tbl_stock.quantity,tbl_stock.deal,tbl_stock.rate,tbl_stock.deal_percentage,tbl_supplier.fullname,tbl_creditmemo.invoice_nepali_date,tbl_creditmemo.invoice_no');
        $this->db->where('medicine_id',$medicine_id);
        $this->db->join('tbl_medicine', 'tbl_medicine.id = tbl_stock.medicine_id');
        $this->db->join(' tbl_creditmemo', ' tbl_creditmemo.id = tbl_stock.creditmemo_id');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id');
        $this->db->order_by('tbl_creditmemo.invoice_nepali_date','DESC');
        $query = $this->db->get('tbl_stock');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_medicine($q){
        $this->db->select('*');
        $this->db->like('medicine_name', $q,'after');
        $query = $this->db->get('tbl_medicine');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['medicine_name']));
            $new_row['value']=htmlentities(stripslashes($row['medicine_name']));
            $new_row['medicine_id']=$row['id'];
            $new_row['the_link']=base_url()."admin/Medicine/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    function search_medicine($q){
        $this->db->select('*');
        $this->db->like('medicine_name', $q,'after');
        $query = $this->db->get('tbl_medicine');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['medicine_name']));
            $new_row['value']=htmlentities(stripslashes($row['medicine_name']));
            $new_row['the_link']=base_url()."admin/medicine/search/".$row['id'];
            $new_row['medicine_id']=$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

}

/* End of file Dropdown_model.php
 * Location: ./application/modules/admin/models/Dropdown_model.php */