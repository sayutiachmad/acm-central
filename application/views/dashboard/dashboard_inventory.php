<style>
/*#wdr-pivot-view #wdr-grid-view div.alter1 {
  background-color: #f8b351;
}*/

/*.wdr-grid-column { 
  width: 30px;
  max-width: auto; 
}*/

</style>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
            <div class="row">
                <div class="col-md-10">
                    <form class="form-inline">
                         <div class="form-group">
        		            <label for="exampleInputEmail1">Company</label><br/>
        		            <select class="form-control select" name="fl_company_" title="Pilih Company" id="fl_company_">
                                <option value="" selected disabled>Pilih Company</option>
        		            	<?php foreach ($list_company as $key => $value) { ?>
        		            		<option <?php if($value[FIELD_PERUSAHAAN_ID] == "3020") echo "selected=\"selected\""; ?> value="<?php echo $value[FIELD_PERUSAHAAN_ID] ?>"><?php echo $value[FIELD_PERUSAHAAN_NAME] ?></option>
        		            	<?php } ?>
        		            </select>
        		          </div>
        		          <div class="form-group">
        		            <label for="exampleInputEmail1">Plant</label><br/>
        		            <select class="form-control select" name="fl_plant_" title="Pilih Plant" id="fl_plant_">
                                <option value="" selected disabled>Pilih Plant</option>
        		            	<?php foreach ($list_plant as $key => $value) { ?>
        		            		<option <?php if($value[FIELD_PLANT_ID] == "4201") echo "selected=\"selected\""; ?> value="<?php echo $value[FIELD_PLANT_ID] ?>"><?php echo $value[FIELD_PLANT_NAME] ?></option>
        		            	<?php } ?>
        		            </select>
        		          </div>
        		          <div class="form-group">
        		            <label for="exampleInputEmail1">Fiscal Year</label><br/>
        		            <select name="fl_fiscal_year_" class="form-control select" title="Pilih Fiscal Year">
                          <?php $y = 2015; $ty = date('Y');?>
                          <?php do{ ?>
                            <option value="<?php echo $y;?>" <?php echo ($y == $ty ? 'selected' : '');?>><?php echo $y;?></option>
                          <?php $y++; }while ($y <= $ty);?>
                        </select>
        		          </div>
        		          <div class="form-group">
        		            <label for="exampleInputPassword1">Period</label><br/>
        		            <select name="fl_period_" class="form-control select" title="Pilih Period" title="Pilih period" id="fl_period_">
        		            	<option value="" selected disabled>Pilih Period</option>
        		            	<?php foreach (print_month() as $key => $value) { ?>
        		            		<option value="<?php echo $key;?>"><?php echo $value;?></option>
        		            	<?php } ?>
        		            </select>
        		          </div>

                       
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <br>
                            <button type="button"  class="btn btn-success" id="btn-filter" style="margin-bottom: 0px;"><i class="fas fa-search"></i> Filter</button>
                        </div>
                    </form>
                </div> 
                
            </div>  
        </div>
    </div>
</div>



<div class="row">
	<div class="col-md-12 col-12">
		<div class="card card-outline card-olive">
			<div class="card-header">
				<h2>A. PS Grower</h2>
				<ul class="nav navbar-right panel_toolbox"> 
	                <li><a href="javascript:exportData('excel','ps_grower');" class="" data-toggle="tooltip" data-placement="top" data-original-title="Export Excel" title="">
	                	<i class="fa fa-file-excel" data-toggle="tooltip" data-placement="top" data-original-title="Export Excel"></i></a>
	                </li>
	            </ul>
	            <div class="clearfix"></div>
			</div>	
			<div class="card-body">
				<div id="ps_grower">
				</div>
			</div>
			
		</div>
	</div>
</div>
