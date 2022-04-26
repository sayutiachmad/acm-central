<!--  -->
<div class="row">
	<div class="col-lg-6 col-12" style="display:;">
		<!-- small box -->
		<div class="small-box bg-olive">
		  <div class="inner">
		    <h3>150</h3>

		    <p>Order Baru</p>
		  </div>
		  <div class="icon">
		    <i class="ion ion-bag"></i>
		  </div>
		  <a href="<?php echo base_url('sales_order/create');?>" class="small-box-footer">Buat Order Baru  <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>	
</div>


<div class="row">
	<div class="col-12 col-md-6">

		<div class="card card-outline card-olive">
			<div class="card-header">
				<h2 class="card-title">List Sales Order : <?php echo $sess_data[SESSION_USER_FULLNAME];?></h2>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-sm" style="width:100%;" id="table-data">
					<tbody></tbody>
				</table>

			</div>

		</div>
		
	</div>
</div>