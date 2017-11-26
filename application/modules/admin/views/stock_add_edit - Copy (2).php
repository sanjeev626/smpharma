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
      var txtPackNum=document.getElementById('pack_'+num1).value;
      var txtQtyNum=document.getElementById('quantity_'+num1).value;

      var txtDealNum=document.getElementById('deal_'+num1).value;
      var txtDealPer=document.getElementById('deal_per_'+num1).value;
      var txtRate=document.getElementById('rate_'+num1).value;
      var txtVat=document.getElementById('vat_amount').value;
      if (txtPackNum == ""){txtPackNum= 0;}
      if (txtQtyNum == ""){txtQtyNum = 0;}
      if (txtDealNum == ""){txtDealNum = 0;}
      if (txtDealPer==""){txtDealPer=0;}
      if (txtRate==""){txtRate=0;}
      //to derive total number of tablet
      var al = txtPackNum+'-'+txtQtyNum+'-'+txtDealNum+'-'+txtDealPer+'-'+txtRate+'-'+txtVat;
      document.getElementById('result').value = al;
      //alert(al);
      var total_qty = parseFloat(txtQtyNum)+parseFloat(txtDealNum);
      var stock=parseFloat(result1) * parseFloat(txtPackNum);
      var qtyrate =parseFloat(txtQtyNum)* parseFloat(txtRate);//10*5=50
      var value=(parseFloat(txtDealPer)*parseFloat(txtRate)/100)*parseFloat(txtDealNum);//((12*5)/100)*12
      var sale_price = (parseFloat(txtRate)*1.16)/parseFloat(txtPackNum);
      if(parseFloat(txtVat)>0)
      {
        sale_price = (parseFloat(txtRate) * 1.13 * 1.16)/parseFloat(txtPackNum);
        document.getElementById('vatRate_'+num1).value = parseFloat(Math.round(parseFloat(txtRate) * 1.13 * 100)/100).toFixed(2);
      }
      if (!isNaN(stock)) 
      {
        document.getElementById('stock_'+num1).value =parseFloat(Math.round(result* 100) / 100).toFixed(2);
      }
      var finvalue=parseFloat(value)+parseFloat(qtyrate);//50*
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
            <label class="col-sm-3 control-label">Supplier / Distributor :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="supplierName" id='supplierName' class="form-control supplier" value='<?php if (!empty($stock_detail)) echo $stock_detail->aid; ?>' placeholder="Supplier Name" />
                <?php /*?>
                <select required class="form-control chosen-select" name='aid' data-placeholder="Choose Activity">
                    <option value='0'>Select One</option>
                    <?php foreach ($supplier_list as $key => $value) {?>
                    <option value='<?php echo $value->id; ?>' <?php if(!empty($stock_detail) && $stock_detail->parent_company_id == $value->id){ echo "selected='selected'"; } ?>><?php echo $value->fullname; ?></option>
                    <?php  } ?>
                </select>
                <?php */ ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Invoice Number :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="invoice_no" id='invoice_no' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->invoice_no; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Invoice Date(English):<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="invoice_eng_date" id='invoice_eng_date' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->invoice_eng_date; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Result :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="result" id='result' class="form-control" value='' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 text-center">
                Stock Name<br>/<br>Company Name    
            </label>
            <label class="col-sm-2 text-center">
                Pack <a href="javascript:void(0);" title="Number of Tabs/Caps in a Strip.">?</a><br>/<br>Batch
            </label>
            <label class="col-sm-2 text-center">
                Expiry Date<br>/<br>Quantity
            </label>
            <label class="col-sm-2 text-center">
                Cost Price<br>/<br>Sale Price
            </label>
            <label class="col-sm-2 text-center">
                Deal<br>/<br>Deal Percent
            </label>
            <label class="col-sm-2 text-center">
                Stock<br>/<br>Total
            </label>
        </div>
        <?php 
            for($i=0;$i<10;$i++){
            $j=$i+1;
        ?>
        <div class="form-group">
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="medicine_name[]" id='medicine_name_<?php echo $j;?>' class="form-control inputitem" value='<?php if (!empty($stock_detail)) echo $stock_detail->medicine_id; ?>' placeholder="Stock Name" />
                <input type="text" <?php if($i==0) echo 'required';?> name="company_name[]" id='company_name_<?php echo $j;?>' class="form-control company" value='<?php if (!empty($stock_detail)) echo $stock_detail->medicine_id; ?>' placeholder="Company Name" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="pack[]" id='pack_<?php echo $j;?>' class="form-control pack_list" value='<?php if (!empty($stock_detail)) echo $stock_detail->pack; ?>' placeholder="Pack (10)" onkeyup="calculate(<?php echo $j;?>);" />
                <input type="text" <?php if($i==0) echo 'required';?> name="batch_number[]" id='batch_number_<?php echo $j;?>' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->batch_number; ?>' placeholder="Batch Number" />
            </div>
            <div class="col-sm-2">
                <input type="text" name="expiry_date[]" id='expiry_date<?php echo $i+1;?>' class="form-control expiry_date" value='<?php if (!empty($stock_detail)) echo $stock_detail->expiry_date; ?>' placeholder="Expiry Date (dd-mm-yyyy)" />
                <input type="text" <?php if($i==0) echo 'required';?> name="quantity[]" id='quantity_<?php echo $j;?>' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->quantity; ?>' placeholder="Quantity" onkeyup="calculate(<?php echo $j;?>);" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="rate[]" id='rate_<?php echo $j;?>' class="form-control cc_rate" value='<?php if (!empty($stock_detail)) echo $stock_detail->rate; ?>'placeholder="Cost Price" />
                <input type="text" <?php if($i==0) echo 'required';?> name="sale_price[]" id='sale_price_<?php echo $j;?>' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->sale_price; ?>'placeholder="Sale Price" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="deal[]" id='deal_<?php echo $j;?>' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->deal; ?>'placeholder="Deal" />
                <input type="text" <?php if($i==0) echo 'required';?> name="deal_percentage[]" id='deal_per_<?php echo $j;?>' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->deal_percentage; ?>'placeholder="Deal Percentage" onkeyup="calculate(<?php echo $j;?>);" />
            </div>
            <div class="col-sm-2">
                <input type="text" <?php if($i==0) echo 'required';?> name="stock[]" id='stock_<?php echo $j;?>' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->stock; ?>'placeholder="Stock" />
                <input type="text" <?php if($i==0) echo 'required';?> name="total_price[]" id='total_price_<?php echo $j;?>' class="form-control price_total" value='<?php if (!empty($stock_detail)) echo $stock_detail->total_price; ?>'placeholder="Total" />
            </div>
        </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Total Amount :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" <?php if($i==0) echo 'required';?> name="total_amount" id='total_amount' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->total_amount; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Discount :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" <?php if($i==0) echo 'required';?> name="discount_amount" id='discount_amount' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->discount_amount; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">VAT :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" <?php if($i==0) echo 'required';?> name="vat_amount" id='vat_amount' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->vat_amount; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Grand Total :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" <?php if($i==0) echo 'required';?> name="grand_amount" id='grand_amount' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->grand_amount; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
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
  
  <SCRIPT type="text/javascript">   
    $(document).ready(function()
    {
        $(".pack_list").keyup(function()
        {
            calculate(this.value);
        }

        $(".cc_rate").keyup(function()
        {
            var i=0;
            var arr=[];
            $('.price_total').each(function()
            {
                var total_amt=Number($(this).val());                                            
                if(total_amt=='')
                {
                    arr[i++] =0;
                }
               else
                {
                    arr[i++]=Number($(this).val());
                }                                           
            });
                
            var myTotal=0;              
            for(var j=0;j<arr.length;j++)
            {                           
                myTotal=myTotal+arr[j];
            }                   
            document.getElementById('total_amount').value = parseFloat(Math.round(myTotal* 100) / 100).toFixed(2);


            //for Grand Total           
            var discount_amount=document.getElementById('discount_amount').value;
            var vat_amount=document.getElementById('vat_amount').value;

            var grandtotal =parseFloat(myTotal);

            if (!isNaN(discount_amount) && !isNaN(vat_amount))
            {
                var grandtotal =parseFloat(myTotal) - parseFloat(discount_amount) + parseFloat(vat_amount);
            }

            if (isNaN(discount_amount) && !isNaN(vat_amount))
            {
                var grandtotal =parseFloat(myTotal) + parseFloat(vat_amount);
            }

            if (!isNaN(discount_amount) && isNaN(vat_amount))
            {
                var grandtotal =parseFloat(myTotal) - parseFloat(discount_amount);
            }

            document.getElementById('grand_amount').value = parseFloat(Math.round(grandtotal*100)/100).toFixed(0);
                
        });

        //if deal is defined
        $(".deal_per").keyup(function()
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
                    arrval[k++]=Number($(this).val());                          }
                                
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

            if (!isNaN(discount_amount) && !isNaN(vat_amount))
            {
                var grandtotal =parseFloat(myTotal) - parseFloat(discount_amount) + parseFloat(vat_amount);
            }

            if (isNaN(discount_amount) && !isNaN(vat_amount))
            {
                var grandtotal =parseFloat(myTotal) + parseFloat(vat_amount);
            }

            if (!isNaN(discount_amount) && isNaN(vat_amount))
            {
                var grandtotal =parseFloat(myTotal) - parseFloat(discount_amount);
            }

            document.getElementById('grand_amount').value = parseFloat(Math.round(grandtotal*100)/100).toFixed(0);                  
        });
            
            
        $( "#invoice_eng_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
        $( ".expiry_date" ).datepicker({ dateFormat: 'dd-mm-yy' });

             
        $("#invoice_no").keyup(function () { //user types username on inputfiled
            var invoice_no = $(this).val(); 
            if(invoice_no.length>=1)
               {
                 var dataString ='invoice_info='+ invoice_no;
                   $.ajax({ 
                        url: "check_invoice.php",
                        data: dataString,
                        type: "POST",
                        
                        success: function(response)
                        {
                            var obj=$.parseJSON(response); 
                            //console.log(obj.value1);
                            
                             var result=obj.value2;
                             if(result=='no')
                             {
                                $('#status').html(obj.value1);

                                  $('#addsub').attr('disabled','disabled');
                             }
                             else
                             {
                                $('#status').html(obj.value1);
                                  $('#addsub').removeAttr('disabled');
                             }

                                            
                        }            

                    });
                    }
                // alert(invoice_no.length);
                    if(invoice_no.length == 0)
                        {
                            $('#status').html('');
                        }

            });
    });
</SCRIPT>



  <script type="text/javascript">
    $('document').ready(function(){
      $(".inputitem").autocomplete({
        source: "../medicine/get_medicines",
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
      $( "#expiry_date1, #expiry_date2, #expiry_date3, #expiry_date4, #expiry_date5, #expiry_date6, #expiry_date7, #expiry_date8, #expiry_date9, #expiry_date10, #expiry_date11, #expiry_date12" ).datepicker({ dateFormat: 'dd-mm-yy' });
    });
  </script>