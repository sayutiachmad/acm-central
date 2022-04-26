<div class="row">
	<div class="col-12">
		<div class="card card-outline card-olive">
			<div class="card-header">
				<h2 class="card-title"><i class="fas fa-search"></i> Filter Log Activity</h2>
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
                                <option value="NEW">ADD</option>
                                <option value="MOD">EDIT</option>
                                <option value="DEL">DELETE</option>
                                <option value="APV">APPROVAL</option>
                                <option value="GEN">GENERATE</option>
                                <option value="PRE">PREVIEW</option>
                                <option value="RES">RESTORE</option>
                            </select>
	                      </div>
	                    </div>

	                    <div class="col-sm-3">
	                      <div class="form-group">
	                        <label>Tipe Transaksi</label>
	                        <select class="form-control" name="fl_type">
                                <option value="all">Semua Tipe</option>
                                <option value="PO">Sales Order</option>
                                <option value="DO">Delivery Order</option>
                                <option value="SJ">Surat Jalan</option>
                                <option value="SC">Sales Confirmation</option>
                                <option value="INV">Invoice</option>
                                <option value="MTR">Master</option>
                                <option value="MTS">Mutasi</option>
                                <option value="OPN">Opname</option>
                                <option value="BEG">Beginning Balance</option>
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
							<th class="text-center align-middle" colspan="3">Transaksi</th>
							<th class="text-center align-middle" rowspan="2">Deskripsi</th>
							<th class="text-center align-middle" rowspan="2">User</th>
						</tr>

						<tr>
							<th class="text-center align-middle">Category</th>
							<th class="text-center align-middle">Type</th>
							<th class="text-center align-middle">Ref No.</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>