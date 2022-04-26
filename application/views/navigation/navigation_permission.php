<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2><i class="fa fa-lock"></i> Hak Akses Navigasi </h2>

            <ul class="nav navbar-right panel_toolbox"> 
              <li class="dropdown">
                <a href="#" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" data-placement="top" data-original-title="Options"><i class="fa fa-ellipsis-v"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:;" class="" id="reload_table"><i class="fa fa-refresh"></i> Reload Data</a></li>
                </ul>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable" id="table_for_data" style="width: 100%">
                    <thead>
                        <tr class="bg-themes-default">
                            <th># </th>
                            <th id="nav">Navigasi</th>
                            <?php foreach ($list_role as $key => $value_role) { ?>
                                <th data-identifier="<?php echo $value_role['id_user_type'];?>"><?php echo $value_role['type_name'];?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
          </div>
        </div>
    </div>
</div>