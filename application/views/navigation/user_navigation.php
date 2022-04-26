<style type="text/css">
    .jstree-proton .jstree-clicked{
        background: none;
        box-shadow: inset 0 0 1px #dc3545;
        border:  solid 1px #dc3545;
    }
</style>


<div class="row">
    <div class="col-md-6 col-sm-12 col-12">
        <div class="card card-outline card-olive">
        	<div class="card-header">
        		<h2 class="card-title"><i class="fas fa-users"></i> User List</h2>

                <div class="card-tools"> 
                  <a href="javascript:;" class="btn btn-tool" id="reload_user" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Reload User"><i class="fa fa-sync"></i></a>
                  <a href="javascript:;" class="btn btn-tool" id="copy-nav" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Copy Navigation From User"><i class="fa fa-copy"></i></a>
                </div>
        		
    			<div class="clearfix"></div>
        	</div>
        	<div class="card-body">
        		<table class="table table-hover table-striped table-xtra-condensed table-bordered" id="table_user_list" style="width: 100%;" >
        			<thead>
        				<tr class="bg-themes-default">
        					<th style="width: 35px;" class="text-center">#</th>
        					<th>Username</th>
        					<th>Full Name</th>
                            <th>Role</th>
        				</tr>
        			</thead>
        			<tbody></tbody>
        		</table>
        	</div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-12">
    	<div class="card card-outline card-olive">
    		<div class="card-header">
    			<h2 class="card-title"><i class="fas fa-list-alt"></i> Navigation List <strong id="selected_user"></strong></h2>
    			<div class="card-tools"> 
    			  <a href="javascript:;" class="reload-nav btn-tool" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Reload Navigation"><i class="fa fa-sync"></i></a>
    			</div>
    			<div class="clearfix"></div>
    		</div>
    		<div class="card-body">

                <div class="alert alert-olive alert-dismissible fade in" role="alert" id="alert-nav" style="display: none;">
                    <span>
                        <i class="fas fa-exclamation-triangle"></i> 
                        <strong>Oops!</strong> Something wrong happen while loading data . . . 
                        <button class="btn btn-xs btn-success float-right reload-nav"><i class="fas fa-sync-alt"></i> Try reloading data</button>
                    </span>
                </div>
    			
                <div id="loading-bar" style="display: none;"><h4 class="text-center"><i class="fas fa-sync fa-spin"></i> Loading . . .</h4></div>

                <div id="info-bar">
                    <div class="bs-example" data-example-id="simple-jumbotron">
                        <div class="jumbotron">
                          <p class="text-center">Choose user from left column to start</p>
                        </div>
                    </div>
                </div>

                <div id="tree-content" style="overflow-x: auto;display:none;">
                    
                </div>

    		</div>
    	</div>
    </div>
</div>

<div class="modal fade" id="modal-copy-from" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-check-circle"></i> Copy User Navigation Permission</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            
                            <form class="form-horizontal" action="javascript:;">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <!-- Kode -->
                                        <div class="form-group row">
                                            <label class="control-label col-md-12 col-sm-12 col-12" style="text-align: left;">Copy From</label>
                                            <div class="col-md-12 col-sm-12 col-12">
                                              <select class="form-control select"  title="Choose User" id="user_from" data-live-search="true">
                                                <?php foreach ($list_user as $value) { ?>
                                                    <option value="<?php echo $value[F_USER_ID];?>"><?php echo $value[F_USER_USERNAME]; ?></option>
                                                <?php } ?>
                                              </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-md-12">&nbsp;</div>
                                            <div class="col-md-4" style="padding-top: 8px;">
                                                <h2 class="text-center"><i class="fas fa-copy"></i></h2>
                                            </div>
                                            <div class="col-md-4" style="padding-top: 8px;">
                                                <h2 class="text-center"><i class="fas fa-arrow-right"></i></h2>
                                            </div>
                                            <div class="col-md-4" style="padding-top: 8px;">
                                                <h2 class="text-center"><i class="fas fa-paste"></i></h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="control-label col-md-12 col-sm-12 col-12 float-left" style="text-align: left;">Paste To</label>
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <select class="form-control select" title="Choose User" id="user_to" data-live-search="true">
                                                    <?php foreach ($list_user as $value) { ?>
                                                        <option value="<?php echo $value[F_USER_ID];?>"><?php echo $value[F_USER_USERNAME]; ?></option>
                                                    <?php } ?>  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                

                                
                            </form>

                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-success font-bold disabled" id="btn-confirm"><i class="fas fa-check"></i> CONFIRM</button>
                    <button type="button" class="btn btn-olive  font-bold " data-dismiss="modal"><i class="fas fa-times"></i> CLOSE</button>
                </div>
        </div>
    </div>
</div>