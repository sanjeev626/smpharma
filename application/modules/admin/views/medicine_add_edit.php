<?php
if (!empty($medicine_detail)) {
    $action = base_url() . 'admin/Medicine/editMedicine/' . $medicine_detail->id;
} else {
    $action = base_url() . 'admin/Medicine/addMedicine';
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>
            <?php if (!empty($medicine_detail)) { echo "Edit Medicine"; } else { echo "Add Medicine"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Main Division: :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <select required class="form-control chosen-select" name='aid' data-placeholder="Choose Activity">
                    <option value='0'>Select One</option>
                    <?php foreach ($main_division as $key => $value) {?>
                    <option value='<?php echo $value->id; ?>' <?php if(!empty($medicine_detail) && $medicine_detail->parent_company_id == $value->id){ echo "selected='selected'"; } ?>><?php echo $value->fullname; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Sub Division :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <?php
                $where = array('parent_id'=>$medicine_detail->parent_company_id);  
                $order_by = 'fullname ASC';
                $sub_division =$this->general_model->getAll('tbl_company',$where,$order_by,'id,fullname'); 
                ?>
                <select required class="form-control chosen-select" name='company_id' id="company_id" data-placeholder="Choose Sub Division">
                    <option value='0'>None</option>
                    <?php
                    foreach ($sub_division as $key => $value2) {?>
                    <option value='<?php echo $value2->id; ?>' <?php if(!empty($medicine_detail) && $medicine_detail->company_id == $value2->id){ echo "selected='selected'"; } ?>><?php echo $value2->fullname; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Medicine Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="medicine_name" id='medicine_name' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->medicine_name; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Composition:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="composition" id='composition' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->composition; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Indications:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="indications" id='indications' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->indications; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Side Effects:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="side_effects" id='side_effects' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->side_effects; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Packing:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="packing" id='packing' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->packing; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Category:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="category" id='category' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->category; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Form:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <select required class="form-control chosen-select" name='form' data-placeholder="Choose Form" id="form">
                    <option value=''>Select One</option>
                    <?php
                    foreach ($form_list as $key => $form_value) {?>
                    <option value='<?php echo $form_value->form; ?>' <?php if(!empty($medicine_detail) && $medicine_detail->form == $form_value->form){ echo "selected='selected'"; } ?>><?php echo $form_value->form; ?></option>
                    <?php  } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Available in Nepal:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <select required class="form-control chosen-select" name='aid' data-placeholder="Choose Activity">
                    <option value='1'>Yes</option>
                    <option value='0' <?php if (!empty($medicine_detail) && $medicine_detail->available_in_nepal=="0") echo "selected";?>>No</option>
                </select>    
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Admin Remarks:</label>
            <div class="col-sm-7">
                <input type="text" name="admin_remarks" id='admin_remarks' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->admin_remarks; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">
                    <?php
                    if (!empty($medicine_detail)) {
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

