<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space" href="<?php echo base_url(); ?>admin/sale/ListSale"><i class="fa fa-plus" data-original-title="View Basket"></i> List Sales </a>
            <div class="col-xs-10">
                <input type="text" required name="sale_date" id='sale_date' class="form-control" value='<?php if(isset($sale_date) && !empty($sale_date)) echo $sale_date; else echo date('Y-m-d'); ?>' />
            </div>
        </div>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="2%">S.N</th>
                  <th width="30%">Date </th>
                  <th width="25%">Amount</th>
                  <th width="15%">Discount</th>
                  <th width="10%">Total Amount</th>
                  <th width="18%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total_sales = 0;
                if ($this->uri->segment(3) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(3) + 1;
                }
                if (!empty($sales_info)) { 
                  $counter=0;
                  foreach ($sales_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $page+$counter; ?></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->total_amount; ?></td>
                    <td><?php echo $row->discount_amount; ?></td>   
                    <td><?php echo $row->net_amount; $total_sales = $total_sales+$row->net_amount; ?></td>                  
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="javascript:void(0);"><i class="fa fa-edit tooltips" data-original-title="View Details"></i> View Details</a>
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
                    <td>Total Sales</td>   
                    <td><?php echo $total_sales; ?></td>                  
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

<script type="text/javascript">
  $('document').ready(function(){
    $( "#sale_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
