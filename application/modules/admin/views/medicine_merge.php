<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">      
      <?php
      $action = base_url() . 'admin/medicine/merge_medicine';
      $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
      echo form_open($action, $attributes);
      ?>
      <div class="form-group">
          <label class="col-sm-3 control-label">Correct Medicine Name:</label>
          <div class="col-sm-7">
            <input type="text" name="correct_name" id='correct_name' class="form-control" value='' placeholder="Search for Medicine" />
            <input type="hidden" name="correct_name_id" id='correct_name_id' value='' />
          </div>
      </div>
      <div class="form-group">
          <label class="col-sm-3 control-label">Wrong Medicine Name:</label>
          <div class="col-sm-7">
            <input type="text" name="wrong_name" id='wrong_name' class="form-control" value='' placeholder="Search for Medicine" />
            <input type="hidden" name="wrong_name_id" id='wrong_name_id' value='' />
          </div>
      </div>
      <div class="form-group">
          <label class="col-sm-3 control-label">&nbsp;</label>
          <div class="col-sm-7">
              <button class="btn btn-success btn-flat" type="submit" name="btnMerge">Merge</button>
          </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
    <!-- /.box -->
</section>  
  <?php
    $get_medicines_path = "get_medicines";
  ?>
  <script type="text/javascript">
    $('document').ready(function(){
      $("#correct_name").autocomplete({
        source: "<?php echo $get_medicines_path;?>",
          minLength: 1,
          select: function (e, ui) {
            $("#correct_name_id").val(ui.item.medicine_id);
            //location.href = ui.item.the_link;
          }
      });
      $("#wrong_name").autocomplete({
        source: "<?php echo $get_medicines_path;?>",
          minLength: 1,
          select: function (e, ui) {
            $("#wrong_name_id").val(ui.item.medicine_id);
            //location.href = ui.item.the_link;
          }
      });
    });
  </script>