
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-map"></i> Master Unit </h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="javascript:;" class="btn btn-tool" id="reload_table"><i class="fa fa-sync"></i> Reload Data</a>
            </div>

            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
                 <table class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;" id="tb_plant">
                    <thead>
                        <tr class="bg-themes-default" align="center">
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Nama Perusahaan</th>
                            <th>Unit ID</th>
                            <th>Nama Plant</th>
                            <th>Alamat 1</th>
                            <th>Alamat 2</th>
                            <th>Phone</th>
                            <th>Label</th>
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


<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_label"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" id="mp_form" method="POST">
                <div class="modal-body">
                       
                        <div class="row clearfix" style="display:none;">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Perusahaan</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <!-- <select class="form-control" name="id_p" > -->
                                            <!-- <option value="" disabled>~ Pilih Perusahaan ~</option> -->
                                            <?php foreach ($perusahaan as $key => $value) { ?>
                                                <!-- <option value="<?php echo $value[FIELD_PERUSAHAAN_ID]  ?>" selected><?php echo $value[FIELD_PERUSAHAAN_NAME]  ?></option> -->
                                            <?php } ?>

                                        <!-- </select> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id_p" value="<?php echo $perusahaan[0][FIELD_PERUSAHAAN_ID];?>">



                        <!-- <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Unit ID</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" style="text-transform:uppercase;" name="plant_id" class="form-control" placeholder="Plant ID">
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Nama Unit</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="plant_name" class="form-control" placeholder="Nama Unit">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Alamat 1</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="alamat_1" class="form-control date-dmy" placeholder="Plant Name">
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Alamat 2</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="alamat_2" class="form-control" placeholder="Plant Name">
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Phone</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="phone" class="form-control" placeholder="Plant Name">
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Label</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="plant_label" class="form-control" placeholder="Plant Label">
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <h6 class="mt-2 mb-0">Data Source Detail</h6>
                        <hr class="mt-1">

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="">Hostname</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="plant_hostname" class="form-control" placeholder="Hostname">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="">Host Username</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="plant_host_username" class="form-control" placeholder="Host Username">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="">Host Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password"  autocomplete="off" name="plant_host_password" class="form-control" placeholder="Host Password">
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="">DB Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="plant_datasource" class="form-control" placeholder="Data Source">
                                    </div>
                                </div>
                            </div>
                        </div> 


                        <input type="text" style="display: none;" name="kd_plant" value="true">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect" id="btn_submit">SIMPAN </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>