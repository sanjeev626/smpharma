<?php
if (!empty($testimonial_detail)) {
    $action = base_url() . 'admin/Testimonial/editTestimonial/' . $testimonial_detail->id;
} else {
    $action = base_url() . 'admin/Testimonial/addTestimonial';
}
?>

<div class="box box-info">
    <div class="box-header with-border">
        <section class="content-header">
          <h1>
            <?php if (!empty($testimonial_detail)) { echo "Edit Testimonial"; } else { echo "Add Testimonial"; } ?>
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1');
        echo form_open_multipart($action, $attributes);
        ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="name" id='name' class="form-control" value='<?php if (!empty($testimonial_detail)) echo $testimonial_detail->name; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Company Name :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="company_name" id='company_name' class="form-control" value='<?php if (!empty($testimonial_detail)) echo $testimonial_detail->company_name; ?>' />
            </div>
        </div>

         <div class="form-group">
            <label class="col-sm-3 control-label">Position :</label>
            <div class="col-sm-7">
                <input type="text" name="position" id='position' class="form-control" value='<?php if (!empty($testimonial_detail)) echo $testimonial_detail->position; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Image :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input <?php if (empty($testimonial_detail)) echo 'required'; ?> type="file" name="image" id='sliderimage' class="form-control" value='<?php if (!empty($testimonial_detail)) echo $testimonial_detail->image; ?>' />
                    <span class="green">(Image Dimension: 860 x 253  and Max file size 50 kb)</span>

                <?php if (!empty($testimonial_detail) && isset($testimonial_detail->image)) { ?>
                    <input type="hidden" value="<?php echo $testimonial_detail->image; ?>" name="image">
                    <div style="padding-top:10px;"><img height="20%" width="20%" src="<?php echo base_url() . 'uploads/testimonial/' . $testimonial_detail->image; ?>"></div>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Feedback:</label>
            <div class="col-sm-7">
                <textarea name="feedback" class="form-control simple" id="feedback" ><?php
                    if (!empty($testimonial_detail)) {
                        echo $testimonial_detail->feedback;
                    }
                    ?></textarea>
            </div>
        </div>


        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    <button class="btn btn-success btn-flat" type="submit">
                        <?php
                        if (!empty($testimonial_detail)) {
                            echo 'Update Testimonial';
                        } else {
                            echo 'Add Testimonial';
                        }
                        ?>
                    </button>&nbsp;
                </div>
            </div>
        </div><!-- panel-footer -->
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->

