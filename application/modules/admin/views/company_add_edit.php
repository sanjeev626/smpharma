<?php
if (!empty($company_detail)) {
    $action = base_url() . 'admin/Company/editCompany/' . $company_detail->id;
} else {
    $action = base_url() . 'admin/Company/addCompany';
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($company_detail)) { echo "Edit Company"; } else { echo "Add Company"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Parent Company: :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <select required class="form-control chosen-select" name='aid' data-placeholder="Choose Activity">
                    <option value='0'>Main Division</option>
                    <?php foreach ($parent_company_list as $key => $value) {?>
                    <option value='<?php echo $value->id; ?>' <?php if(!empty($company_detail) && $company_detail->aid == $value->id){ echo "selected='selected'"; } ?>><?php echo $value->fullname; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Full Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="fullname" id='fullname' class="form-control" value='<?php if (!empty($company_detail)) echo $company_detail->fullname; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Address:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="address" id='address' class="form-control" value='<?php if (!empty($company_detail)) echo $company_detail->address; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Landline:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="landline" id='landline' class="form-control" value='<?php if (!empty($company_detail)) echo $company_detail->landline; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Mobile:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="mobile" id='mobile' class="form-control" value='<?php if (!empty($company_detail)) echo $company_detail->mobile; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($company_detail)) {
                        echo 'Update Company';
                    } else {
                        echo 'Add Company';
                    }
                    ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->

