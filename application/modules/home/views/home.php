<?php
echo "COMING SOON . . . ";
exit();
?>
<div class="col-md-9">
    <div class="row">
        <div class="col-md-4">
            <?php if(!empty($premium_job)){ ?>
            <section id="vertical-horizontal-scrollbar-demo" class="hunting-job premium-hunting-job default-skin demo clearfix">
                <h2><a href="<?php echo base_url().'premium_jobs';?>" style="color:#81b524;">PREMIUM JOBS</a></h2>
                <?php $this->load->view('home-premium-job');?>
            </section>
               <?php } ?>
                                

            <div class="left-aside clearfix">
                <h2><a href="<?php echo base_url().'corporate_jobs';?>" style="color:#81b524;">CORPORATE JOBS</a></h2>
                <?php $this->load->view('home-corporate-job');?>
            </div>   
            </div>
          <!-- left-aside end -->

          <!-- Mid aside start -->
            <div class="col-md-8">
            <div class="contain-bar">
            <!-- Carousel ================================================== -->
            <?php if(!empty($sliders)): ?>
            <div id="myCarousel" class="home-carousel carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">

                    <?php foreach($sliders as $key => $sval):
                    ?>
                    <div class="item <?php if($key == '0'){ echo 'active'; } ?>">
                    <?php
                        $link = ($sval->link) ? $sval->link : 'javascript:void(0)';
                    ?>
                    	<a target="_blank" href="<?php echo $link; ?>">
                            <img class="first-slide" src="<?php echo base_url();?>uploads/slider/<?php echo $sval->sliderimage; ?>" alt="First slide">
                        </a>
                    </div>
                   <?php endforeach; ?>
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        <?php endif; ?>
<!-- /.carousel -->

               <section class="mid-tab clearfix">
                    <div class="row">
                        <div class="col-md-9">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#menu1">Featured posting</a></li>
                                <li><a data-toggle="tab" href="#menu2">News Paper Jobs</a></li>
                                <li><a data-toggle="tab" href="#menu3">Recently Posted Jobs</a></li>
                            </ul>

                            <div class="tab-content clearfix">

                                <div id="menu1" class="tab-pane fade in active">
                                <?php if(!empty($featured_job)){ ?>
                                    <div class="row" style="column-count:2">
                                    <?php
                                            foreach ($featured_job as $key => $rjval) {
                                                  $applyBefore = $rjval->applybefore;
                                                  $d = new DateTime($applyBefore);
                                                  $day_left =  $d->diff(new DateTime())->format('%a');
                                    ?>

                                        <div class="p-space <?php if($key <= 2){echo 'divider'; } ?>">
                                            <div class="menu1-item">
                                                <p><?php echo $rjval->displayname;?></p>
                                                <a href="<?php echo base_url();?>job/<?php echo $rjval->slug; ?>/<?php echo $rjval->id; ?>"> <strong><?php echo $rjval->jobtitle;?></strong></a>
                                                <p><?php echo $day_left; ?> days left
                                                    <a class="apply" href="<?php echo base_url();?>applyJob/<?php echo $rjval->id;?>">[ apply ]</a></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <?php }?>
                                    </div>
                                    <a class="view-all pull-right" href="<?php echo base_url();?>viewJobsType/FJob"> view all ...</a>    
                                    <?php }else{?>
                                    <span>No Featured Job Found !!! </span>
                                    <?php } ?>
                                </div>   <!-- TAB 1 -->

                               <div id="menu2" class="tab-pane fade">
                                    <?php if(!empty($newspaper_job)){ ?>
                                    <div class="row" style="column-count:2">
                                    <?php
                                            foreach ($newspaper_job as $key => $rjval) {
                                                  $applyBefore = $rjval->applybefore;
                                                  $d = new DateTime($applyBefore);
                                                  $day_left =  $d->diff(new DateTime())->format('%a');
                                    ?>

                                        <div class=" p-space <?php if($key <= 2){echo 'divider'; } ?>">
                                            <div class="menu1-item">
                                                <p><?php echo $rjval->displayname;?></p>
                                                <a href="<?php echo base_url();?>job/<?php echo $rjval->slug; ?>/<?php echo $rjval->id; ?>"> <strong><?php echo $rjval->jobtitle;?></strong></a>
                                                <p><?php echo $day_left; ?> days left
                                                    <a class="apply" href="<?php echo base_url();?>applyJob/<?php echo $rjval->id;?>">[ apply ]</a></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <?php }?>
                                    </div>
                                    <a class="view-all pull-right" href="<?php echo base_url();?>viewJobsType/FJob"> view all ...</a>    
                                    <?php }else{?>
                                    <span>No Featured Job Found !!! </span>
                                    <?php } ?>
                                </div>   <!-- TAB 2 -->

                               <div id="menu3" class="tab-pane fade">
                                    <?php if(!empty($recent_job)){ ?>
                                    <div class="row" style="column-count:2">
                                    <?php
                                            foreach ($recent_job as $key => $rjval) {
                                                  $applyBefore = $rjval->applybefore;
                                                  $d = new DateTime($applyBefore);
                                                  $day_left =  $d->diff(new DateTime())->format('%a');
                                    ?>

                                        <div class=" p-space <?php if($key <= 2){echo 'divider'; } ?>">
                                            <div class="menu1-item">
                                                <p><?php echo $rjval->displayname;?></p>
                                                <a href="<?php echo base_url();?>job/<?php echo $rjval->slug; ?>/<?php echo $rjval->id; ?>"> <strong><?php echo $rjval->jobtitle;?></strong></a>
                                                <p><?php echo $day_left; ?> days left
                                                    <a class="apply" href="<?php echo base_url();?>applyJob/<?php echo $rjval->id;?>">[ apply ]</a></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <?php }?>
                                    </div>
                                    <a class="view-all pull-right" href="<?php echo base_url();?>viewJobsType/FJob"> view all ...</a>    
                                    <?php }else{?>
                                    <span>No Featured Job Found !!! </span>
                                    <?php } ?>
                                </div>   <!-- TAB 3 -->                                                            

                            </div>   <!-- TAB-CONTENT -->                                              
                        </div> <!-- COL-MD-8 -->

                 <div class="col-md-3 adsec">
                     <div class="row">
                     <?php if($middle_banner):
                            foreach($middle_banner as $key => $mbval): ?>
                        <div class="item col-xs-6 col-sm-6 col-md-12">
                            <div class="ads">
                        <a target="_blank" href="<?php echo $mbval->link;?>"><img src="<?php echo base_url();?>uploads/slider/<?php echo $mbval->sliderimage; ?>" alt="<?php echo $mbval->title;?>"></a> 
                             </div>
                        </div>
                     <?php endforeach; endif; ?>                                                 
                    </div>
                </div>
            </div>  <!-- ROW -->                                      
        </section>

<section class="top-jobs clearfix">
  <h2><a href="<?php echo base_url().'top_jobs';?>" style="color:#81b524;">TOP JOBS</a></h2>
  <?php $this->load->view('home-top-job');?>    
</section>
</div>
</div>
</div>


<!--Job list start -->
<?php $this->load->view('job-by-section');?> 
<!--Job list end -->
    
    <script type="text/javascript">
    $(window).load(function () {
        //$(".demo1").customScrollbar();
      //  $(".demo101").customScrollbar();
      //  $("#vertical-horizontal-scrollbar-demo").customScrollbar();
    //    $("#vertical-horizontal-scrollbar-demo1").customScrollbar();
        
        $('#scrollbox3').enscroll({
            showOnHover: true,
            verticalTrackClass: 'track3',
            verticalHandleClass: 'handle3'
        });
        
         $('#scrollbox4').enscroll({
            showOnHover: true,
            verticalTrackClass: 'track4',
            verticalHandleClass: 'handle4'
        });
        
      
    });
    </script>
