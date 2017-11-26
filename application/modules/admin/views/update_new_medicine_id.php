<?php
if(isset($stockInfo))
{
	foreach ($stockInfo as $row):
		//echo $row->id.' -- '.$row->item_description.' -- '.$row->medicine_id;
		//echo "<br>";

		$data2 = array(
	        'medicine_name' => $row->item_description
	    );
	    $this->db->insert('tbl_medicine',$data2);
	    $medicine_id = $this->db->insert_id();
		
		$data = array(
	        'medicine_id' => $medicine_id
	    );
	    $this->db->where('id',$row->id);
	    $this->db->update('tbl_stock',$data);
		
	endforeach;
}
?>