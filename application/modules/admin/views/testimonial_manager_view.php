<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">


      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success" href="<?php echo base_url(); ?>admin/Testimonial/add">+ Add Testimonial </a>
        </div>
          <div class="table-responsive">
            <table class="table table-striped mb30" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="5%">SN.</th>
                  <th width="20%">Name </th>
                  <th width="20%">Company Name</th>
                  <th width="10%">Image</th>
                  <th width="15%" class="table-action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($this->uri->segment(3) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(3) + 1;
                }
                if (!empty($testimonial)) {
                  foreach ($testimonial as $key):
                    ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $key->name; ?></td>
                      <td><?php echo $key->company_name; ?></td>
                      <td><img src="<?php echo the_testimonial_image($key->image);?>" style="width: 70px;height: auto;"></td>
                    <td class="table-action">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Testimonial/edit/<?php echo $key->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Testimonial"></i> Edit</a>
                      |
                      <button type="button" class="btn btn-success btn-sm delete_testimonial" link="<?php echo base_url(); ?>admin/Testimonial/deleteTestimonial/<?php echo $key->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Testimonial"></i> Delete</button>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Testimonial Found !!!</center></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->

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
          <h4 class="modal-title green">Are you sure to Delete a Testimonial ?</h4>
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
      $('.delete_testimonial').on('click',function(){
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link);

      });
    });
  </script>
