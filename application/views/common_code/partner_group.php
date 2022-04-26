
<div class="row">
  <!-- Tree------ -->
	<div class="col-sm-4 col-12">
      <div class="card card-outline card-olive">
        <div class="card-body" >
          <div id="tree" style="overflow-x: auto;height: 400px;">

            <ul>
              <?php foreach ($item_group as $itg_1) { ?>

              		<?php if($itg_1[FIELD_COMMON_CODE_PARENT]==0 && $itg_1[FIELD_COMMON_CODE_HEAD]=="PSG"){ ?>
                
	                  <li data-jstree='{ "opened" : true}' child_level="0" data_parent="<?php echo $itg_1[FIELD_COMMON_CODE_PARENT];?>" data_head="<?php echo $itg_1[FIELD_COMMON_CODE_HEAD];?>" data_name="<?php echo $itg_1[FIELD_COMMON_CODE_NAME];?>">

	                    <strong><?php echo $itg_1[FIELD_COMMON_CODE_NAME];?></strong>

	                    <?php if($itg_1['total_child']>0){ ?>

		                  	<ul>
		                  		
		                  		<?php foreach ($item_group as $itg_2) { ?>
		                  			
		                  			<?php if($itg_2[FIELD_COMMON_CODE_PARENT] == $itg_1[FIELD_COMMON_CODE_HEAD] && $itg_2[FIELD_COMMON_CODE_DESCRIPTION_3]=="PSG"){ ?>

		                  				<li data-jstree='{ "opened" : true}' child_level="1" data_parent="<?php echo $itg_2[FIELD_COMMON_CODE_PARENT];?>" data_head="<?php echo $itg_2[FIELD_COMMON_CODE_HEAD];?>" data_name="<?php echo $itg_2[FIELD_COMMON_CODE_NAME];?>">
		                  					<?php echo $itg_2[FIELD_COMMON_CODE_HEAD]." - ".$itg_2[FIELD_COMMON_CODE_NAME];?>
		                  				

		                  					<?php if($itg_2['total_child']>0){ ?>

		                  						<ul>
		                  							
		                  							<?php foreach ($item_group as $itg_3) { ?>
		                  								
		                  								<?php if($itg_3[FIELD_COMMON_CODE_PARENT] == $itg_2[FIELD_COMMON_CODE_HEAD] && $itg_3[FIELD_COMMON_CODE_DESCRIPTION_3]=="PSG"){ ?>

		                  									<li data-jstree='{ "opened" : true}' child_level="2" data_parent="<?php echo $itg_3[FIELD_COMMON_CODE_PARENT];?>" data_head="<?php echo $itg_3[FIELD_COMMON_CODE_HEAD];?>" data_name="<?php echo $itg_3[FIELD_COMMON_CODE_NAME];?>">
		                  										<?php echo $itg_3[FIELD_COMMON_CODE_HEAD]." - ".$itg_3[FIELD_COMMON_CODE_NAME];?>

		                  										<?php if($itg_3['total_child']>0){ ?>

		                  											<ul>
		                  												
		                  												<?php foreach ($item_group as $itg_4) { ?>
		                  													
		                  													<?php if($itg_4[FIELD_COMMON_CODE_PARENT] == $itg_3[FIELD_COMMON_CODE_HEAD] && $itg_4[FIELD_COMMON_CODE_DESCRIPTION_3]=="PSG"){ ?>

		                  														<li data-jstree='{ "opened" : true}' child_level="3" data_parent="<?php echo $itg_4[FIELD_COMMON_CODE_PARENT];?>" data_head="<?php echo $itg_4[FIELD_COMMON_CODE_HEAD];?>" data_name="<?php echo $itg_4[FIELD_COMMON_CODE_NAME];?>">
		                  															<?php echo $itg_4[FIELD_COMMON_CODE_HEAD]." - ".$itg_4[FIELD_COMMON_CODE_NAME];?>
		                  														</li>

		                  													<?php } ?>

		                  												<?php } ?>

		                  											</ul>

		                  										<?php } ?>

		                  									</li>

		                  								<?php } ?>

		                  							<?php } ?>

		                  						</ul>

		                  					<?php } ?>

		                  				</li>

		                  			<?php } ?>

		                  		<?php } ?>

		                  	</ul>

	                  	<?php } ?>

	                  </li>
        			
        			<?php } ?>
                  
              <?php } ?>

            </ul>

          </div>
	      <div class="divider"></div>
          <a href="javascript:;" class="btn btn-xs btn-info float-right disabled" id="edit_data" disabled><i class="fas fa-pencil-alt"></i> Ubah Data</a>
          <a href="javascript:;" class="btn btn-xs btn-primary float-right disabled" id="add_child" style="margin-right: 5px;" disabled><i class="fas fa-plus"></i> Tambah Child</a>
        </div>
      </div>
  </div>
  
<!-- Tree------ -->

  <div class="col-sm-8 col-12">
  	<div class="card card-outline card-olive">
  		<div class="card-header">
  			<h2 class="card-title">Form Item Group <span id="sub_title"></span></h2>
  			<div class="clearfix"></div>
  		</div>
  		<div class="card-body">
  			<form class="form-horizontal" id="mp_form" method="POST">
  			    <div class="modal-body">
  			            <div class="row clearfix">
  			              <div id="alert_modal" class="alert bg-red alert-dismissible" role="alert" style="display: none;">
  			                <i class="fa fa-exclamation-triangle"></i> <span id="alert_msg"></span>
  			              </div>
  			            </div>

  			            <div class="row clearfix">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Parent</label>
  			                </div>
  			                <div class="col-12 col-md-2">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <div class="form-line">
  			                                <input type="text" name="cc_parent_" class="form-control" readonly>
  			                            </div>
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="email_address_2">Code</label>
  			                </div>
  			                <div class="col-12 col-md-2">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_det_code_" class="form-control" placeholder="Code" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="email_address_2">Code Name</label>
  			                </div>
  			                <div class="col-12 col-md-7">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_code_name_" class="form-control" placeholder="Code Name" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Description 1</label>
  			                </div>
  			                <div class="col-12 col-md-8">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_desc_1_" class="form-control" placeholder="Description" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix" style="display: none;">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Description 2</label>
  			                </div>
  			                <div class="col-12 col-md-8">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_desc_2_" class="form-control" placeholder="Description" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix" style="display: none;">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Description 3</label>
  			                </div>
  			                <div class="col-12 col-md-8">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_desc_3_" class="form-control" placeholder="Description" autocomplete="false" readonly value="PSG">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix" style="display: none;">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Amount 1</label>
  			                </div>
  			                <div class="col-12 col-md-8">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_amt_1_" class="form-control" placeholder="Amount" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix" style="display: none;">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Amount 2</label>
  			                </div>
  			                <div class="col-12 col-md-8">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_amt_2_" class="form-control" placeholder="Amount" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <div class="row clearfix" style="display: none;">
  			                <div class="col-12 col-md-3 control-label">
  			                    <label for="password_2">Amount 3</label>
  			                </div>
  			                <div class="col-12 col-md-8">
  			                    <div class="form-group">
  			                        <div class="form-line">
  			                            <input type="text" name="cc_amt_3_" class="form-control" placeholder="Amount" autocomplete="false">
  			                        </div>
  			                    </div>
  			                </div>
  			            </div>

  			            <input type="hidden" name="edit" value="0">
  			            <input type="hidden" name="cc_code_" value="">

  			    </div>
  			    <div class="modal-footer">

  			        <button type="submit" class="btn btn-primary " id="btn_submit"><i class="fas fa-save"></i> Simpan</button>
  			        <button type="button" class="btn btn-olive  font-bold " id="btn_cancel"><i class="fas fa-times"></i> Batal</button>
  			    </div>
  			</form>
  		</div>
  	</div>
  </div>
</div>