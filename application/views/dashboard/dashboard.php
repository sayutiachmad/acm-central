<div class="row">
    <div class="col-12">
    
        <div class="card card-outline card-olive">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-chart-line"></i> Total Penjualan Unit Per Bulan</h2>
            </div>
            <div class="card-body">
            
                <form id="sell-unit-form">
              

                    <div class="row">
                        <div class="col-12 col-md-2">
                            <input type="text" class="form-control date-month" name="fl_tanggal" value="<?php echo date('M Y');?>">
                        </div>

                        <div class="col-12 col-md-1">
                            <button type="button" class="btn btn-success btn-block " id="btn-filter"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            
                            <canvas id="sell-unit-chart" width="400" height="100"></canvas>

                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>