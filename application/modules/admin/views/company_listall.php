<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">


      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space" href="<?php echo base_url(); ?>admin/Company/add"><i class="fa fa-plus" data-original-title="View Basket"></i> Add Company </a>
            <div class="col-xs-10">
              <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for Company" />
            </div>
        </div>
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="1%">S.N</th>
                  <th width="30%">Company Name </th>
                  <th width="35%">Address</th>
                  <th width="10%">Contact number</th>
                  <th width="20%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($this->uri->segment(3) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(3) + 1;
                }
                if (!empty($company_info)) { 
                  $counter=0;
                  foreach ($company_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                    ++$counter;
                    ?>
                  <tr>
                    <td><?php echo $page+$counter; ?></td>
                    <td><?php echo $row->fullname; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->landline; if(!empty($row->mobile)) echo ' / '.$row->mobile; ?></td>
                    
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Company/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Activity"></i> Edit</a>
                      |
                      <button type="button" class="btn btn-success btn-sm delete_Activity" link="<?php echo base_url(); ?>admin/Company/deleteCompany/<?php echo $row->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Activity"></i> Delete</button>
                    </td>
                  </tr>
                  <?php
                  $i++;
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
          <h4 class="modal-title green">Are you sure to delete this Company ?</h4>
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
      $('.delete_Activity').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "Company/get_companies",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>