<?php
if (!empty($stock_detail)) {
    $action = base_url() . 'admin/Stock/editStock/' . $stock_detail->id;
} else {
    $action = base_url() . 'admin/Stock/addStock';
}
?>
<script type="text/javascript">
  
  function calculate(num)
  {
    if(num)
    {
      var num1=num;
      //Subtotal Calculation starts Here
      var quantity=document.getElementById('quantity_'+num1).value;
      var rate=document.getElementById('rate_'+num1).value;

      if (quantity == ""){quantity= 0;}
      if (rate == ""){rate = 0;}

      var sub_total = parseFloat(quantity)*parseFloat(rate);
      //alert(quantity+'X'+rate+'='+sub_total);
      if(parseFloat(sub_total)>0)
      {
        var subtotal = parseFloat(Math.round(sub_total* 100) / 100).toFixed(2);
        $('#sub_total_'+num1).html(subtotal);
      }
      //Calculate Grand Total
    }
    calculate_grandtotal();           
  }

  function calculate_grandtotal()
  {
    var gtotal = 0.00;

    $(".sub_total").each(function() {
      subtotal = $(this).html() || 0; // note || here
      gtotal += parseFloat(subtotal);
    });
    //alert(gtotal);
    $("#total_amount").val(gtotal.toFixed(2));
  }
</script>
<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($stock_detail)) { echo "Edit Stock"; } else { echo "Add Stock"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>

        <div class="form-group">
            <label class="col-sm-2 control-label">Date:<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required name="sale_date" id='sale_date' class="form-control" value='<?php echo date('Y-m-d'); ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 text-center">Quantity</label>
            <label class="col-sm-4 text-center">Medicine Name</label>
            <label class="col-sm-2 text-center">Rate</label>
            <label class="col-sm-1 text-right">Sub Total</label>
            <label class="col-sm-1 text-center">Stock</label>
        </div>
        <?php 
        for($i=0;$i<2;$i++){
        $j=$i+1;
        ?>
        <div class="form-group">
          <div class="col-sm-1">
              <input type="text" name="quantity[]" id='quantity_<?php echo $j;?>' class="form-control inputitem" value='' placeholder="Quantity" onkeyup="calculate(<?php echo $j;?>)" />                
          </div>
          <div class="col-sm-4">
              <input type="text" name="medicine_name[]" id='medicine_name_<?php echo $j;?>' class="form-control inputitem" value='' placeholder="Medicine Name"  num="<?php echo $j;?>" />
          </div>
          <div class="col-sm-2">
              <input type="text" name="rate[]" id='rate_<?php echo $j;?>' class="form-control pack_list" value='' placeholder="Rate" onkeyup="calculate(<?php echo $j;?>)"/>
          </div>
          <div class="col-sm-1 text-right sub_total" id="sub_total_<?php echo $j;?>"></div>
          <div class="col-sm-1 text-center" id="stock_<?php echo $j;?>"></div>
        </div>
        <?php } ?>        
        <div class="form-group">
          <label class="col-sm-2 control-label">Total Amount :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
              <input type="text" required readonly name="total_amount" id='total_amount' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->total_amount; ?>' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">% Discount :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
            <input type="text" required name="discount_percentage" id='discount_percentage' class="form-control" value='' onkeyup="calculate_grandtotal();" autocomplete="off"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Discount :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
            <input type="text" required name="discount_amount" id='discount_amount' class="form-control" value='' onkeyup="calculate_grandtotal();" autocomplete="off" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Grand Total :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
              <input type="text" required readonly name="grand_total" id='grand_amount' class="form-control" value='' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-8">
              <button class="btn btn-success btn-flat" type="submit">Next</button>
          </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->

<script type="text/javascript">
  $('document').ready(function(){
    $(".inputitem").autocomplete({
      source: "sale/get_medicines_stock",
        minLength: 1,
        select: function (e, ui) {
          var num = $(this).attr('num');
          $("#stock_"+num).html(ui.item.stock);
          $("#rate_"+num).val(ui.item.sp_per_unit);              
        }
    });
    $( "#sale_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>