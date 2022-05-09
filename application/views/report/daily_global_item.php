<div class="row">
	<div class="col-12 col-md-12">
		
		<div class="card card-outline card-olive">
			
			<div class="card-header">
				<h2 class="card-title"><i class="fas fa-filter"></i> Filter Laporan </h2>
			</div>

			<div class="card-body">
				
				<form id="form-filter">
					<div class="row">
						<div class="col-12 col-md-3">
							<label>Unit</label>
							<select class="form-control select2" name="fl_unit">
								<option value="ALL">Semua Unit</option>
								<?php foreach ($list_unit as $key => $value) { ?>
									<option value="<?php echo $value[FIELD_PLANT_ID];?>"><?php echo $value[FIELD_PLANT_NAME];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-12 col-md-3">
							<label>No. Faktur</label>
							<input type="text" class="form-control" name="fl_nofak">
						</div>
						<div class="col-12 col-md-3">
							<label>Tanggal</label>
							<input type="text" class="form-control daterangepick" name="fl_tanggal" value="<?php echo date('01 M Y') . " - ". date('d M Y');?>" >
						</div>
					</div>

					<div class="row mt-3">
						
						<div class="col-12 col-md-2">
							<button type="button" class="btn bg-olive" id="btn-filter"><i class="fas fa-filter"></i> Filter Data </button>
						</div>

					</div>
				</form>
			</div>

		</div>

	</div>
</div>

<div class="row">
	<div class="col-12 col-md-12">

		<div class="card card-outline card-olive">
			
			<div class="card-body">

				<div class="row">
					<div class="col-12">
						<table class="table table-striped table-bordered table-sm" id="tbl-data" style="width:200%;font-size: 12px;">
		                    <thead>
		                        <tr>
		                            <th>No.</th>
		                            <th>Tanggal</th>
		                            <th>Unit</th>
		                            <th>Mitra</th>
		                            <th>Customer</th>
		                            <th>No. Faktur</th>
		                            <th>Kode Barang</th>
		                            <th>Nama Barang</th>
		                            <th>Unit</th>
		                            <th>Harga Pokok</th>
		                            <th>Harga Jual</th>
		                            <th>Margin per unit</th>
		                            <th>Qty</th>
		                            <th>Total Harga Pokok</th>
		                            <th>Total Harga Jual</th>
		                            <th>Disc</th>
		                            <th>Total Net</th>
		                            <th>Margin</th>
		                            <th>Status Pembayaran</th>
		                            <th>Tipe Pembayaran</th>
		                            <th>Jenis Transaksi</th>
		                            <th>Kategori</th>
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
