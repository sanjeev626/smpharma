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
                  <th width="1%">Ordering</th>
                  <th width="10%">Date</th>
                  <th width="20%">Medicine Name </th>
                  <th width="5%">Quantity </th>
                  <th width="5%">Deal </th>
                  <th width="5%">Deal Percentage</th>
                  <th width="5%">Rate </th>
                  <th width="20%">Supplier</th>
                  <th width="15%">Net Cost</th>
                  <th width="15%">Selling Price</th>
                  <th width="4%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($medicine_info)) { 
                  $counter=0;
                  foreach ($medicine_info as $row):
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row->invoice_nepali_date; ?></td>
                    <td><?php echo $row->medicine_name; ?></td>
                    <td><?php echo $row->quantity; ?></td>
                    <td><?php echo $row->deal; ?></td>
                    <td><?php if($row->quantity>0) echo round($row->deal*100/$row->quantity,2).'%'; ?></td>
                    <td><?php echo $row->rate; ?></td>
                    <td><?php echo $row->fullname; ?></td>
                    <td><?php echo $row->cp_per_unit; ?></td>  
                    <td><?php echo $row->sp_per_unit; ?></td>                    
                    <td class="table-action text-center"></td>
                  </tr>
                  <?php
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Medicine Found !!!</center></td>
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