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

      //Stock Calculation starts Here
      var txtPackNum=document.getElementById('pack_'+num1).value;
      var txtQtyNum=document.getElementById('quantity_'+num1).value;
      var txtDealNum=document.getElementById('deal_'+num1).value;

      if (txtPackNum == ""){txtPackNum= 0;}
      if (txtQtyNum == ""){txtQtyNum = 0;}
      if (txtDealNum == ""){txtDealNum = 0;}

      var total_qty = parseFloat(txtQtyNum)+parseFloat(txtDealNum);
      var stock = parseFloat(total_qty) * parseFloat(txtPackNum);
      
      if (!isNaN(stock)) 
      {
        document.getElementById('stock_'+num1).value =parseFloat(Math.round(stock* 100) / 100).toFixed(2);
      }
      //Stock Calculation ends Here

      //Cost calculation starts here
      var txtRate=document.getElementById('rate_'+num1).value;
      var txtDealPer=document.getElementById('deal_per_'+num1).value;
      var txtVat=document.getElementById('vat_amount').value;
      if (txtRate==""){txtRate=0;}
      if (txtDealPer==""){txtDealPer=0;}
      if (txtVat==""){txtVat=0;}

      var subtotal = parseFloat(txtQtyNum)*parseFloat(txtRate);//10*5=50
      if(parseFloat(txtDealPer)>0)
      {
        var addition = (parseFloat(txtRate)*parseFloat(txtDealPer)*parseFloat(txtDealNum))/100;
        subtotal = parseFloat(subtotal)+parseFloat(addition)
      }

      var value=(parseFloat(txtDealPer)*parseFloat(txtRate)/100)*parseFloat(txtDealNum);//((12*5)/100)*12
      var cp_per_unit = parseFloat(subtotal)/parseFloat(stock);
      var sp_per_unit = (parseFloat(txtRate)*1.16)/parseFloat(txtPackNum);

      if(parseFloat(txtVat)>0)
      {
        sp_per_unit = (parseFloat(txtRate) * 1.13 * 1.16)/parseFloat(txtPackNum);
        //document.getElementById('vatRate_'+num1).value = parseFloat(Math.round(parseFloat(txtRate) * 1.13 * 100)/100).toFixed(2);
      }

      if(parseFloat(subtotal)>0)
      {
        document.getElementById('total_price_'+num1).value =parseFloat(Math.round(subtotal* 100) / 100).toFixed(2);
      }

      if(parseFloat(cp_per_unit)>0)
      {
        document.getElementById('cp_per_unit_'+num1).value =parseFloat(Math.round(cp_per_unit * 100) / 100).toFixed(2);
      }

      if(parseFloat(sp_per_unit)>0)
      {
        document.getElementById('sale_price_'+num1).value =parseFloat(Math.round(sp_per_unit * 100) / 100).toFixed(2);
      }
      //Cost calculation ends here

      //Grand Total Calculation starts here
      var k=0;
      var arrval=[];

      $('.price_total').each(function()
      {
        var total_amt=Number($(this).val());                          
        if(total_amt=='')
        {
          arrval[k++] =0;
        }
        else
        {
          arrval[k++]=Number($(this).val());
        }
      });
      var myTotal=0;              
      for(var j=0;j<arrval.length;j++)
      {                           
        myTotal=myTotal+arrval[j];
      }
      document.getElementById('total_amount').value = parseFloat(Math.round(myTotal* 100) / 100).toFixed(2);

      //for Grand Total           
      var discount_amount=document.getElementById('discount_amount').value;
      var vat_amount=document.getElementById('vat_amount').value;
      var grandtotal =parseFloat(myTotal);
      
      if (discount_amount == ""){discount_amount= 0;}
      if (vat_amount == ""){vat_amount = 0;}

      var grandtotal =parseFloat(myTotal) - parseFloat(discount_amount) + parseFloat(vat_amount);

      document.getElementById('grand_amount').value = parseFloat(Math.round(grandtotal*100)/100).toFixed(0);  
      // Grand total calculcation ends here

      /*var finvalue=parseFloat(value)+parseFloat(qtyrate);//50*
      if (!isNaN(finvalue))
      {
        document.getElementById('total_price_'+num1).value = parseFloat(Math.round(finvalue* 100) / 100).toFixed(2);
      }
      if (!isNaN(sale_price)) 
      {
        document.getElementById('sales_'+num1).value =parseFloat(Math.round(sale_price* 100) / 100).toFixed(2);
      }*/
    }           
  }

//calculate(num)
  function calculate_grandtotal()
  {
    var k=0;
      var arrval=[];

      $('.price_total').each(function()
      {
        var total_amt=Number($(this).val());                          
        if(total_amt=='')
        {
          arrval[k++] =0;
        }
        else
        {
          arrval[k++]=Number($(this).val());
          //alert(k);
          //test_calculate(k);
        }
      });
      var myTotal=0;              
      for(var j=0;j<arrval.length;j++)
      {                           
        myTotal=myTotal+arrval[j];
      }
      document.getElementById('total_amount').value = parseFloat(Math.round(myTotal* 100) / 100).toFixed(2);

      //for Grand Total           
      var discount_amount=document.getElementById('discount_amount').value;
      var vat_amount=document.getElementById('vat_amount').value;
      var grandtotal =parseFloat(myTotal);
      
      if (discount_amount == ""){discount_amount= 0;}
      if (vat_amount == ""){vat_amount = 0;}

      var grandtotal =parseFloat(myTotal) - parseFloat(discount_amount) + parseFloat(vat_amount);

      document.getElementById('grand_amount').value = parseFloat(Math.round(grandtotal*100)/100).toFixed(0);
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
            <label class="col-sm-2 control-label">Supplier / Distributor :<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required name="supplierName" id='supplierName' class="form-control supplier" value='<?php if (!empty($creditmemo)) echo $distributorname; ?>' placeholder="Supplier Name" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Invoice Number :<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required name="invoice_no" id='invoice_no' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->invoice_no; ?>' style="text-transform: uppercase;" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Invoice Date(English):<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required name="invoice_eng_date" id='invoice_eng_date' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->invoice_eng_date; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">VAT Amount:</label>
            <div class="col-sm-8">
                <input type="text" name="vat_amount" id='vat_amount' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->vat_amount; ?>' onkeyup="calculate_grandtotal();" />
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="col-sm-2 control-label">Result :<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required name="result" id='result' class="form-control" value='' />
            </div>
        </div> -->
        <div class="form-group">
            <label class="col-sm-2 text-center">
                Medicine Name<br>/<br>Company Name    
            </label>
            <label class="col-sm-2 text-center">
                Pack <a href="javascript:void(0);" title="Number of Tabs/Caps in a Strip.">?</a><br>/<br>Batch
            </label>
            <label class="col-sm-2 text-center">
                Expiry Date<br>/<br>Quantity
            </label>
            <label class="col-sm-2 text-center">
                Cost Price<br>/<br>Selling Price per unit
            </label>
            <label class="col-sm-2 text-center">
                Deal<br>/<br>Deal Percent
            </label>
            <label class="col-sm-2 text-center">
                Stock<br>/<br>Total
            </label>
        </div>

        <?php 
            //for($i=0;$i<10;$i++){
            //$j=$i+1;
        $j=1;
        //print_r($stockInfo);
        $k=0;
        $this->load->model('Medicine_model');
        foreach($stockInfo as $row)
        {
          ++$k;
        ?>
        <div class="form-group">
          <div class="col-sm-2">
              <input type="text" name="old_medicine_name[]" id='old_medicine_name_<?php echo $k;?>' class="form-control inputitem2" value='<?php echo $row->item_description;?>' placeholder="Medicine Name" />
              <input type="text" name="old_company_name[]" id='old_company_name_<?php echo $k;?>' class="form-control company" value='<?php echo $this->Medicine_model->get_companyname_by_medicine_id($row->medicine_id);?>' placeholder="Company Name" />
          </div>
          <div class="col-sm-2">
              <input type="text" name="old_pack[]" id='old_pack_<?php echo $k;?>' class="form-control pack_list" value='<?php echo $row->pack;?>' placeholder="Pack (10)" onkeyup="calculate(<?php echo $k;?>);" />
              <input type="text" name="old_batch_number[]" id='old_batch_number_<?php echo $k;?>' class="form-control" value='<?php echo $row->batch_number;?>' placeholder="Batch Number" />
          </div>
          <div class="col-sm-2">
              <input type="text" name="old_expiry_date[]" id='old_expiry_date<?php echo $i+1;?>' class="form-control expiry_date" value='<?php echo $row->expiry_date;?>' placeholder="Expiry Date (dd-mm-yyyy)" />
              <input type="text" name="old_quantity[]" id='old_quantity_<?php echo $k;?>' class="form-control" value='<?php echo $row->quantity;?>' placeholder="Quantity" onkeyup="calculate(<?php echo $k;?>);" />
          </div>
          <div class="col-sm-2">
              <input type="text" name="old_rate[]" id='old_rate_<?php echo $k;?>' class="form-control cc_rate" value='<?php echo $row->rate;?>' placeholder="Cost Price" onkeyup="calculate(<?php echo $k;?>);" />
              <input type="text" name="old_sale_price[]" id='old_sale_price_<?php echo $k;?>' class="form-control" value='<?php echo $row->sp_per_unit;?>' placeholder="Sale Price" />
          </div>
          <div class="col-sm-2">
              <input type="text" name="old_deal[]" id='old_deal_<?php echo $k;?>' class="form-control" value='<?php echo $row->deal;?>' placeholder="Deal" />
              <input type="text" name="old_deal_percentage[]" id='old_deal_per_<?php echo $k;?>' class="form-control" value='<?php echo $row->deal_percentage;?>' placeholder="Deal Percentage - 7.5" onkeyup="calculate(<?php echo $k;?>);" />
          </div>
          <div class="col-sm-2">
              <input type="text" name="old_stock[]" id='old_stock_<?php echo $k;?>' class="form-control" value='<?php echo $row->stock;?>' placeholder="Stock" />
              <input type="text" name="old_total_price[]" id='old_total_price_<?php echo $k;?>' class="form-control price_total" value='<?php echo $row->total_price;?>' placeholder="Total" />
              <input type="hidden" name="old_cp_per_unit[]" id='old_cp_per_unit_<?php echo $k;?>' value='<?php echo $row->cp_per_unit;?>' />
          </div>
        </div>
        <?php //} 
        }
        ?>
        <?php 
            for($i=0;$i<10;$i++){
            $j=$i+1;
        ?>
        <div class="form-group">
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="medicine_name[]" id='medicine_name_<?php echo $j;?>' class="form-control inputitem" value='' placeholder="Medicine Name" />
                <input type="text" name="company_name[]" id='company_name_<?php echo $j;?>' class="form-control company" value='' placeholder="Company Name" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="pack[]" id='pack_<?php echo $j;?>' class="form-control pack_list" value='' placeholder="Pack (10)" onkeyup="calculate(<?php echo $j;?>);" />
                <input type="text" <?php if($i==0) echo 'required';?> name="batch_number[]" id='batch_number_<?php echo $j;?>' class="form-control" value='' placeholder="Batch Number" />
            </div>
            <div class="col-sm-2">
                <input type="text" name="expiry_date[]" id='expiry_date<?php echo $i+1;?>' class="form-control expiry_date" value='' placeholder="Expiry Date (dd-mm-yyyy)" />
                <input type="text" <?php if($i==0) echo 'required';?> name="quantity[]" id='quantity_<?php echo $j;?>' class="form-control" value='' placeholder="Quantity" onkeyup="calculate(<?php echo $j;?>);" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="rate[]" id='rate_<?php echo $j;?>' class="form-control cc_rate" value='' placeholder="Cost Price" onkeyup="calculate(<?php echo $j;?>);" />
                <input type="text" <?php if($i==0) echo 'required';?> name="sale_price[]" id='sale_price_<?php echo $j;?>' class="form-control" value='' placeholder="Sale Price" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="deal[]" id='deal_<?php echo $j;?>' class="form-control" value='0' placeholder="Deal" />
                <input type="text" <?php if($i==0) echo 'required';?> name="deal_percentage[]" id='deal_per_<?php echo $j;?>' class="form-control" value='0' placeholder="Deal Percentage - 7.5" onkeyup="calculate(<?php echo $j;?>);" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="stock[]" id='stock_<?php echo $j;?>' class="form-control" value='' placeholder="Stock" />
                <input type="text" <?php if($i==0) echo 'required';?> name="total_price[]" id='total_price_<?php echo $j;?>' class="form-control price_total" value='' placeholder="Total" />
                <input type="hidden" name="cp_per_unit[]" id='cp_per_unit_<?php echo $j;?>' value='' />
            </div>
        </div>
        <?php } ?>        
        <div class="form-group">
            <label class="col-sm-2 control-label">Total Amount :<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required readonly name="total_amount" id='total_amount' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->total_amount; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Discount :<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required name="discount_amount" id='discount_amount' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->discount_amount; else echo "0"; ?>' onkeyup="calculate_grandtotal();" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Grand Total :<span class="asterisk">*</span></label>
            <div class="col-sm-8">
                <input type="text" required readonly name="grand_amount" id='grand_amount' class="form-control" value='<?php if (!empty($creditmemo)) echo $creditmemo->grand_amount; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($stock_detail)) {
                        echo 'Update Stock';
                    } else {
                        echo 'Add Stock';
                    }
                    ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->
  <script type="text/javascript">
    $('document').ready(function(){
      $(".inputitem").autocomplete({
        source: "../medicine/get_medicines",
            minLength: 1,
            select: function (e, ui) {
                //location.href = ui.item.the_link;
            }
      });
      $(".inputitem2").autocomplete({
        source: "../../medicine/get_medicines",
            minLength: 1,
            select: function (e, ui) {
                //location.href = ui.item.the_link;
            }
      });

      $(".supplier").autocomplete({
        source: "../supplier/get_suppliers",
            minLength: 1,
            select: function (e, ui) {
                //location.href = ui.item.the_link;
            }
      });


      $(".company").autocomplete({
        source: "../company/get_companies",
            minLength: 1,
            select: function (e, ui) {
                //location.href = ui.item.the_link;
            }
      });

      $( "#invoice_eng_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#expiry_date1, #expiry_date2, #expiry_date3, #expiry_date4, #expiry_date5, #expiry_date6, #expiry_date7, #expiry_date8, #expiry_date9, #expiry_date10, #expiry_date11, #expiry_date12" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
  </script>