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
                  <th width="5%">Quantity </th>
                  <th width="25%">Medicine Name </th>
                  <th width="25%">Supplier</th>
                  <th width="10%">Net Cost</th>
                  <th width="10%">Selling</th>
                  <th width="9%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($medicine_info)) { 
                  $counter=0;
                  $total_stock=0;
                  foreach ($medicine_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row->invoice_nepali_date; ?></td>
                    <td><?php echo $row->invoice_no; ?></td>
                    <td><?php echo $row->stock; $total_stock+=$row->stock; ?></td>
                    <td><?php echo $row->medicine_name; ?></td>
                    <td><?php echo $row->fullname; ?></td>
                    <td><?php echo $row->cp_per_unit; ?></td>  
                    <td><?php echo $row->sp_per_unit; ?></td>                    
                    <td class="table-action text-center"></td>
                  </tr>
                  <?php
                  endforeach;
                  ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $total_stock; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>                    
                    <td></td>
                  </tr>
                  <?php
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
<?php echo FCPATH;?>
  <script type="text/javascript">
    $('document').ready(function(){
      $('.delete_Medicine').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "search_medicines",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>