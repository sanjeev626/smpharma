<?php
if (!empty($package_detail)) {
    $action = base_url() . 'admin/Package/addeditItinerary/' . $package_detail->id;
}
?> 

<div class="box box-info">
    <div class="box-header with-border">
         <section class="content-header">
          <h1>Add/Edit Itinerary for <?php echo $this->general_model->getFieldById('tbl_package', 'id', $package_detail->id, 'title');?></h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        $required = '';
        
        if (!empty($itinerary_detail)) { 
        foreach ($itinerary_detail as $row):
        ?>
        <div class="form-group" style="border: 1px solid #222D32; border-radius: 4px; margin:10px; padding:10px 0;">
            <div class="col-sm-4">
                <label class="control-label">Day:</label>
                <input type="hidden" name="itinerary_id[]" id='itinerary_id[]' value="<?php echo $row->id;?>" />
                <input type="text" <?php echo $required;?> name="day_old[]" id='day_old[]' class="form-control" value="<?php echo $row->day;?>" />
                <label class="control-label">Title:</label>
                <input type="text" <?php echo $required;?> name="title_old[]" id='title_old[]' class="form-control" value="<?php echo $row->title;?>" />
                <label class="control-label">Services:</label>
                <textarea <?php echo $required;?> name="services_old[]" class="form-control" id="services_old[]" placeholder="Seperate multiple services with a comma(,)"><?php echo $row->services;?></textarea>
            </div>
            <div class="col-sm-8">
                <label class="control-label">Description:</label>
                <textarea name="description_old[]" class="form-control simple" id="description_old[]"><?php echo $row->description;?></textarea>
            </div>
        </div>
        <?php
        endforeach;
        }

         
        for($i=0;$i<5;$i++){
        if($i==0 && empty($itinerary_detail))
            $required = "required";
        ?>
        <div class="form-group" style="border: 1px solid #222D32; border-radius: 4px; margin:10px; padding:10px 0;">
            <div class="col-sm-4">
                <label class="control-label">Day:</label>
                <input type="text" <?php echo $required;?> name="day[]" id='day[]' class="form-control" value="" />
                <label class="control-label">Title:</label>
                <input type="text" <?php echo $required;?> name="title[]" id='title[]' class="form-control" value="" />
                <label class="control-label">Services:</label>
                <textarea <?php echo $required;?> name="services[]" class="form-control" id="services[]" placeholder="Seperate multiple services with a comma(,)"></textarea>
            </div>
            <div class="col-sm-8">
                <label class="control-label">Description:</label>
                <textarea name="description[]" class="form-control simple" id="description[]"><?php
                    // if (!empty($package_detail)) {
                    //     echo $package_detail->description;
                    // }
                    ?></textarea>
            </div>
        </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success btn-flat" type="submit">
                    Update Itinerary
                </button>
                <?php
                if (!empty($package_detail)) {
                ?>
                <a href="<?php echo base_url(); ?>admin/Package/edit/<?php echo $package_detail->id; ?>" class="btn btn-success btn-flat"><i class="fa fa-product-hunt tooltips" data-original-title="Package"></i> Edit Package</a>
                <?php } ?>

            </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->

