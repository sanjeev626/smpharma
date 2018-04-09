<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">          
          <?php    
          $action = base_url() . 'admin/stock/listallinvoices/0';
          $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'name' => 'form1', 'enctype' => 'multipart/form-data');
          echo form_open($action, $attributes);
          ?>
          <div class="panel-footer">
            <a class="btn btn-success below_space" href="javascript:void(0);" onclick="form1.action='<?php echo base_url();?>admin/stock/listallinvoices/'+nepaliDateFrom.value+'/'+nepaliDateTo.value+'/'+supplier_id.value; form1.submit();"><i class="fa fa-list" data-original-title="View Basket"></i> List All </a>
            
            <div class="col-xs-3">
                <input type="text" name="invoice_date_from" id='nepaliDateFrom' class="form-control nepali-calendar" value='<?php if(isset($invoice_date_from) && !empty($invoice_date_from)) echo $invoice_date_from; ?>' placeholder="From Date" />
            </div>
            <div class="col-xs-3">
                <input type="text" name="invoice_date_to" id='nepaliDateTo' class="form-control nepali-calendar" value='<?php if(isset($invoice_date_to) && !empty($invoice_date_to)) echo $invoice_date_to; ?>' placeholder="Upto Date" />
            </div>
            <div class="col-xs-3">
                <select required="" class="form-control chosen-select" name="supplier_id" id="supplier_id" data-placeholder="Choose Activity">
                  <option value="0">All</option>
                  <?php foreach($supplier_list as $supplier){?>
                  <option value="<?php echo $supplier->id;?>" <?php if(isset($supplier_id) && $supplier_id>0 && $supplier_id==$supplier->id) echo "selected"; ?>><?php echo $supplier->fullname;?></option>
                  <?php } ?>
                </select>
            </div>

          </div>
          <?php echo form_close(); ?>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="2%">S.N</th>
                  <th width="18%">Date </th>
                  <th width="25%">Distributor </th>
                  <th width="10%">Invoice No. </th>
                  <th width="10%">Amount</th>
                  <th width="5%">Discount</th>
                  <th width="15%" class="text-right">Total Amount</th>
                  <th width="15%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total_before_discount = 0;
                $all_total_amount = 0;
                $total_discount = 0;
                if ($this->uri->segment(6) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(6) + 1;
                }
                if (!empty($invoice_info)) { 
                  $counter=0;
                  foreach ($invoice_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row->invoice_nepali_date.' / '.$row->invoice_eng_date; ?></td>
                    <td><?php echo $row->fullname; ?></td>
                    <td><?php echo $row->invoice_no; ?></td> 
                    <td class="text-right"><?php echo $row->total_amount; $total_before_discount = $total_before_discount+$row->total_amount; ?></td>
                    <td class="text-right"><?php echo $row->discount_amount;  $total_discount = $total_discount+$row->discount_amount;?></td>   
                    <td class="text-right">Nrs. <?php echo $row->grand_amount; $all_total_amount = $all_total_amount+$row->grand_amount; ?></td>                  
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url();?>admin/stock/editInvoice/<?php echo $row->id;?>"><i class="fa fa-edit tooltips" data-original-title="View Details"></i> View Details</a>
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
                    <td class="text-right"><strong><?php echo $total_before_discount; ?></strong></td>
                    <td class="text-right"><strong><?php echo $total_discount; ?></strong></td> 
                    <td class="text-right"><strong><?php echo $all_total_amount; ?></strong></td>                  
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
    <?php if(!isset($_POST['invoice_date'])){?>
      $('#invoice_date').val(AD2BS("<?php echo date('Y-m-d');?>"));
    <?php } ?>

    $('#invoice_date').nepaliDatePicker({
      ndpEnglishInput: 'invoice_date'
    });

    $('#nepaliDateFrom').nepaliDatePicker({
      ndpEnglishInput: 'invoice_date'
    });

    $('#nepaliDateTo').nepaliDatePicker({
      ndpEnglishInput: 'invoice_date_to'
    });

  });
</script>
