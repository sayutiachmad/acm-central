
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-map"></i> Master Company </h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="javascript:;" class="btn btn-tool" id="reload_table"><i class="fa fa-sync"></i> Reload Data</a>
            </div>

            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
                 <table width="100%" class="table table-bordered table-responsive table-striped table-hover dataTable" id="tb_company">
                    <thead>
                        <tr class="bg-themes-default" align="center">
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Perusahaan ID</th>
                            <th>Nama Perusahaan</th>
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
                       
                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Kode</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off maxlength="5" style="text-transform:uppercase;" name="per_id" class="form-control" placeholder="company ID">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="email_address_2">Nama</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  autocomplete="off" name="per_name" class="form-control" placeholder=" Nama Perusahaan">
                                    </div>
                                </div>
                            </div>
                        </div> 


                        <input type="text" style="display: none;" name="kd_company" value="true">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect" id="btn_submit">SIMPAN </button>
                    <button type="button" class="btn btn-warning waves-effect font-bold col-pink" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>