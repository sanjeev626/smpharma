<style>
th{
  padding-right: 5px !important;
}
</style>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <input type="text" name="search" id='search' class="form-control" value='<?php echo $searchKeyword;?>' placeholder="Search for Medicine or invoice no. or distributor" />
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">            
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">                      
                      <th>Distributor</th>    
                      <th style="width:3%;">Invoice No</th>  
                      <th>Recieved Date</th>
                      <th>Item description</th>
                      <th>Pack</th>
                      <th>Batch No</th>
                      <th>Expiry Date</th>
                      <th>Qty</th>
                      <th>CC/Rate</th>
                      <th>SP</th>
                      <th>Deal</th>
                      <th>Stock</th>
                      <th>Sales</th>
                      <th>Total price</th>
                      <th style="width:75px;">Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $total_stock = 0;
                    $total_sales = 0;
                    if (!empty($stockSearch)) { 
                    $counter=0;
                    foreach ($stockSearch as $row):
                    $id=$row->id;
                    $creditmemo_id=$row->creditmemo_id;
                    $medicine_name=$row->item_description;
                    ?>
                    <tr>
                      <td><?php echo $row->fullname;?></td>
                      <td><?php echo $row->invoice_no;?></td>
                      <td>
                        <?php 
                        echo date('d-m-Y',strtotime($row->invoice_eng_date));
                        echo "<br>";
                        $ind = explode('-',$row->invoice_nepali_date);
                        echo $ind['2'].'-'.$ind['1'].'-'.$ind['0'];
                        ?>
                      </td>
                      <td><?php echo $medicine_name;?></td>
                      <td><?php echo $row->pack;?></td>
                      <td><?php echo $row->batch_number;?></td>
                      <td><?php echo date('d-m-Y',strtotime($row->expiry_date));?></td>
                      <td><?php echo $row->quantity;?></td>
                      <td><?php echo $row->rate;?></td>
                      <td><?php echo $row->sp_per_unit;?></td>
                      <td><?php echo $row->deal;?></td>
                      <td><?php echo $row->stock; $total_stock = $total_stock+$row->stock; ?></td>
                      <td><?php echo $row->sales; $total_sales = $total_sales+$row->sales; ?></td>
                      <?php $roudnum=$row->total_price;?>
                      <td><?php echo round($roudnum,2);?></td>          
                      <td>
                        <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Stock/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Activity"></i></a>
                        <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Stock/stockReturn/<?php echo $row->id; ?>" title="Return"><i class="fa fa-reply tooltips" data-original-title="Return"></i></a>
                      </td>
                    </tr>
                    <?php     
                    endforeach;
                    ?>
                    <tr>
                      <td colspan="12">&nbsp;</td>
                      <td><?php echo $total_stock;?></td>
                      <td><?php echo $total_sales;?></td>
                      <td><?php echo $total_stock-$total_sales;?></td>     
                      <td>&nbsp;</td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
              </div>
              <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  <ul class="pagination">
                    <li class="paginate_button previous disabled" id="example1_previous"><a href="#" data-dt-idx="0" tabindex="0">Previous</a></li>
                    <li class="paginate_button active"><a href="#" data-dt-idx="1" tabindex="0">1</a></li>
                    <li class="paginate_button "><a href="#" data-dt-idx="2" tabindex="0">2</a></li>
                    <li class="paginate_button "><a href="#" data-dt-idx="3" tabindex="0">3</a></li>
                    <li class="paginate_button "><a href="#" data-dt-idx="4" tabindex="0">4</a></li>
                    <li class="paginate_button "><a href="#" data-dt-idx="5" tabindex="0">5</a></li>
                    <li class="paginate_button "><a href="#" data-dt-idx="6" tabindex="0">6</a></li>
                    <li class="paginate_button next" id="example1_next"><a href="#" data-dt-idx="7" tabindex="0">Next</a></li>
                  </ul>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        <!-- /.box-body --> 
      </div>
      <!-- /.box --> 
    </div>
    <!-- /.col --> 
  </div>
  <!-- /.row -->
</section>
<script type="text/javascript">
  $('document').ready(function(){
    $('.delete_Medicine').on('click',function(){ 
      var link  = $(this).attr('link');
      $('.get_link').attr('href',link); 

    });
    
    $("#search").autocomplete({
      source: "../get_stocks",
          minLength: 1,
          select: function (e, ui) {
              location.href = ui.item.the_link;
          }
    });
  });
</script>