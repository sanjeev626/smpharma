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

  function calculate_old(num)
  {
    if(num)
    {
      var num1=num;

      //Subtotal Calculation starts Here
      var quantity= $("#quantity_old_"+num1).val() || 0;
      var rate=document.getElementById('rate_old_'+num1).value;
      //alert(quantity);

      if (quantity == ""){quantity= 0;}
      if (rate == ""){rate = 0;}
      var sub_total = parseFloat(quantity)*parseFloat(rate);
      //alert(quantity+'X'+rate+'='+sub_total);
      if(parseFloat(sub_total)>0)
      {
        var subtotal = parseFloat(Math.round(sub_total* 100) / 100).toFixed(2);
        $('#sub_total_old_'+num1).html(subtotal);
      }
      //Calculate Grand Total
    }
    calculate_totalamount_old();
    calculate_grandtotal();
  }

  function calculate_totalamount_old()
  {
    var totalamount = 0.00;
    $(".sub_total_old").each(function() {
      subtotal_old = $(this).html() || 0; // note || here
      totalamount_old += parseFloat(subtotal_old);
    });

    $(".sub_total").each(function() {
      subtotal = $(this).html() || 0; // note || here
      totalamount_new += parseFloat(subtotal);
    });
    var totalamount = parseFloat(totalamount_new)+parseFloat(totalamount_old);
    //alert(totalamount);
    $("#total_amount").val(totalamount.toFixed(2));
  }

  function calculate_grandtotal_old()
  {
    var total_amount = $("#total_amount").val() || 0; // note || here
    var discount_percentage = $("#discount_percentage").val() || 0; // note || here
    var discount_amount = parseFloat(total_amount)*parseFloat(discount_percentage)/100;
    var gtotal = parseFloat(total_amount)-parseFloat(discount_amount);
    $("#discount_amount").val(discount_amount.toFixed(2));
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
            <label class="col-sm-2 control-label">Nepali Date:<span class="asterisk">*</span></label>
            <div class="col-sm-3">
                <input type="text" name="sale_date_nepali" id="nepaliDate" class="form-control nepali-calendar" value="<?php echo $tempsales['0']->sale_date_nepali;?>"/>
            </div>
          <label class="col-sm-2 control-label">English Date:<span class="asterisk">*</span></label>
          <div class="col-sm-3">
              <input type="text" required name="sale_date" id='sale_date' class="form-control" value='<?php echo $tempsales['0']->sale_date;?>' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Customer Name:</label>
          <div class="col-sm-3">
              <input type="text" name="customer_name" id='customer_name' class="form-control" value='<?php echo $tempsales['0']->customer_name;?>' />
          </div>
          <label class="col-sm-2 control-label">Contact Number:</label>
          <div class="col-sm-3">
              <input type="text" name="contact_number" id='contact_number' class="form-control" value='<?php echo $tempsales['0']->contact_number;?>' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-1 text-center">Quantity</label>
          <label class="col-sm-4 text-center">Medicine Name</label>
          <label class="col-sm-2 text-center">Rate</label>
          <label class="col-sm-1 text-right">Sub Total</label>
          <label class="col-sm-1 text-center">Available</label>
        </div>
        <hr/>
        <?php
        $k=0;
        foreach($temporders as $temporder){
          ++$k;
        ?>
        <div class="form-group">
          <div class="col-sm-1 text-center">
            <input type="text" name="quantity_old[]" id='quantity_old_<?php echo $k;?>' class="form-control inputitem" value='<?php echo $temporder->quantity;?>' placeholder="Quantity" onkeyup="calculate_old(<?php echo $k;?>)" />

            <input type="hidden" name="tempsales_id_old[]" id='tempsales_id_old_<?php echo $k;?>' class="form-control inputitem" value='<?php echo $temporder->id;?>' />
          </div>
          <div class="col-sm-4 text-left">
            <input type="text" name="medicine_name_old[]" id='medicine_name_old_<?php echo $k;?>' class="form-control inputitem" value='<?php echo $temporder->medicine_name;?>' placeholder="Medicine Name"  num="<?php echo $k;?>" />
            <input type="hidden" name="medicine_id_old[]" id='medicine_id_old_<?php echo $k;?>' class="form-control inputitem" value='<?php echo $temporder->medicine_id;?>' num="<?php echo $k;?>" />
            <input type="hidden" name="stock_id_old[]" id='stock_id_old_<?php echo $k;?>' class="form-control inputitem" value='<?php echo $temporder->stock_id;?>' num="<?php echo $k;?>" />

          </div>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $temporder->rate;?>
          </div>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $temporder->sub_total;?></div>
        </div>
        <?php } ?> 
        <hr/>  
        <?php 
        for($i=0;$i<5;$i++){
        $j=$i+1;
        ?>
        <div class="form-group">
          <div class="col-sm-1">
            <input type="text" name="quantity[]" id='quantity_<?php echo $j;?>' class="form-control inputitem" value='' placeholder="Quantity" onkeyup="calculate(<?php echo $j;?>)" />               
          </div>
          <div class="col-sm-4">
            <input type="text" name="medicine_name[]" id='medicine_name_<?php echo $j;?>' class="form-control inputitem" value='' placeholder="Medicine Name"  num="<?php echo $j;?>" />
            <input type="hidden" name="medicine_id[]" id='medicine_id_<?php echo $j;?>' class="form-control inputitem" value='' num="<?php echo $j;?>" />
            <input type="hidden" name="stock_id[]" id='stock_id_<?php echo $j;?>' class="form-control inputitem" value='' num="<?php echo $j;?>" />
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
            <input type="text" required readonly name="total_amount" id='total_amount' class="form-control" value='<?php echo $tempsales['0']->sub_total;?>' />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">% Discount :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
            <input type="text" required name="discount_percentage" id='discount_percentage' class="form-control" value='<?php echo $tempsales['0']->discount_percentage;?>' onkeyup="calculate_grandtotal();" autocomplete="off"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Discount :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
            <input type="text" required name="discount_amount" id='discount_amount' class="form-control" value='<?php echo $tempsales['0']->discount_amount;?>' onkeyup="discount_amount_change();" autocomplete="off" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Grand Total :<span class="asterisk">*</span></label>
          <div class="col-sm-8">
            <input type="text" required readonly name="grand_total" id='grand_amount' class="form-control" value='<?php echo $tempsales['0']->grand_total;?>' />
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
          $("#stock_id_"+num).val(ui.item.stock_id);
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