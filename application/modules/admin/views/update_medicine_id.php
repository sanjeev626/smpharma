<?php
if(isset($stockInfo))
{
	foreach ($stockInfo as $row):
		echo $row->id.' -- '.$row->item_description.' -- '.$row->medicine_idd;
		echo "<br>";
		
		$data = array(
	        'medicine_id' => $row->medicine_idd
	    );
	    $this->db->where('id',$row->id);
	    $this->db->update('tbl_stock',$data);
		
	endforeach;
}
?>