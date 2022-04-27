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
							<input type="text" class="form-control daterangepick" name="fl_tanggal" value="<?php echo date('01 M Y') . " - ". date('d M Y');?>" readonly>
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

				<table class="table table-striped table-bordered table-sm" id="tbl-data" style="width:100%;font-size: 12px;">
                        <thead>
                            <tr>
                                <td >No.</td>
                                <td >Tanggal</td>
                                <td >Unit</td>
                                <td >Mitra</td>
                                <td >Customer</td>
                                <td >No. Faktur</td>
                                <td >Total Harga Pokok</td>
                                <td >Total Harga Jual</td>
                                <td >Disc</td>
                                <td >Total Net</td>
                                <td >Margin</td>
                                <td >Status Pembayaran</td>
                                <td >Tipe Pembayaran</td>
                                <td >Tanggal Pembayaran</td>
                                <td >Aging Pembayaran</td>
                                <td >Jenis Transaksi</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

			</div>

		</div>
		
	</div>
</div>