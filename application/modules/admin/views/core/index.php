   <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('index_subheading');?></h3>
              
              <?php if($message){ ?>
             <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <?php echo $message;?>
              </div> 
             <?php } ?> 
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <!--  <p><?php echo anchor('admin/auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('admin/auth/create_group', lang('index_create_group_link'))?> | <?php echo anchor('admin/auth/logout', lang('logout_heading'))?></p> --> 
           
               <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo lang('index_fname_th');?></th>
					<th><?php echo lang('index_lname_th');?></th>
					<th><?php echo lang('index_email_th');?></th>
					<th><?php echo lang('index_groups_th');?></th>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
<!--					<?php //echo anchor("admin/auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?> <br /> -->
                <?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ; ?><br />
                <?php endforeach?>
			</td>
<!--			<td><?php //echo ($user->active) ? anchor("admin/auth/deactivate/".$user->id, lang('index_active_link')) : anchor("admin/auth/activate/". $user->id, lang('index_inactive_link'));?></td>-->
            <td><?php echo ($user->active) ? lang('index_active_link') :  lang('index_inactive_link');?></td>
			<td><?php echo anchor("admin/auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
               
               </tbody>
                <tfoot>
                
                </tfoot>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
  </div>
  <!-- /.content-wrapper -->




