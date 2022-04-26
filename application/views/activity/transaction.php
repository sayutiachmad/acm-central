<div class="row">
	<div class="col-12">
		<div class="card card-outline card-olive">
			<div class="card-header">
				<h2 class="card-title"><i class="fas fa-search"></i> Filter Log Transaksi</h2>
				<div class="card-tools">
					
				</div>
			</div>
			<div class="card-body">
				<form id="filter-form" action="javascript:;">
					<div class="row">

	                    <div class="col-sm-3">
	                      <!-- text input -->
	                      <div class="form-group">
	                        <label>Kategori Transaksi</label>
	                        <select class="form-control" name="fl_category">
                                <option value="all">Semua Kategori</option>
                                <option value="<?php echo LOG_TRANS_CAT_IN;?>">Stok Masuk (IN)</option>
                                <option value="<?php echo LOG_TRANS_CAT_OUT;?>">Stok Keluar (OUT)</option>
                                <option value="<?php echo LOG_TRANS_CAT_ADJUST;?>">Adjustment (ADJ)</option>
                            </select>
	                      </div>
	                    </div>

	                    <div class="col-sm-3">
	                      <div class="form-group">
	                        <label>Tipe Transaksi</label>
	                        <select class="form-control" name="fl_type">
                                <option value="all">Semua Tipe</option>
                                <option value="<?php echo LOG_TRANS_TYPE_RECEIVE_NEW;?>">Penerimaan Barang</option>
                                <option value="<?php echo LOG_TRANS_TYPE_STOCK_BATCH_ADJUST;?>">Stock Adjusment</option>
                            </select>
	                      </div>
	                    </div>

	                    <div class="col-sm-3">
	                      <div class="form-group">
	                        <label>Barang</label>
	                        <select class="form-control select2" name="fl_item">
	                        	<option value="all">Semua Barang</option>
                                <?php foreach ($list_item as $key => $value) { ?>
                                        <option value="<?php echo $value[FIELD_ITEM_ID] ?>"><?php echo $value[FIELD_ITEM_NAME] ?></option>
                                <?php } ?>
                            </select>
	                      </div>
	                    </div>

	                    <div class="col-sm-3">
	                      <div class="form-group">
	                        <label>User</label>
	                        <select class="form-control select2" name="fl_user">
	                        	<option value="all">Semua User</option>
	                        	<?php foreach ($list_user as $value) { ?>
	                        		<option value="<?php echo $value[F_USER_ID];?>"><?php echo $value[F_USER_USERNAME];?></option>
	                        	<?php } ?>
	                        </select>
	                      </div>
	                    </div>
	                </div>

	                <div class="row">

	                    <div class="col-sm-3">
	                      <!-- text input -->
	                      <div class="form-group">
	                        <label>Tanggal Transaksi</label>
	                        <input type="text" class="form-control daterangepick" readonly name="fl_trans_date" value="<?php echo date('d M Y', strtotime('-7 days')) . " - " . date('d M Y');?>">
	                      </div>
	                    </div>

	                    <div class="col-sm-6">
	                      
	                    </div>

	                    <div class="col-sm-3">
	                      <div class="form-group">
	                        <label>&nbsp;</label><br>
	                        <button type="button" class="btn btn-success float-right" id="btn-filter"><i class="fas fa-search"></i> Filter Data</button>
	                      </div>
	                    </div>
	                </div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-hover table-striped table-bordered table-sm" id="table-data" style="width: 100%;">
					<thead>
						<tr>
							<th class="text-center align-middle" rowspan="2">No.</th>
							<th class="text-center align-middle" rowspan="2">Tanggal</th>
							<th class="text-center align-middle" rowspan="2">Jam</th>
							<th class="text-center align-middle" colspan="4">Transaksi</th>
							<th class="text-center align-middle" rowspan="2">Barang</th>
							<th class="text-center align-middle" colspan="2">Qty</th>
							<th class="text-center align-middle" colspan="2">Old Balance</th>
							<th class="text-center align-middle" colspan="2">New Balance</th>
							<th class="text-center align-middle" rowspan="2">User</th>
						</tr>

						<tr>
							<th class="text-center align-middle">Category</th>
							<th class="text-center align-middle">Type</th>
							<th class="text-center align-middle">Ref No.</th>
							<th class="text-center align-middle">Stock Ref</th>
							<th class="text-center align-middle">Pcs</th>
							<th class="text-center align-middle">Kg</th>
							<th class="text-center align-middle">Pcs</th>
							<th class="text-center align-middle">Kg</th>
							<th class="text-center align-middle">Pcs</th>
							<th class="text-center align-middle">Kg</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>