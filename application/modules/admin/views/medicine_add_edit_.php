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
            <label class="col-sm-3 control-label">Medicine :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="title" id='title' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->title; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Excerpt:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="excerpt" id='excerpt' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->excerpt; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Description:</label>
            <div class="col-sm-7">
                <textarea name="description" class="form-control simple" id="description" ><?php
                    if (!empty($medicine_detail)) {
                        echo $medicine_detail->description;
                    }
                    ?></textarea>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Image:</label>
            <div class="col-sm-7">
                <input type="file" id="medicineimage" name="medicineimage">
                <span class="green">(Max file size 50 kb)</span>

                <?php if (!empty($medicine_detail) && isset($medicine_detail->medicineimage)) { ?>
                    <input type="hidden" value="<?php echo $medicine_detail->medicineimage; ?>" name="medicineimage_prev">
                    <div style="padding-top:10px;"><img height="20%" width="20%" src="<?php echo base_url() . 'uploads/medicine/' . $medicine_detail->medicineimage; ?>"></div>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Meta Title:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="pagetitle" id='pagetitle' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->pagetitle; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Meta Keywords:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="metakeywords" id='metakeywords' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->metakeywords; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Meta Description:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="metadescription" id='metadescription' class="form-control" value='<?php if (!empty($medicine_detail)) echo $medicine_detail->metadescription; ?>' />
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

