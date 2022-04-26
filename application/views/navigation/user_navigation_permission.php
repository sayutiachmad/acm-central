<div class="row">
    <div class="col-md-5 col-sm-12 col-12">
        <div class="card card-outline card-olive">
        	<div class="card-header">
        		<i class="fas fa-users"></i> User List
        		
    			<div class="clearfix"></div>
        	</div>
        	<div class="card-body">
        		<table class="table table-hover table-striped table-xtra-condensed table-bordered" id="table_user_list" style="width: 100%;" >
        			<thead>
        				<tr class="bg-themes-default">
        					<th style="width: 35px;" class="text-center">#</th>
        					<th>Username</th>
        					<th>Full Name</th>
        				</tr>
        			</thead>
        			<tbody></tbody>
        		</table>
        	</div>
        </div>
    </div>

    <div class="col-md-7 col-sm-12 col-12">
    	<div class="card card-outline card-olive">
    		<div class="card-header">
    			<i class="fas fa-list-alt"></i> Navigation List <strong id="selected_user"></strong>
    			<ul class="nav navbar-right panel_toolbox"> 
    			  <li class="dropdown">
    			    <a href="#" class="btn btn-tool dropdown-toggle small" data-toggle="dropdown" role="button" aria-expanded="false" data-placement="top" data-original-title="Options"><i class="fa fa-ellipsis-v"></i></a>
    			    <ul class="dropdown-menu" role="menu">
    			      <li><a href="javascript:;" class="" id="reload_table"><i class="fa fa-sync"></i> Reload Data</a></li>
    			    </ul>
    			  </li>
    			  <li><a href="javascript:;" class="btn btn-tool small" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i></a></li>
    			</ul>
    			<div class="clearfix"></div>
    		</div>
    		<div class="card-body">
    			<table class="table table-hover table-bordered table-striped table-xtra-condensed" id="table_permission" style="width: 100%;">
    				<thead>
    					<tr class="bg-themes-default">
    						<th style="width: 35px;" class="text-center">#</th>
    						<th>Navigation Name</th>
    						<th>Address</th>
    						<th style="width: 70px;">Permission</th>
    						<th>Option</th>
    					</tr>
    				</thead>
    			</table>
    		</div>
    	</div>
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title" id="modal_label"></h4>
                    </div>
                    <div class="col-md-6">
                        <div class="preloader pl-size-xs float-right" style="display: none;" id="modal_preloader">
                            <div class="spinner-layer pl-indigo">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="form-horizontal" id="mp_form" method="POST">
                <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Nama Navigasi</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="up_navigation_name_" class="form-control" placeholder="Nama navigasi" autocomplete="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="password_2">Link</label>
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="up_link_" class="form-control" placeholder="Alamat halaman" autocomplete="false">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="password_2">Permission</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="up_permission_" class="form-control select" style="width: 100%;" title="Select Permission">
                                            <option value="1" data-icon="glyphicon glyphicon-check">Allow</option>
                                            <option value="0" data-icon="glyphicon glyphicon-remove">Deny</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="up_code_">
                        <input type="hidden" name="up_user_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " id="btn_submit"><i class="fas fa-save"></i> SIMPAN</button>
                    <button type="button" class="btn btn-olive  font-bold " data-dismiss="modal"><i class="fas fa-times"></i> CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>