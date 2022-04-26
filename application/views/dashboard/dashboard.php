<div class="row tile_count">
	<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fab fa-twitter"></i> Populasi Betina</span>
      <div class="count"><?php echo  number_format($ps_pop['sum_female_pop']) ?></div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fab fa-twitter"></i> Populasi Jantan</span>
      <div class="count"><?php echo  number_format($ps_pop['sum_male_pop']) ?></div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fab fa-twitter"></i> Total Populasi</span>
      <div class="count"><?php echo  number_format( $ps_pop['sum_female_pop'] + $ps_pop['sum_male_pop'] ) ?></div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fas fa-bug"></i> Deplesi Betina</span>
      <div class="count">123.50</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fas fa-bug"></i></i> Deplesi Jantan</span>
      <div class="count">2500</div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fas fa-bug"></i> Total Deplesi</span>
      <div class="count">123.50</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>

    <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="dashboard_graph">

                <div class="row card-header">
                  <div class="col-md-6">
                    <h3>Weekly Depletion <small></small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="float-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>March 14, 2019 - April 12, 2019</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-12">
                  <div id="chart_plot_01" class="demo-placeholder" style="padding: 0px; position: relative;"><canvas class="flot-base" width="794" height="280" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 794px; height: 280px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 99px; top: 264px; left: 44px; text-align: center;">Jan 01</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 99px; top: 264px; left: 170px; text-align: center;">Jan 02</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 99px; top: 264px; left: 295px; text-align: center;">Jan 03</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 99px; top: 264px; left: 421px; text-align: center;">Jan 04</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 99px; top: 264px; left: 546px; text-align: center;">Jan 05</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 99px; top: 264px; left: 672px; text-align: center;">Jan 06</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 252px; left: 13px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 232px; left: 7px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 213px; left: 7px; text-align: right;">20</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 194px; left: 7px; text-align: right;">30</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 174px; left: 7px; text-align: right;">40</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 155px; left: 7px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 136px; left: 7px; text-align: right;">60</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 116px; left: 7px; text-align: right;">70</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 97px; left: 7px; text-align: right;">80</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 78px; left: 7px; text-align: right;">90</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 58px; left: 1px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 39px; left: 2px; text-align: right;">110</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 20px; left: 1px; text-align: right;">120</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">130</div></div></div><canvas class="flot-overlay" width="794" height="280" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 794px; height: 280px;"></canvas></div>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

	<!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-12">
	    <div class="tile-stats bg-yellow-gradient">
	      <div class="icon"><i class="glyphicon glyphicon-sort-by-attributes"></i></div>
	      <div class="count"><h1><?php echo  number_format($ps_pop['sum_female_pop']) ?><small>&nbsp;ekor</small></h1></div>
	      <h3><i">Populasi Betina</h3>
	      <p>last update : <?php echo $ps_pop['last_date'] ?><i class="white float-right"><i class="glyphicon glyphicon-triangle-right" data-toggle="tooltip" title="More details .."></i>&nbsp;&nbsp;</i></p>

	    </div>
	 </div>
	 <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-12">
	    <div class="tile-stats bg-green-gradient">
	      <div class="icon"><i class="fas fa-cubes"></i></div>
	      <div class="count"><h1><?php echo  number_format($ps_pop['sum_male_pop']) ?><small>&nbsp;ekor</small></h1></div>
	      <h3>Populasi Jantan</h3>
	      <p>last update : <?php echo $ps_pop['last_date'] ?><a href="report_production/rpt_prod_daily_recording_summary"><i class="white float-right"><i class="glyphicon glyphicon-triangle-right" data-toggle="tooltip" title="More details .."></i>&nbsp;&nbsp;</i></a></p>
	    </div>
	 </div>
	 <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-12">
	    <div class="tile-stats bg-red-gradient">
	      <div class="icon"><i class="glyphicon glyphicon-sort-by-attributes"></i></div>
	      <div class="count"><h1><?php echo  number_format($ps_pop['sum_female_pop']) ?><small>&nbsp;%</small></h1></div>
	      <h3><i">Deplesi Betina</h3>
	      <p>last update : <?php echo $ps_pop['last_date'] ?><i class="white float-right"><i class="glyphicon glyphicon-triangle-right" data-toggle="tooltip" title="More details .."></i>&nbsp;&nbsp;</i></p>
	    </div>
	 </div>
	 <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-12">
	    <div class="tile-stats bg-aqua-gradient">
	      <div class="icon"><i class="fas fa-cubes"></i></div>
	      <div class="count"><h1><?php echo  number_format($ps_pop['sum_male_pop']) ?><small>&nbsp;%</small></h1></div>
	      <h3>Deplesi Jantan</h3>
	      <p>last update : <?php echo $ps_pop['last_date'] ?><i class="white float-right"><i class="glyphicon glyphicon-triangle-right" data-toggle="tooltip" title="More details .."></i>&nbsp;&nbsp;</i></p>
	    </div>
	 </div> -->
</div>