 <footer class="main-footer">
    <strong>Copyright © <?php echo date('Y ');?>S M PHARMA, KALIMATI.</strong>  All rights reserved.
  </footer>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>/content_admin/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>/content_admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/content_admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- FastClick -->
<!--delete button pop up-->
<script src="<?php echo base_url();?>/content_admin/common.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>/content_admin/popup-box.css">

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/content_admin/dist/js/app.min.js"></script>

<script src="<?php echo base_url();?>/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>content_admin/bootstrapValidator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>/content_admin/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
            $('document').ready(function() {

                //-----------Datepicker------------------------------
                $('#datepicker').datetimepicker({
                   
                    format: 'YYYY-MM-DD'
                });

                //Date range picker
                $('#reservation1').daterangepicker({
                  autoUpdateInput: true,
                  locale: {
                      format: 'YYYY-MM-DD'
                    },
                    startDate: '2010-01-01',
                    endDate: '2018-1-1'
                });

                $('#reservation2').daterangepicker({
                  autoUpdateInput: true,
                  locale: {
                      format: 'YYYY-MM-DD'
                    },
                    startDate: '2010-01-01',
                    endDate: '2018-1-1'
                });

                // JobSeeker 
                $('#dob').daterangepicker({
                  autoUpdateInput: true,
                  locale: {
                      format: 'YYYY-MM-DD'
                    },
                    startDate: '1980-1-1',
                    endDate: '2017-1-1'
                });

                $('#seeker_date1').daterangepicker({
                  autoUpdateInput: true,
                  locale: {
                      format: 'YYYY-MM-DD'
                    },
                    startDate: '1980-1-1',
                    endDate: '2017-1-1'
                });

                $('#seeker_date2').daterangepicker({
                  autoUpdateInput: true,
                  locale: {
                      format: 'YYYY-MM-DD'
                    },
                    startDate: '1980-1-1',
                    endDate: '2017-1-1'
                });

                 /*---------------Simple TinyMce only---------------------*/
                 tinymce.init({
                    selector: ".simple", theme: "modern",  height: 200
                    
                });

                /*---------------------------- TINYMCE EDITOR ---------------------------*/
                tinymce.init({
                    selector: ".textarea_description", theme: "modern",height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                    ],
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
                    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
                    image_caption: true,
                    image_advtab: true,
                    relative_urls: false,
                    external_filemanager_path: "http://localhost:8011/globaljobs/globaljob/" + "tinymce/file_manager/filemanager/",
                    filemanager_title: "Responsive Filemanager",
                    external_plugins: {"filemanager": "http://localhost:8011/globaljobs/globaljob/" + "tinymce/file_manager/filemanager/plugin.min.js"}
                });
            });
        </script>
      
<style type="text/css">
  .fancybox-inner{ height: 500px; !important }
</style>
</body>
</html>
