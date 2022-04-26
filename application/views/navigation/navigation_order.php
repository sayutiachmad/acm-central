
<div class="row">
    <div class="col-md-7 col-12">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-stream"></i> Urutan Navigasi </h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="action_save" data-toggle="tooltip" data-placement="top" data-original-title="Simpan Urutan Navigasi" title=""><i class="fa fa-save"></i></a>
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i></a>
                <a href="javascript:;" class="btn btn-tool" id="reload_list"><i class="fa fa-sync"></i></a>
                
            </div>

            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <center>
                <div class="preloader pl-size-l" id="list-preloader" style="display: none;padding-top:20px;">
                    <h2> <i class="fas fa-sync fa-spin"></i> </h2>
                </div>     

                <div class="alert alert-olive" id="alert-fail" style="display: none;">
                    <strong>Ooops!</strong> Gagal memuat menu navigasi, muat ulang halaman untuk mencoba kembali
                </div>                   
            </center>

            <div class="dd nestable-with-handle" id="navigation-list" style="width: 100%;">
                
            </div>

          </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <h4 class="modal-title" id="modal_label"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
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
                                        <input type="text" name="nv_nama_navigasi_" class="form-control" placeholder="Nama navigasi">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-12 col-md-3 form-control-label">
                                <label for="password_2">Link</label>
                            </div>
                            <div class="col-12 col-md-5">
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
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="nv_parent_" class="form-control" data-live-search="true">
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
                    <button type="submit" class="btn btn-primary" id="btn_submit">SIMPAN</button>
                    <button type="button" class="btn btn-olive font-bold" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

