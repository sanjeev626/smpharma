<?php
if (!empty($supplier_detail)) {
    $action = base_url() . 'admin/Supplier/editSupplier/' . $supplier_detail->id;
} else {
    $action = base_url() . 'admin/Supplier/addSupplier';
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($supplier_detail)) { echo "Edit Supplier"; } else { echo "Add Supplier"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Full Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="fullname" id='fullname' class="form-control" value='<?php if (!empty($supplier_detail)) echo $supplier_detail->fullname; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">PAN No.:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="pan_number" id='pan_number' class="form-control" value='<?php if (!empty($supplier_detail)) echo $supplier_detail->pan_number; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">DDA No.:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="dda_regd" id='dda_regd' class="form-control" value='<?php if (!empty($supplier_detail)) echo $supplier_detail->dda_regd; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Address:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="address" id='address' class="form-control" value='<?php if (!empty($supplier_detail)) echo $supplier_detail->address; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Landline:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="landline" id='landline' class="form-control" value='<?php if (!empty($supplier_detail)) echo $supplier_detail->landline; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Mobile:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="mobile" id='mobile' class="form-control" value='<?php if (!empty($supplier_detail)) echo $supplier_detail->mobile; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Company List:<span class="asterisk">*</span></label>
        </div>
        <div class="form-group">    
                <?php 
                $clist_arr=array();
                if(isset($supplier_detail))
                {
                    $companylist = $supplier_detail->companylist;
                    $clist_arr = explode(',',$companylist);
                }
                foreach ($company_list as $key => $value) {
                ?>
                <div class="col-sm-4">
                <input type="checkbox" id="companylist" name="companylist[]" value="<?php echo $value->id; ?>" <?php if (in_array($value->id, $clist_arr)) { echo 'checked';}?>>
                <label for="companylist"><?php echo $value->fullname; ?></label>
                </div>
                <?php  } ?>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($supplier_detail)) {
                        echo 'Update Supplier';
                    } else {
                        echo 'Add Supplier';
                    }
                    ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->

