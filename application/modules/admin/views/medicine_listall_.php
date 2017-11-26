<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">


      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space" href="<?php echo base_url(); ?>admin/Medicine/add"><i class="fa fa-plus" data-original-title="View Basket"></i> Add Medicine </a>

        </div>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="1%">Ordering</th>
                  <th width="30%">Medicine Name </th>
                  <th width="25%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($this->uri->segment(3) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(3) + 1;
                }
                if (!empty($Medicine)) { 
                  foreach ($Medicine as $key):
                    ?>
                  <tr>
                    <td><?php echo $key->ordering; ?></td>
                    <td><?php echo $key->title; ?></td>
                    
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Medicine/edit/<?php echo $key->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Medicine"></i> Edit</a>
                      |
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Package/listAll/<?php echo $key->id; ?>"><i class="fa fa-file-text-o tooltips" data-original-title="Job List"></i> Package List</a>
                      |
                      <button type="button" class="btn btn-success btn-sm delete_Medicine" link="<?php echo base_url(); ?>admin/Medicine/deleteMedicine/<?php echo $key->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Medicine"></i> Delete</button>
                    </td>
                  </tr>
                  <?php
                  $i++;
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
          <h4 class="modal-title green">Are you sure to Delete a Medicine ?</h4>
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
    });
  </script>