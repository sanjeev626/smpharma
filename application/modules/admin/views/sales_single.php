<div class="box box-info">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Sales Details</h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">
        <?php
        $action = base_url() . 'admin/sale/completeSales/'.$sales_id;
        $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
        echo form_open($action, $attributes);
        ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nepali Date:</label>
            <div class="col-sm-3">
              <?php echo $sales['0']->sale_date_nepali;?>
            </div>
          <label class="col-sm-2 control-label">English Date:</label>
          <div class="col-sm-3">
            <?php echo $sales['0']->sale_date;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Customer Name:</label>
          <div class="col-sm-3">
            <?php echo $sales['0']->customer_name;?>
          </div>
          <label class="col-sm-2 control-label">Contact Number:</label>
          <div class="col-sm-3">
            <?php echo $sales['0']->contact_number;?>
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
        if($orders)
        {
        foreach($orders as $order){
        ?>
        <div class="form-group">
          <div class="col-sm-1 text-center">
            <?php echo $order->quantity;?>
          </div>
          <div class="col-sm-4 text-left">
            <?php echo $order->medicine_name;?>
          </div>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $order->rate;?>
          </div>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $order->sub_total;?></div>
        </div>
        <?php 
        } 
        }
        ?> 
        <hr/>       
        <div class="form-group">
          <label class="col-sm-8 control-label">Total Amount :</label>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $sales['0']->sub_total;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-8 control-label">% Discount :</label>
          <div class="col-sm-2 text-right">
            <?php echo $sales['0']->discount_percentage;?>%
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-8 control-label">Discount :</label>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $sales['0']->discount_amount;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-8 control-label">Grand Total :</label>
          <div class="col-sm-2 text-right">
            Nrs. <?php echo $sales['0']->grand_total;?>
          </div>
        </div>
        <hr/>
        <div class="form-group">
          <label class="col-sm-8 control-label">&nbsp;</label>
          <div class="col-sm-2 text-right">
            <a href="<?php echo base_url() . 'admin/sale/editTempSale/'.$sales_id;?>" class="btn btn-success btn-flat">Back</a>
            <button class="btn btn-success btn-flat" type="submit">Complete</button>
          </div>
        </div>
    </div><!-- panel-body -->
</div><!-- panel -->