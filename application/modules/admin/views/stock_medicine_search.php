<?php
//print_r($stockMedicine);
?>
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-12">
            <div class="panel-footer">
            <a class="btn btn-success below_space"></a>
            <div class="col-xs-10">
              <input type="text" name="search" id='search' class="form-control" value='' placeholder="Search for Medicine or invoice no. or distributor" />
            </div>
          </div>
        <div class="table-responsive">  
        <table class="table table-hover" id="table1" cellspacing="0" width="100%">     
        <tr>
          <th width="15%">Distributor</th>    
          <th width="7%">Invoice No</th>  
          <th width="7%">Recieved Date</th>
          <th width="10%">Item description</th>
          <th>Pack(No. of tab)</th>
          <th width="5%">Batch No</th>
          <th>Expiry Date</th>
          <th>Qty</th>
          <th>CC/Rate</th>
          <th>SP</th>
          <th width="3%">Deal</th>
          <th width="3%">Deal%</th>
          <th>Stock</th>
          <th>Sales</th>
          <th>Total price</th>
          <th>Options</th>         
        </tr>
        <?php 
        $total_stock = 0;
        $total_sales = 0;
        if (!empty($stockMedicine)) { 
        $counter=0;
        foreach ($stockMedicine as $row):
        $id=$row->id;
        $creditmemo_id=$row->creditmemo_id;
        $medicine_name=$row->item_description;
        ?>
        <tr>
          <td><?php echo $row->fullname;?></td>
          <td><?php echo $row->invoice_no;?></td>
          <td><?php echo $result1=date('d-m-Y',strtotime($row->invoice_eng_date));?></td>
          <td><?php echo $medicine_name;?></td>
          <td><?php echo $row->pack;?></td>
          <td><?php echo $row->batch_number;?></td>
          <td><?php echo date('d-m-Y',strtotime($row->expiry_date));?></td>
          <td><?php echo $row->quantity;?></td>
          <td><?php echo $row->rate;?></td>
          <td><?php echo $row->sp_per_unit;?></td>
          <td><?php echo $row->deal;?></td>
          <td><?php echo $row->deal_percentage;?></td>
          <td><?php echo $row->stock; $total_stock = $total_stock+$row->stock; ?></td>
          <td><?php echo $row->sales; $total_sales = $total_sales+$row->sales; ?></td>
          <?php $roudnum=$row->total_price;?>
          <td><?php echo round($roudnum,2);?></td>          
          <td><a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/Stock/stockReturn/<?php echo $row->id; ?>" title="Return"><i class="fa fa-reply tooltips" data-original-title="Return"></i></a>
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
          <!-- col-md-6 -->
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
        source: "../get_stocks",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>