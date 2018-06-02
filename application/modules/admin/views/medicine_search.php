<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space" href="<?php echo base_url(); ?>admin/Medicine/add"><i class="fa fa-plus" data-original-title="View Basket"></i> Search </a>
            <div class="col-xs-10">
              <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for Medicine" />
            </div>
        </div>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="1%">S.N</th>
                  <th width="10%">Date</th>
                  <th width="5%">Invoice</th>
                  <th width="20%">Medicine Name </th>
                  <th width="5%">Quantity </th>
                  <th width="5%">Deal </th>
                  <th width="5%">Deal %</th>
                  <th width="5%">Rate </th>
                  <th width="25%">Supplier</th>
                  <th width="5%">Net Cost</th>
                  <th width="4%">Selling Price</th>
                  <th width="5%">Stock</th>
                  <th width="5%">Sales</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($medicine_info)) { 
                  $distributor_arr = array();
                  $distributor_name = array();
                  $distributor_cost = array();
                  $counter=0;
                  foreach ($medicine_info as $row):
                  //echo $key->ordering;
                    ++$counter;
                  $percentage_discount = round($row->discount_amount*100/$row->total_amount,2);
                  $net_cost = round($row->cp_per_unit-$percentage_discount*$row->cp_per_unit/100,2);
                    ?>
                  <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row->invoice_nepali_date; ?></td>
                    <td><?php echo $row->invoice_no; ?></td>
                    <td><?php echo $row->medicine_name; ?></td>
                    <td><?php echo $row->quantity; ?></td>
                    <td><?php echo $row->deal; ?></td>
                    <td><?php if($row->quantity>0) echo round($row->deal*100/$row->quantity,2).'%'; ?></td>
                    <td><?php echo $row->rate; ?></td>
                    <td><?php echo $row->fullname; ?></td>
                    <td><?php echo $net_cost; ?></td>  
                    <td><?php echo $row->sp_per_unit; ?></td>
                    <td><?php echo $row->stock; ?></td>
                    <td><?php echo $row->sales; ?></td>
                  </tr>
                  <?php
                  //if(!in_array($row->fullname,$distributor_name))
                  {
                    $distributor_arr[] = array('distributor_name'=>$row->fullname,'distributor_cost'=>$net_cost,'address'=>$row->address,'landline'=>$row->landline,'mobile'=>$row->mobile,'invoice_nepali_date'=>$row->invoice_nepali_date);
                  }
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Medicine Found !!!</center></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="13">
                      <strong>Order Hirarchy</strong><br>
                      <?php
                      //asort($distributor_arr);
                      //print_r($distributor_name);
                      //print_r($distributor_arr);
                      foreach ($distributor_arr as $key => $row) {
                          $distributor_cost[$key] = $row['distributor_cost'];
                      }

                      // Sort the data with volume descending, edition ascending
                      // Add $data as the last parameter, to sort by the common key
                      array_multisort($distributor_cost, SORT_ASC, $distributor_arr);
                      //print_r($distributor_arr);
                      ?>
                      <table class="table table-hover" id="table1" cellspacing="0" width="100%">
                        <tr>
                          <th width="1%">Priority</th>
                          <th width="10%">Date</th>
                          <th width="20%">Distributor</th>
                          <th width="5%">Cost</th>
                          <th width="20%">Address</th>
                          <th width="20%">Contact</th>
                          <th width="10%">Mobile </th>
                        </tr>
                      <?php
                      foreach ($distributor_arr as $key => $row) {
                          $n = $key+1;
                      ?>
                        <tr>
                          <td><?php echo $n;?></td>
                          <td><?php echo $row['invoice_nepali_date'];?></td>
                          <td><?php echo $row['distributor_name'];?></td>
                          <td><?php echo $row['distributor_cost'];?></td>
                          <td><?php echo $row['address'];?></td>
                          <td><?php echo $row['landline'];?></td>
                          <td><?php if($row['mobile']>0) echo $row['mobile'];?></td>
                        </tr>
                      <?php
                      }
                      /*for($i=0; $i<count($distributor_arr); $i++) {
                        echo $distributor_arr['distributor_name'][$i].' -->'.$distributor_arr['distributor_cost'][$i].'<br>';
                      }*/
                      ?>
                    </table>
                    </td>
                  </tr>
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


  <!-- Delete Modal -->
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title green">Are you sure to delete this Medicine ?</h4>
        </div>
        <div class="modal-body center">
           
          <a class="btn btn-success get_link" href="">Yes</a>
          &nbsp; | &nbsp; 
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <?php
    $get_medicines_path = "search_medicines";
    if($medicine_id>0)
      $get_medicines_path = "../search_medicines";
  ?>
  <script type="text/javascript">
    $('document').ready(function(){
      $('.delete_Medicine').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "<?php echo $get_medicines_path;?>",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>