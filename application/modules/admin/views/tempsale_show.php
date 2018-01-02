<div class="box box-info">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Sales Details</h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $action = base_url() . 'admin/Sale/completeSales';
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nepali Date:</label>
            <div class="col-sm-3">
              <?php echo $tempsales['0']->sale_date_nepali;?>
            </div>
          <label class="col-sm-2 control-label">English Date:</label>
          <div class="col-sm-3">
            <?php echo $tempsales['0']->sale_date;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Customer Name:</label>
          <div class="col-sm-3">
            <?php echo $tempsales['0']->customer_name;?>
          </div>
          <label class="col-sm-2 control-label">Contact Number:</label>
          <div class="col-sm-3">
            <?php echo $tempsales['0']->contact_number;?>
          </div>
        </div>
        <hr/>
        <div class="form-group">
          <label class="col-sm-1 text-center">Quantity</label>
          <label class="col-sm-4 text-left">Medicine Name</label>
          <label class="col-sm-2 text-right">Rate</label>
          <label class="col-sm-2 text-right">Sub Total</label>
        </div>
        <hr/>
        <?php 
        foreach($temporders as $temporder){
        ?>
        <div class="form-group">
          <div class="col-sm-1 text-center">
            <?php echo $temporder->quantity;?>
          </div>
          <div class="col-sm-4 text-left">
            <?php echo $temporder->medicine_name;?>
          </div>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $temporder->rate;?>
          </div>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $temporder->sub_total;?></div>
        </div>
        <?php } ?> 
        <hr/>       
        <div class="form-group">
          <label class="col-sm-2 control-label">Total Amount :</label>
          <div class="col-sm-8">
            Nrs. <?php echo $tempsales['0']->sub_total;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">% Discount :</label>
          <div class="col-sm-8">
            <?php echo $tempsales['0']->discount_percentage;?>%
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Discount :</label>
          <div class="col-sm-8">
            Nrs. <?php echo $tempsales['0']->discount_amount;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Grand Total :</label>
          <div class="col-sm-8">
            Nrs. <?php echo $tempsales['0']->grand_total;?>
          </div>
        </div>
        <hr/>
        <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
          <div class="col-sm-8">
            <a href="<?php echo base_url() . 'admin/sale/editTempSale/'.$tempsales_id;?>" class="btn btn-success btn-flat">Back</a>
            <button class="btn btn-success btn-flat" type="submit">Complete</button>
          </div>
        </div>
    </div><!-- panel-body -->
</div><!-- panel -->