<div class="row">
    <div class="col-md-4 col-12" id="list_head_code">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-list-ol"></i> Head Code </h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="reload_table_sub"><i class="fa fa-sync"></i> Reload Data</a>
                <a href="javascript:;" class="btn btn-tool" id="action_add_sub" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  <!-- <div class="table-responsive"> -->
                      <table class="table table-bordered table-striped table-hover table-sm" id="table_for_data_sub" style="width: 100%;">
                          <thead>
                              <tr class="bg-themes-default">
                                  <th>#</th>
                                  <th>Head</th>
                                  <th>Code Name</th>
                              </tr>
                          </thead>
                          <tbody></tbody>
                      </table>
                  <!-- </div> -->
              </div>
              
            </div>
            
          </div>
        </div>
    </div>

    <div class="col-md-8 col-12" id="list_detail_code">
        <div class="card card-outline card-olive">
          <div class="card-header">
            <h2 class="card-title"><i class="fa fa-list"></i> Code Detail <span id="parent-ref"></span></h2>

            <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" id="reload_table"><i class="fa fa-sync"></i> Reload Data</a>
                <a href="javascript:;" class="btn btn-tool" id="action_add" data-toggle="tooltip" data-placement="top" data-original-title="Tambah Data" title=""><i class="fa fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="card-body">
            <div class="row custom-responsive">
              <div class="col-md-12 custom-responsive">
                  <div class="table-responsive option-responsive">
                      <table class="table table-bordered table-striped table-hover table-sm" id="table_for_data" style="width: 100%;" data-parent="0">
                          <thead >
                              <tr class="bg-themes-default">
                                  <th rowspan="2">#</th>
                                  <th rowspan="2">Code</th>
                                  <th rowspan="2">Code Name</th>
                                  <th colspan="3" class="text-center">Description</th>
                                  <th colspan="3" class="text-center">Amount</th>
                                  <th rowspan="2">Use</th>
                                  <th rowspan="2">Sort</th>
                                  <th rowspan="2">Option</th>
                              </tr>
                              <tr class="bg-themes-default">
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center">3</th>
                                <th class="text-center">1</th>
                                <th class="text-center">2</th>
                                <th class="text-center border-right">3</th>
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
                          <div id="alert_modal" class="alert bg-red alert-dismissible" role="alert" style="display: none;">
                            <i class="fa fa-exclamation-triangle"></i> <span id="alert_msg"></span>
                          </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 control-label">
                                <label for="password_2">Head Code</label>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <div class="form-line">
                                            <select name="cc_parent_" class="form-control" data-live-search="true" style="width: 100%;">
                                                <option value=" " disabled>- Pilih Head Code -</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 control-label">
                                <label for="email_address_2">Code</label>
                            </div>
                            <div class="col-12 col-md-4">
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

                        <div class="row clearfix">
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

                        <div class="row clearfix">
                            <div class="col-12 col-md-3 control-label">
                                <label for="password_2">Description 3</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="cc_desc_3_" class="form-control" placeholder="Description" autocomplete="false">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
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

                        <div class="row clearfix">
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

                        <div class="row clearfix">
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

                        <input type="hidden" name="cc_code_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " id="btn_submit">SIMPAN</button>
                    <button type="button" class="btn btn-olive  font-bold " data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form_sub" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                    
                <h4 class="modal-title" id="modal_label_sub"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                
            </div>
            <form class="form-horizontal" id="mp_form_sub" method="POST">
                <div class="modal-body">
                    <div class="row clearfix">
                      <div id="alert_modal_sub" class="alert bg-red alert-dismissible" role="alert" style="display: none;">
                        <i class="fa fa-exclamation-triangle"></i> <span id="alert_msg_sub"></span>
                      </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="email_address_2">Code</label>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="cc_head_code_" class="form-control" placeholder="Code" autocomplete="false">
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
                                    <input type="text" name="cc_head_code_name_" class="form-control" placeholder="Code Name" autocomplete="false">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-12 col-md-3 control-label">
                            <label for="password_2">Description</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="cc_head_desc_" class="form-control" placeholder="Description" autocomplete="false">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="cc_code_sub_">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary " id="btn_submit_sub">SIMPAN</button>
                    <button type="button" class="btn btn-olive  font-bold " data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>