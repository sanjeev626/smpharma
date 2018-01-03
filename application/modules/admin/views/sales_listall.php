<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">          
          <?php    
          $action = base_url() . 'admin/sale/listSales/0';
          $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'name' => 'form1', 'enctype' => 'multipart/form-data');
          echo form_open($action, $attributes);
          ?>
          <div class="panel-footer">
            <a class="btn btn-success below_space" href="javascript:void(0);" onclick="form1.submit();"><i class="fa fa-list" data-original-title="View Basket"></i> List Sales </a>
            <div class="col-xs-3">
                <input type="text" required name="sale_date" id='nepaliDateFrom' class="form-control nepali-calendar" value='<?php if(isset($sale_date) && !empty($sale_date)) echo $sale_date; ?>' />
            </div>
            <div class="col-xs-3">
                <input type="text" name="sale_date_to" id='nepaliDateTo' class="form-control nepali-calendar" value='<?php if(isset($sale_date_to) && !empty($sale_date_to)) echo $sale_date_to; ?>' placeholder="Upto Date" />
            </div>
            <div class="col-xs-4">
                <input type="text" name="keywords" id='keywords' class="form-control" value='<?php if(isset($_POST['keywords'])) echo $_POST['keywords'];?>' placeholder="Customer Name or Contact Number" />
            </div>

          </div>
          <?php echo form_close(); ?>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="2%">S.N</th>
                  <th width="20%">Date </th>
                  <th width="20%">Customer Name </th>
                  <th width="15%">Contact Number </th>
                  <th width="10%">Amount</th>
                  <th width="10%">Discount</th>
                  <th width="15%" class="text-right">Total Amount</th>
                  <th width="18%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total_sales = 0;
                if ($this->uri->segment(4) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(4) + 1;
                }
                if (!empty($sales_info)) { 
                  $counter=0;
                  foreach ($sales_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row->sale_date_nepali.' / '.$row->sale_date; ?></td>
                    <td><?php echo $row->customer_name; ?></td>
                    <td><?php echo $row->contact_number; ?></td> 
                    <td><?php echo $row->sub_total; ?></td>
                    <td><?php echo $row->discount_amount; ?></td>   
                    <td class="text-right">Nrs. <?php echo $row->grand_total; $total_sales = $total_sales+$row->grand_total; ?></td>                  
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url();?>admin/sale/showSales/<?php echo $row->id;?>"><i class="fa fa-edit tooltips" data-original-title="View Details"></i> View Details</a>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                  ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>Total Sales</strong></td>   
                    <td class="text-right"><strong>Nrs. <?php echo $total_sales; ?></strong></td>                  
                    <td class="table-action text-center"></td>
                  </tr>
                  <?php
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Sales Found !!!</center></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
           <?php echo $this->pagination->create_links();?>
          </div><!-- col-md-6 -->
        </div>
      </div>
    </div>
    <!-- /.box -->
  </section>


<script>
  $(document).ready(function(){
    <?php if(!isset($_POST['sale_date'])){?>
      $('#sale_date').val(AD2BS("<?php echo date('Y-m-d');?>"));
    <?php } ?>

    $('#sale_date').nepaliDatePicker({
      ndpEnglishInput: 'sale_date'
    });

    $('#nepaliDateFrom').nepaliDatePicker({
      ndpEnglishInput: 'sale_date'
    });

    $('#nepaliDateTo').nepaliDatePicker({
      ndpEnglishInput: 'sale_date_to'
    });

  });
</script>
