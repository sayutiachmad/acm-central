
<div class="row">
    <div class="col-md-12 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-map"></i> Menu Navigasi </h3>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="javascript:;" class="btn btn-tool" id="reload_table"><i class="fa fa-sync"></i> Reload</a>
            </div>

            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive option-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table_for_data" style="width: 100%;">
                            <thead>
                                <tr class="bg-themes-default">
                                    <th>#</th>
                                    <th>Navigasi</th>
                                    <th>Link</th>
                                    <th>Icon</th>
                                    <th>Parent</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
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
                                <label for="email_address_2">Nama Navigasi</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nv_nama_navigasi_" class="form-control" placeholder="Nama navigasi">
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
                                        <input type="text" name="nv_link_" class="form-control" placeholder="Alamat halaman">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="password_2">Icon</label>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nv_icon_" class="form-control" placeholder="Icon navigasi">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="password_2">Parent</label>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="nv_parent_" class="form-control" data-live-search="true" style="width: 100%;">
                                            <option value=" " disabled selected>- Pilih Parent -</option>
                                            <option value="0">Menu Utama</option>
                                            <option data-divider="true"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="nv_code_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " id="btn_submit">SIMPAN</button>
                    <button type="button" class="btn btn-olive  font-bold " data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
