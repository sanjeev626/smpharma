<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space" href="<?php echo base_url(); ?>admin/stock/add"><i class="fa fa-plus" data-original-title="View Basket"></i> Add Stock </a>
            <div class="col-xs-10">
              <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for Medicine or invoice no. or distributor" />
            </div>
        </div>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="1%">Ordering</th>
                  <th width="30%">Medicine Name </th>
                  <th width="10%">Expiry Date</th>
                  <th width="10%">Balance Stock</th>
                  <th width="10%">Rate</th>
                  <th width="10%">SP per unit</th>
                  <th width="19%" class="table-action text-center">Received From</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($stock_info)) { 
                  $counter=0;
                  foreach ($stock_info as $row):
                    //print_r($key);
                  //echo $key->ordering;two
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $page+$counter; ?></td>
                    <td><?php echo $row->item_description; ?></td>
                    <td><?php echo $row->expiry_date; ?></td>
                    <td><?php echo $row->stock-$row->sales; ?></td>
                    <td><?php echo $row->rate; ?></td>
                    <td><?php echo $row->sp_per_unit; ?></td>                    
                    <td class="table-action text-center"><?php echo $this->Stock_model->get_suppliername_by_stock_id($row->id);?></td>
                  </tr>
                  <?php
                  //$i++;
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Activity Found !!!</center></td>
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

  <script type="text/javascript">
    $('document').ready(function(){
      $('.delete_Medicine').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "Stock/get_stocks",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>