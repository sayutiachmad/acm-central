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
						<table class="table table-striped table-bordered table-sm" id="tbl-data" style="width:100%;font-size: 12px;">
		                    <thead>
		                        <tr>
		                            <th>No.</th>
		                            <th>Unit</th>
                                    <th>Mitra</th>
                                    <th>Tanggal</th>
                                    <th><span class="pull-left">Total Harga Pokok</span></th>
                                    <th><span class="pull-left">Total Harga Jual</span></th>
                                    <th><span class="pull-left">Disc</span></th>
                                    <th><span class="pull-left">Total Net</span></th>
                                    <th><span class="pull-left">Margin</span></th>
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
