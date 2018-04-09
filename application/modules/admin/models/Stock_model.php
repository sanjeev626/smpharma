<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Medicine Model
 * @stock Model
 * @substock Model
 * Date created:June 5, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class stock_model extends CI_Model {

    private $table_stock = 'tbl_stock';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_stock($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("creditmemo_id","ASC");
        $query =  $this->db->get($this->table_stock,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_stock." LIMIT ".$limit.", ".$offset;
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_all_near_expiry($limit,$offset,$from_date,$to_date,$return_count='')
    {
        $this->db->select('*');
        $this->db->order_by("expiry_date","ASC");      
        $this->db->where('expiry_date >',$from_date);  
        $this->db->where('expiry_date <',$to_date);
        $query =  $this->db->get($this->table_stock,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_stock." LIMIT ".$limit.", ".$offset;
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            if($return_count==1)
                return $query->num_rows();
            else
                return $query->result();
        }   
    }

    public function get_all_expired($limit,$offset,$return_count='')
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->order_by("expiry_date","ASC");      
        $this->db->where('expiry_date <',$today);
        $query =  $this->db->get($this->table_stock,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_stock." LIMIT ".$limit.", ".$offset;
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            if($return_count==1)
                return $query->num_rows();
            else
                return $query->result();
        }   
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_stock);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_stock);  
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
        $this->db->insert($this->table_stock,$data);
    }

    public function delete_stock($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_stock);


    }

    public function add_stock(){
        //Step 1 : Insert in tbl_creditmemo
        $invoice_eng_date = $this->input->post('invoice_eng_date');
        $invoice_nepali_date = $this->input->post('invoice_nepali_date');
        //print_r($ied);
        $distributorname = $this->input->post('supplierName');
        $distributor_id = $this->general_model->getFieldValue('tbl_supplier', 'id', 'fullname', $distributorname);
        if(empty($invoice_eng_date))
        {
            $ind = explode('-',$invoice_nepali_date);
            //print_r($ind);
            $ied = $this->date_model->nep_to_eng($ind['0'],$ind['1'],$ind['2']);            
            //print_r($ied);
            $invoice_eng_date = $ied['year'].'-'.$ied['month'].'-'.$ied['date'];
        }
        $data = array(
            'distributor_id' => $distributor_id,
            'invoice_no' => $this->input->post('invoice_no'),
            'invoice_eng_date' => $invoice_eng_date,
            'invoice_nepali_date' => $invoice_nepali_date,
            'total_amount' => $this->input->post('total_amount'),
            'discount_amount' => $this->input->post('discount_amount'),
            'vat_amount' => $this->input->post('vat_amount'),
            'grand_amount' => $this->input->post('grand_amount')
        );    
        $this->db->insert('tbl_creditmemo',$data);
        $crmemo_id = $this->db->insert_id();
        if($crmemo_id>0)
        {
            $this->add_stock_contents($crmemo_id);
        }     
    }

    function add_stock_contents($crmemo_id){
        //print_r($_POST);
        for($i=0;$i<count($_POST['medicine_name']);$i++)
        {
            if(!empty($_POST['medicine_name'][$i]))
            {                
                $medicine_name = $_POST['medicine_name'][$i];
                $medicine_id = $this->general_model->getFieldValue('tbl_medicine', 'id', 'medicine_name', $medicine_name);
                if(empty($medicine_id) || $medicine_id<1)
                {
                    $data3 = array(
                    'medicine_name' => $medicine_name,
                    'available_in_nepal' => '1'
                    );
                    $this->db->insert('tbl_medicine',$data3);
                    $medicine_id = $this->db->insert_id();
                }

                $expiry_date = $_POST['exp_year'][$i].'-'.$_POST['exp_month'][$i].'-01';

                $data2 = array(
                'creditmemo_id' => $crmemo_id,
                'batch_number' => $_POST['batch_number'][$i],
                'medicine_id' => $medicine_id,
                'item_description' => $_POST['medicine_name'][$i],
                'pack' => $_POST['pack'][$i],
                'expiry_date' => $expiry_date,
                'quantity' => $_POST['quantity'][$i],
                'deal' => $_POST['deal'][$i],
                'rate' => $_POST['rate'][$i],
                'deal_percentage' => $_POST['deal_percentage'][$i],
                'stock' => $_POST['stock'][$i],
                'sales' => '0',
                'total_price' => $_POST['total_price'][$i],
                'cp_per_unit' => $_POST['cp_per_unit'][$i],
                'sp_per_unit' => $_POST['sale_price'][$i]
                );
                $this->db->insert('tbl_stock',$data2);
            }
        }
    }

    public function update_stock($cid){
        
        $slug = $this->general_model->geturlcode($this->input->post('stock_name'));        
        $data = array(
            'slug' => $slug,
            'parent_company_id' => $this->input->post('parent_company_id'),
            'company_id' => $this->input->post('company_id'),
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
        $this->db->update($this->table_stock,$data);
    }

    function get_stock($q){
        //Query from tbl_stock
        $this->db->select('id,item_description,medicine_id');
        $this->db->like('item_description', $q,'after');
        $query = $this->db->get('tbl_stock');
        //echo $this->db->last_query();
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['item_description']));
            $new_row['value']=htmlentities(stripslashes($row['item_description']));
            $new_row['the_link']=base_url()."admin/Stock/medicineSearch/".$row['medicine_id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }

        //Query from tbl_creditmemo
        //$query2=mysql_query("SELECT id,invoice_no FROM tbl_creditmemo WHERE invoice_no LIKE '$q%' GROUP BY invoice_no ORDER BY id LIMIT 20");
        $this->db->select('id,invoice_no');
        $this->db->like('invoice_no', $q,'after');
        $query = $this->db->get('tbl_creditmemo');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['invoice_no']));
            $new_row['value']=htmlentities(stripslashes($row['invoice_no']));
            $new_row['the_link']=base_url()."admin/Stock/invoiceSearch/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }

        //Query from tbl_supplier
        //$query3=mysql_query("SELECT id,fullname FROM tbl_distributor WHERE fullname LIKE '$q%' GROUP BY fullname ORDER BY id LIMIT 20");
        $this->db->select('id,fullname');
        $this->db->like('fullname', $q,'after');
        $query = $this->db->get('tbl_supplier');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['fullname']));
            $new_row['value']=htmlentities(stripslashes($row['fullname']));
            $new_row['the_link']=base_url()."admin/Stock/distributorSearch/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }        
    }

    public function get_suppliername_by_stock_id($stock_id){
        $this->db->select('sup.fullname');
        $this->db->join('tbl_creditmemo tc','tc.id = tbl_stock.creditmemo_id');
        $this->db->join('tbl_supplier sup','sup.id = tc.distributor_id');
        $this->db->where('tbl_stock.id',$stock_id);
        $q = $this->db->get($this->table_stock);
        //echo $this->db->last_query();
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data['fullname'];
    }

    function getStockMedicine($medicine_id)
    {
        $this->db->select('tbl_stock.*,tbl_supplier.fullname,tbl_creditmemo.invoice_no,tbl_creditmemo.invoice_eng_date,tbl_creditmemo.invoice_nepali_date');
        $this->db->join('tbl_creditmemo', 'tbl_creditmemo.id = tbl_stock.creditmemo_id', 'inner');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('tbl_stock.medicine_id',$medicine_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_stock);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getStockInvoice($creditmemo_id)
    {
        $this->db->select('tbl_stock.*,tbl_supplier.fullname,tbl_creditmemo.invoice_no,tbl_creditmemo.invoice_eng_date,tbl_creditmemo.invoice_nepali_date');
        $this->db->join('tbl_creditmemo', 'tbl_creditmemo.id = tbl_stock.creditmemo_id', 'inner');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('tbl_stock.creditmemo_id',$creditmemo_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_stock);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }   
    }

    function get_all_invoices($fromdate,$todate,$supplier_id)
    {        
        $this->db->select('tbl_creditmemo.*,tbl_supplier.fullname');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('invoice_nepali_date >=', $fromdate);
        $this->db->where('invoice_nepali_date <=', $todate);
        if($supplier_id>0)
            $this->db->where('distributor_id', $supplier_id);

        $this->db->order_by("invoice_nepali_date", "ASC");
        $query = $this->db->get('tbl_creditmemo');  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
    }

    function getStockSupplier($distributor_id)
    {
        $this->db->select('tbl_stock.*,tbl_supplier.fullname,tbl_creditmemo.invoice_no,tbl_creditmemo.invoice_eng_date,tbl_creditmemo.invoice_nepali_date');
        $this->db->join('tbl_creditmemo', 'tbl_creditmemo.id = tbl_stock.creditmemo_id', 'inner');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('tbl_creditmemo.distributor_id',$distributor_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_stock);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }   
    }

    function getAllStockInfo($creditmemo_id)
    {
        $this->db->select('*');
        $this->db->where('creditmemo_id',$creditmemo_id);
        $query = $this->db->get($this->table_stock);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getAllMedicinesFromStock()
    {
        $this->db->select('tbl_stock.item_description,tbl_stock.id,tbl_medicine.id as medicine_idd');
        $this->db->join('tbl_medicine', 'tbl_medicine.medicine_name = tbl_stock.item_description', 'inner');
        $this->db->where('medicine_id','0');
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_stock);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getAllNewMedicinesFromStock()
    {
        $this->db->select('tbl_stock.item_description,tbl_stock.id');
        //$this->db->join('tbl_medicine', 'tbl_medicine.medicine_name = tbl_stock.item_description', 'inner');
        $this->db->where('medicine_id','0');
        //$this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_stock);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
}

/* End of file Dropdown_model.php
 * Location: ./application/modules/admin/models/Dropdown_model.php */