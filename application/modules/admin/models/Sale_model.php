<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Sale Model
 * @sale Model
 * Date created:June 5, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class sale_model extends CI_Model {

    private $table_sale = 'tbl_sales';

    public function __construct() {
        parent::__construct();
    }    

    public function get_all_sale($limit,$offset){
        $this->db->select('*');
        $this->db->order_by("creditmemo_id","ASC");
        $query =  $this->db->get($this->table_sale,$limit,$offset);
        //echo "SELECT * FROM ".$this->table_sale." LIMIT ".$limit.", ".$offset;
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_sale);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function get_all_field($id){
        $this->db->select();
        $this->db->where('aid',$id);
        $query = $this->db->get($this->table_sale);  
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function delete_sale($id){
        $this->db->where('id',$id);
        $this->db->delete($this->table_sale);
    }

    public function add_sales(){
        //Step 1 : Insert in tbl_tempsales
        $data = array(
            'customer_name' => $this->input->post('customer_name'),
            'contact_number' => $this->input->post('contact_number'),
            'sale_date' => $this->input->post('sale_date'),
            'sale_date_nepali' => $this->input->post('sale_date_nepali'),
            'sub_total' => $this->input->post('total_amount'),
            'discount_percentage' => $this->input->post('discount_percentage'),
            'discount_amount' => $this->input->post('discount_amount'),
            'grand_total' => $this->input->post('grand_total')
        );        
        $this->db->insert('tbl_tempsales',$data);
        $tsales_id = $this->db->insert_id();
        if($tsales_id>0)
        {
            $this->add_sale_contents($tsales_id);
        }     
    }

    public function insertTempSale(){
        //Step 1 : Insert in tbl_tempsales
        $data = array(
            'sale_date_nepali' => $this->input->post('sale_date_nepali'),
            'sale_date' => $this->input->post('sale_date'),
            'customer_name' => $this->input->post('customer_name'),
            'contact_number' => $this->input->post('contact_number'),            
            'sub_total' => $this->input->post('total_amount'),
            'discount_percentage' => $this->input->post('discount_percentage'),            
            'discount_amount' => $this->input->post('discount_amount'),
            'grand_total' => $this->input->post('grand_total')
        );   
        /*print_r($data);*/
        $this->db->insert('tbl_tempsales',$data);
        $tsales_id = $this->db->insert_id();
        if($tsales_id>0)
        {
            $this->insertTempOrder($tsales_id);
            return $tsales_id;
        }
        else
        {
            return 0;
        }
    }

    function insertTempOrder($tsales_id){
        //print_r($_POST);
        for($i=0;$i<count($_POST['medicine_id']);$i++)
        {
            if(!empty($_POST['medicine_name'][$i]))
            {                
                $data2 = array(
                'tsales_id' => $tsales_id,
                'stock_id' => $_POST['stock_id'][$i],
                'medicine_id' => $_POST['medicine_id'][$i],
                'medicine_name' => $_POST['medicine_name'][$i],
                'quantity' => $_POST['quantity'][$i],
                'rate' => $_POST['rate'][$i],
                'sub_total' => $_POST['quantity'][$i]*$_POST['rate'][$i]
                );
                //print_r($data2);
                $this->db->insert('tbl_temporder',$data2);
            }
        }
    }

    function getTempSale($tempsales_id){
        $this->db->select('*');
        $this->db->where('id',$tempsales_id); 
        $query = $this->db->get('tbl_tempsales');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getTempOrder($tempsales_id){
        $this->db->select('*');
        $this->db->where('tsales_id',$tempsales_id);
        $query =  $this->db->get('tbl_temporder');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
        
    }

    function moveTempSale($tempsales_id){
        //move to tbl_sales
        $this->db->select('*');
        $this->db->where('id',$tempsales_id); 
        $query = $this->db->get('tbl_tempsales');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $rasSales = $query->result();
            $dataSales['current_datetime'] = $rasSales['0']->current_datetime;
            $dataSales['sale_date'] = $rasSales['0']->sale_date;
            $dataSales['sale_date_nepali'] = $rasSales['0']->sale_date_nepali;
            $dataSales['customer_name'] = $rasSales['0']->customer_name;
            $dataSales['contact_number'] = $rasSales['0']->contact_number;
            $dataSales['sub_total'] = $rasSales['0']->sub_total;
            $dataSales['discount_percentage'] = $rasSales['0']->discount_percentage;
            $dataSales['discount_amount'] = $rasSales['0']->discount_amount;
            $dataSales['grand_total'] = $rasSales['0']->grand_total;
            //print_r($dataSales);            
            $this->db->insert('tbl_sales',$dataSales);
            $sales_id = $this->db->insert_id();
        }
        if($sales_id>0)
        {
        //move to tbl_order
        $this->db->select('*');
        $this->db->where('tsales_id',$tempsales_id);
        $query =  $this->db->get('tbl_temporder');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $rasOrders = $query->result();
            foreach($rasOrders as $rasOrder)
            {
                $dataOrder='';
                $dataOrder['sales_id'] = $sales_id;
                $dataOrder['stock_id'] = $rasOrder->stock_id;
                $dataOrder['medicine_id'] = $rasOrder->medicine_id;
                $dataOrder['medicine_name'] = $rasOrder->medicine_name;
                $dataOrder['quantity'] = $rasOrder->quantity;
                $dataOrder['rate'] = $rasOrder->rate;
                $dataOrder['sub_total'] = $rasOrder->sub_total;
                $this->db->insert('tbl_order',$dataSales);
            }
        }

          $this->db->delete('tbl_tempsales', array('id' => $tempsales_id));
          $this->db->delete('tbl_temporder', array('tsales_id' => $tempsales_id));
        } 
    }

    function getSale($sales_id){
        $this->db->select('*');
        $this->db->where('id',$sales_id); 
        $query = $this->db->get('tbl_sales');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getOrder($sales_id){
        $this->db->select('*');
        $this->db->where('sales_id',$sales_id);
        $query =  $this->db->get('tbl_order');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }        
    }

    function getStock($medicine_id,$quantity)
    {
        $this->db->select('id,item_description, (stock-sales) as balance_quantity');
        $this->db->where('(stock-sales)>',$quantity);
        $this->db->where('medicine_id',$medicine_id);
        $this->db->order_by("expiry_date","ASC");
        $query =  $this->db->get('tbl_stock');
        if ($query->num_rows() == 0) {
            $this->gettotalavailableStock($medicine_id);
            return FALSE;
        } else {
            $result = $query->result();
            $ret = array('stock_id'=> array ( "0" => $result['0']->id),'quantity'=> array ( "0" => $quantity));
            return $ret;
        }    
        //echo $this->db->last_query();   
    }

    function gettotalavailableStock($medicine_id)
    {
        $this->db->select_sum('stock');
        $this->db->where('stock >',sales);
        $this->db->where('medicine_id',$medicine_id);
        $query =  $this->db->get('tbl_stock');
        $result = $query->result();
        //echo $this->db->last_query();  
        $total_stock = $result['0']->stock;
        return $total_stock; 
    }

    public function update_sale($cid){
        
        $slug = $this->general_model->geturlcode($this->input->post('sale_name'));        
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
        $this->db->update($this->table_sale,$data);
    }

    function get_medicine_stock($q)
    {        
        $this->db->select('id,medicine_id,item_description,expiry_date,stock,sales,sp_per_unit');
        $this->db->like('item_description', $q,'after');
        $query = $this->db->get('tbl_stock');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $stock = $row['stock']-$row['sales'];
            $new_row['label']=htmlentities(stripslashes($row['item_description']." ( ".$row['expiry_date']." = ".$stock." ) "));
            $new_row['value']=htmlentities(stripslashes($row['item_description']));
            $new_row['sp_per_unit']=htmlentities(stripslashes($row['sp_per_unit']));
            $new_row['stock_id']=htmlentities(stripslashes($row['id']));
            $new_row['medicine_id']=htmlentities(stripslashes($row['medicine_id']));
            $new_row['stock']=htmlentities(stripslashes($stock));
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }

    function get_sale($q){
        //Query from tbl_sale
        $this->db->select('id,item_description,medicine_id');
        $this->db->like('item_description', $q,'after');
        $query = $this->db->get('tbl_sale');
        //echo $this->db->last_query();
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['item_description']));
            $new_row['value']=htmlentities(stripslashes($row['item_description']));
            $new_row['the_link']=base_url()."admin/Sale/medicineSearch/".$row['medicine_id'];
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
            $new_row['the_link']=base_url()."admin/Sale/invoiceSearch/".$row['id'];
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
            $new_row['the_link']=base_url()."admin/Sale/distributorSearch/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }        
    }

    function getSaleMedicine($medicine_id)
    {
        $this->db->select('tbl_sale.*,tbl_supplier.fullname,tbl_creditmemo.invoice_no,tbl_creditmemo.invoice_eng_date,tbl_creditmemo.invoice_nepali_date');
        $this->db->join('tbl_creditmemo', 'tbl_creditmemo.id = tbl_sale.creditmemo_id', 'inner');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('tbl_sale.medicine_id',$medicine_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_sale);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getSaleInvoice($creditmemo_id)
    {
        $this->db->select('tbl_sale.*,tbl_supplier.fullname,tbl_creditmemo.invoice_no,tbl_creditmemo.invoice_eng_date,tbl_creditmemo.invoice_nepali_date');
        $this->db->join('tbl_creditmemo', 'tbl_creditmemo.id = tbl_sale.creditmemo_id', 'inner');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('tbl_sale.creditmemo_id',$creditmemo_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_sale);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }   
    }

    function getSaleSupplier($distributor_id)
    {
        $this->db->select('tbl_sale.*,tbl_supplier.fullname,tbl_creditmemo.invoice_no,tbl_creditmemo.invoice_eng_date,tbl_creditmemo.invoice_nepali_date');
        $this->db->join('tbl_creditmemo', 'tbl_creditmemo.id = tbl_sale.creditmemo_id', 'inner');
        $this->db->join('tbl_supplier', 'tbl_supplier.id = tbl_creditmemo.distributor_id', 'inner');
        $this->db->where('tbl_creditmemo.distributor_id',$distributor_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_sale);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }   
    }

    function get_all_sales($from_date='',$to_date='', $keywords='')
    {
        $this->db->select('*');

        if(!empty($keywords))
        {
            $this->db->like('customer_name', $keywords);
            $this->db->or_like('contact_number', $keywords);
        }
        else
        {            
            if(!empty($from_date) && $to_date=='')
                $this->db->where('sale_date_nepali',$from_date);
            elseif(!empty($from_date) && !empty($to_date))
            {
                $this->db->where('sale_date_nepali >=', $from_date);
                $this->db->where('sale_date_nepali <=', $to_date);
            }
            else
                $this->db->where('sale_date',date('Y-m-d'));
        }

        $this->db->order_by("id", "DESC");
        $query = $this->db->get($this->table_sale);  
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
        
    }
}

/* End of file Sale_model.php
 * Location: ./application/modules/admin/models/Sale_model.php */