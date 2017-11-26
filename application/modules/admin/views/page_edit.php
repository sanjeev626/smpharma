<?php
    $action = base_url() . 'admin/Page/editpage/' . $page_detail->id;
?>

<div class="box box-info">
    <div class="box-header with-border">
        <section class="page-header">
          <h1>
            Edit <?php echo $page_detail->title; ?> page
          </h1>
        </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open_multipart($action, $attributes);
        ?>

        <div class="form-group">
            <label class="col-sm-3 control-label">Title :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" readonly name="title" id='title' class="form-control" value='<?php if (!empty($page_detail)) echo $page_detail->title; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Contents :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <textarea name="contents" class="form-control simple" id="contents" ><?php
                    if (!empty($page_detail)) {
                        echo $page_detail->contents;
                    }
                    ?></textarea>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Excerpt :<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <textarea name="excerpt" class="form-control" id="excerpt" ><?php
                    if (!empty($page_detail)) {
                        echo $page_detail->excerpt;
                    }
                    ?></textarea>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Image:</label>
            <div class="col-sm-7">
                <input type="file" id="iconimage" name="iconimage">
                <span class="green">(Max file size 50 kb)</span>

                <?php if (!empty($page_detail) && isset($page_detail->iconimage) && !empty($page_detail->iconimage)) { ?>
                    <input type="hidden" value="<?php echo $page_detail->iconimage; ?>" name="iconimage_prev">
                    <div style="padding-top:10px;"><img height="20%" width="20%" src="<?php echo base_url() . 'uploads/page/' . $page_detail->iconimage; ?>"></div>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Meta Title:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="metatitle" id='metatitle' class="form-control" value='<?php if (!empty($page_detail)) echo $page_detail->metatitle; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Meta Keywords:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="metakeywords" id='metakeywords' class="form-control" value='<?php if (!empty($page_detail)) echo $page_detail->metakeywords; ?>' />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Meta Description:<span class="asterisk">*</span></label>
            <div class="col-sm-7">
                <input type="text" required name="metadescription" id='metadescription' class="form-control" value='<?php if (!empty($page_detail)) echo $page_detail->metadescription; ?>' />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">&nbsp;</label>
            <div class="col-sm-7">
                <button class="btn btn-success btn-flat" type="submit">Update page</button>&nbsp;
            </div>
        </div>
        <?php echo form_close(); ?>
    </div><!-- panel-body -->
</div><!-- panel -->

