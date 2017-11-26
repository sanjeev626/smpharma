<?php
if (!empty($stock_detail)) {
    $action = base_url() . 'admin/Medicine/editMedicine/' . $stock_detail->id;
} else {
    $action = base_url() . 'admin/Medicine/addMedicine';
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($stock_detail)) { echo "Edit Medicine"; } else { echo "Add Medicine"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for Medicine" />

            <label class="col-sm-3 control-label">Distributor :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <select required class="form-control chosen-select" name='aid' data-placeholder="Choose Activity">
                    <option value='0'>Select One</option>
                    <?php foreach ($supplier_list as $key => $value) {?>
                    <option value='<?php echo $value->id; ?>' <?php if(!empty($stock_detail) && $stock_detail->parent_company_id == $value->id){ echo "selected='selected'"; } ?>><?php echo $value->fullname; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Invoice Number :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="medicine_name" id='medicine_name' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->medicine_name; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Invoice Date(English):<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="composition" id='composition' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->composition; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">
                Medicine Name    
            </label>
            <label class="col-sm-1">
                Pack <a href="javascript:void(0);" title="Number of Tabs/Caps in a Strip.">?</a>
            </label>
            <label class="col-sm-1">
                Batch
            </label>
            <label class="col-sm-1">
                Expiry Date
            </label>
            <label class="col-sm-1">
                Quantity
            </label>
            <label class="col-sm-1">
                Cost Price
            </label>
            <label class="col-sm-1">
                sale Price
            </label>
            <label class="col-sm-1">
                Deal
            </label>
            <label class="col-sm-1">
                Deal Percent
            </label>
            <label class="col-sm-1">
                Stock
            </label>
            <label class="col-sm-1">
                Total
            </label>
        </div>
        <?php for($i=0;$i<1;$i++){?>
        <div class="form-group">
            <div class="col-sm-2">
                <input type="text" required name="medicine_name[]" id='medicine_name[]' class="form-control inputitem" value='<?php if (!empty($stock_detail)) echo $stock_detail->medicine_id; ?>' placeholder="Medicine Name" />
                <input type="text" required name="company_name[]" id='company_name[]' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->medicine_id; ?>' placeholder="Company Name" />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="pack[]" id='pack' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' placeholder="10" />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="batch_number[]" id='batch_number' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="expiry_date[]" id='expiry_date' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="quantity[]" id='quantity' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="rate[]" id='rate' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="sale_price[]" id='sale_price' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="deal[]" id='deal' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="deal_percentage[]" id='deal_percentage' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="stock[]" id='stock' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
            <div class="col-sm-1">
                <input type="text" required name="total_price[]" id='total_price' class="form-control" value='<?php if (!empty($stock_detail)) echo $stock_detail->indications; ?>' />
            </div>
        </div>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($stock_detail)) {
                        echo 'Update Medicine';
                    } else {
                        echo 'Add Medicine';
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
      $('.delete_Medicine').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "Medicine/get_medicines",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>