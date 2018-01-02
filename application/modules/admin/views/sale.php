<?php
if (!empty($stock_detail)) {
    $action = base_url() . 'admin/Sale/editSale/' . $stock_detail->id;
} else {
    $action = base_url() . 'admin/Sale/addSale';
}
$action = base_url() . 'admin/sale/addTempSale';
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
    calculate_totalamount();
    calculate_grandtotal();
  }

  function calculate_totalamount()
  {
    var totalamount = 0.00;

    $(".sub_total").each(function() {
      subtotal = $(this).html() || 0; // note || here
      totalamount += parseFloat(subtotal);
    });
    //alert(totalamount);
    $("#total_amount").val(totalamount.toFixed(2));
  }

  function calculate_grandtotal()
  {
    var total_amount = $("#total_amount").val() || 0; // note || here
    var discount_percentage = $("#discount_percentage").val() || 0; // note || here
    var discount_amount = parseFloat(total_amount)*parseFloat(discount_percentage)/100;
    var gtotal = parseFloat(total_amount)-parseFloat(discount_amount);
    $("#discount_amount").val(discount_amount.toFixed(2));
    $("#grand_amount").val(gtotal.toFixed(2));
  }


  function change_grandtotal()
  {
    var total_amount = $("#total_amount").val() || 0; // note || here
    var discount_amount = $("#discount_amount").val() || 0; // note || here
    var gtotal = parseFloat(total_amount)-parseFloat(discount_amount);
    $("#grand_amount").val(gtotal.toFixed(2));
  }

  function calculate_grandtotal()
  {    
      var total_amount =  $("#total_amount").val() || 0; // note || here
      var discount_percentage = $("#discount_percentage").val() || 0; // note || here
      var discount_amount = parseFloat(total_amount)*parseFloat(discount_percentage)/100;

      $("#discount_amount").val(discount_amount);
      var gtotal = parseFloat(total_amount)-parseFloat(discount_amount);
      $("#grand_amount").val(gtotal.toFixed(2));
  }

  function discount_amount_change()
  {    
      var total_amount =  $("#total_amount").val() || 0; // note || here
      var discount_amount = $("#discount_amount").val() || 0; // note || here
      var gtotal = parseFloat(total_amount)-parseFloat(discount_amount);
      $("#grand_amount").val(gtotal.toFixed(2));
  }
</script>
<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1><?php if (!empty($stock_detail)) { echo "Edit Sales"; } else { echo "Add Sales"; } ?></h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Customer Name:</label>
            <div class="col-sm-8">
                <input type="text" name="customer_name" id="customer_name" class="form-control" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Contact Number:</label>
            <div class="col-sm-8">
                <input type="text" name="contact_number" id="contact_number" class="form-control" value=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nepali Date:<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" name="sale_date_nepali" id="nepaliDate" class="form-control nepali-calendar" value="2074-08-02"/>
            </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">English Date:<span class="asterisk">*</span></label>
          <div class="col-sm-8">
              <input type="text" required name="sale_date" id='sale_date' class="form-control" value='<?php echo date('Y-m-d'); ?>' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Customer Name:</label>
          <div class="col-sm-8">
              <input type="text" name="customer_name" id='customer_name' class="form-control" value='' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Contact Number:</label>
          <div class="col-sm-8">
              <input type="text" name="contact_number" id='contact_number' class="form-control" value='' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 text-center">Medicine Name</label>
          <label class="col-sm-1 text-center">Quantity</label>
          <label class="col-sm-4 text-center">Medicine Name</label>
          <label class="col-sm-2 text-center">Rate</label>
          <label class="col-sm-1 text-right">Sub Total</label>
          <label class="col-sm-1 text-center">Sale</label>
        </div>
        <?php 
        for($i=0;$i<10;$i++){
        $j=$i+1;
        ?>
        <div class="form-group">
          <div class="col-sm-4">
            <input type="text" name="medicine_name[]" id='medicine_name_<?php echo $j;?>' class="form-control inputitem" value='' placeholder="Medicine Name"  num="<?php echo $j;?>" />
            <input type="hidden" name="medicine_id[]" id='medicine_id_<?php echo $j;?>' class="form-control inputitem" value='' num="<?php echo $j;?>" />
          </div>
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
            <input type="text" required name="discount_percentage" id='discount_percentage' class="form-control" value='0' onkeyup="calculate_grandtotal();" autocomplete="off"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Discount :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
            <input type="text" required name="discount_amount" id='discount_amount' class="form-control" value='0' onkeyup="change_grandtotal();" autocomplete="off" />
            <input type="text" required name="discount_amount" id='discount_amount' class="form-control" value='' onkeyup="discount_amount_change();" autocomplete="off" />
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
          $("#medicine_id_"+num).val(ui.item.medicine_id);
          $("#stock_"+num).html(ui.item.stock);
          $("#rate_"+num).val(ui.item.sp_per_unit);              
        }
    });
    $( "#sale_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
<script>
  $(document).ready(function(){
    $('#nepaliDate').val(AD2BS($('#sale_date').val()));

    $('#nepaliDate').nepaliDatePicker({
      ndpEnglishInput: 'sale_date'
    });

    $('#sale_date').change(function(){
      $('#nepaliDate').val(AD2BS($('#sale_date').val()));
    });
  });
</script>