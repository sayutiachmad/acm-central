<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact nav-flat" data-widget="treeview" role="menu" data-accordion="false">
	<!-- Add icons to the links using the .nav-icon class
		 with font-awesome or any other icon font library -->

	<?php foreach ($navigation as $key => $value) { ?>
		<?php if($value['child_count']>0){ ?>
            <?php if($value['parent']==0){ ?>

				<li class="nav-item has-treeview nav-top-item">
				  	<a href="javascript:;" class="nav-link nav-lv1">
						<i class="nav-icon <?php echo $value['icon'];?>"></i>
						<p>
					  		<?php echo $value['navigation_name'];?>
					  		<i class="nav-icon right fas fa-angle-left"></i>
						</p>
				  	</a>
				  	<ul class="nav nav-treeview">
				  		<?php foreach ($navigation as $key_sub => $value_sub) { ?>
					  	    <?php if($value['id_navigation']==$value_sub['parent']){ ?>
								<li class="<?php echo ($value_sub['child_count']>0 ?'has-treeview':'');?> nav-item">
								  	<a  href="<?php echo ($value_sub['child_count'] == 0 ? base_url($value_sub['link']) : "javascript:;");?>" class="nav-link nav-lv2">
										<i class="nav-icon fas fa-circle nav-icon"></i>
										<p> 
											<?php echo $value_sub['navigation_name'];?>
											<?php if($value_sub['child_count']>0){ ?>
										   		<i class="nav-icon right fas fa-angle-left"></i>
											<?php } ?>		
										</p>
								  	</a>

								  	<?php if($value_sub['child_count']>0){ ?>
								    	<ul class="nav nav-treeview">
								  	<?php }?>
								  		<?php foreach ($navigation as $key_sub2 => $value_sub2) { ?>
								  		  	<?php if($value_sub['id_navigation']==$value_sub2['parent']){ ?>
												<li class="nav-item">
												  <a  href="<?php echo base_url($value_sub2['link']);?>" class="nav-link nav-lv3">
													<i class="nav-icon far fa-circle nav-icon"></i>
													<p><?php echo $value_sub2['navigation_name'];?></p>
												  </a>
												</li>
											<?php } ?>
	                                  	<?php } ?>
									<?php if($value_sub['child_count']>0){ ?>
								    	</ul>
								  	<?php }?>
 	
								</li>
							<?php } ?>
                      	<?php } ?>
					</ul>
				</li>
			<?php } ?>
        <?php }else{ ?>
        	<?php if($value['parent']==0){ ?>
	    		<li class="nav-item">
	    		  <a href="<?php echo base_url($value['link']);?>" class="nav-link nav-lv1">
	    			<i class="nav-icon <?php echo $value['icon'];?>"></i>
	    			<p>
	    			  <?php echo $value['navigation_name'];?>
	    			  
	    			</p>
	    		  </a>
	    		</li>
	    	<?php  } ?>
        <?php } ?>
    <?php } ?>

  </ul>
</nav>