</div><!-- BEGIN: Footer-->
<footer class="page-footer flexbox">
	<div class="text-muted">2019 © <strong></strong>. All rights reserved</div><a class="btn btn-primary btn-rounded" href="" target="_blank"></a>
</footer><!-- END: Footer-->
</div><!-- END: Content-->
</div>
</div><!-- BEGIN: Search form-->
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document" style="margin-top: 100px">
		<div class="modal-content">
			<form class="search-top-bar" action="#"><input class="form-control search-input" type="text" placeholder="Search..."><button class="reset input-search-icon" type="submit"><i class="ft-search"></i></button><button class="reset input-search-close" type="button" data-dismiss="modal"><i class="ft-x"></i></button></form>
		</div>
	</div>
</div><!-- END: Search form-->

<!-- CORE PLUGINS-->
<!-- <script src="<?= base_url('assets/admin/jquery/jquery.min.js') ?>"></script> -->
<script src="<?= base_url('assets/admin/bootstrap/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/metismenu/metisMenu.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script><!-- PAGE LEVEL PLUGINS-->
<script src="<?= base_url('assets/admin/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/easy-pie-chart/jquery.easypiechart.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
<script src="<?= base_url('assets/admin/chart.js/Chart.min.js') ?>"></script><!-- CORE SCRIPTS-->
<script src="<?= base_url('assets/admin/js/app.min.js') ?>"></script><!-- PAGE LEVEL SCRIPTS-->
<script>
	$(function() {
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var DAYS_S = ["S", "M", "T", "W", "T", "F", "S"];
		var color = Chart.helpers.color;
		(function() {
			var dr = $('#subheader_daterange');
			if (dr.length) {
				var t = moment();
				var a = moment();
				dr.daterangepicker({
						startDate: t,
						endDate: a,
						ranges: {
							'Today': [moment(), moment()],
							'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
							'Last 7 Days': [moment().subtract(6, 'days'), moment()],
							'Last 30 Days': [moment().subtract(29, 'days'), moment()],
							'This Month': [moment().startOf('month'), moment().endOf('month')],
							'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
						},
					}, f),
					f(t, a, "");
			}

			function f(t, a, r) {
				var o = "",
					n = "";
				a - t < 100 || "Today" == r ?
					(o = "Today:", n = t.format("MMM D")) :
					"Yesterday" == r ? (o = "Yesterday:", n = t.format("MMM D")) :
					n = t.format("MMM D") + " - " + a.format("MMM D"), dr.find(".subheader-daterange-date").html(n), dr.find(".subheader-daterange-title").html(o)
			}
		})();

		$('.easypie').each(function() {
			$(this).easyPieChart({
				trackColor: $(this).attr('data-trackColor') || '#f2f2f2',
				scaleColor: false,
			});
		});
		if ($('#area_chart').length) {
			var ctx = document.getElementById("area_chart").getContext("2d");
			var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
			var gradientFill = ctx.createLinearGradient(500, 0, 100, 0);
			gradientFill.addColorStop(0, theme_color('warning'));
			gradientFill.addColorStop(1, theme_color('danger'));
			new Chart(ctx, {
				type: 'line',
				data: {
					labels: DAYS_S,
					datasets: [{
						label: "Subscribed",
						backgroundColor: gradientFill,
						hoverBackgroundColor: gradientFill,
						data: [64, 20, 50, 30, 85, 42, 68, 33, 56, 38],
						pointBorderWidth: 1,
						pointRadius: 0,
						pointHitRadius: 30,
						pointHoverBackgroundColor: gradientFill,
						pointHoverBorderColor: '#ffe8f0',
						pointHoverBorderWidth: 5,
						pointHoverRadius: 6
					}],
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						xAxes: [{
							gridLines: {
								display: false,
							},
							ticks: {
								labelOffset: 20,
							}
						}],
						yAxes: [{
							display: false,
							ticks: {
								beginAtZero: true,
							}
						}]
					},
					legend: {
						display: false
					}
				}
			});
		}
		if ($('#bar_chart_sm').length) {
			var ctx = document.getElementById("bar_chart_sm").getContext("2d");
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7", "Label 8", "Label 9", "Label 10", "Label 11", "Label 12", "Label 13", "Label 14", "Label 15", "Label 16"],
					datasets: [{
						backgroundColor: theme_color("primary"),
						data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20]
					}, {
						backgroundColor: "#f3f3fb",
						data: [15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20]
					}]
				},
				options: {
					title: {
						display: !1
					},
					tooltips: {
						intersect: !1,
						mode: "nearest",
						xPadding: 10,
						yPadding: 10,
						caretPadding: 10
					},
					legend: {
						display: !1
					},
					responsive: !0,
					maintainAspectRatio: !1,
					barRadius: 4,
					scales: {
						xAxes: [{
							display: !1,
							gridLines: !1,
							stacked: !0
						}],
						yAxes: [{
							display: !1,
							stacked: !0,
							gridLines: !1
						}]
					},
					layout: {
						padding: {
							left: 0,
							right: 0,
							top: 0,
							bottom: 0
						}
					}
				}
			});
		}
		initminicharts($('#mini_chart_1'), [5, 11, 8, 14, 6, 10], theme_color('danger'));
		initminicharts($('#mini_chart_2'), [5, 11, 8, 14, 6, 10], theme_color('primary'));
		initminicharts($('#mini_chart_3'), [5, 11, 8, 14, 6, 10], theme_color('success'));

		function initminicharts(elem, data, border_color) {
			if (elem.length == 0) {
				return;
			}
			var chart = new Chart(elem, {
				type: 'line',
				data: {
					labels: MONTHS,
					datasets: [{
						label: '',
						data: data,
						fill: false,
						borderColor: border_color,
						pointRadius: 0,
						pointHitRadius: 20,
						pointHoverBackgroundColor: border_color,
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					legend: {
						display: false,
					},
					title: {
						display: false,
					},
					tooltips: {
						enabled: false,
					},
					scales: {
						xAxes: [{
							display: false,
							gridLines: false,
							scaleLabel: {
								display: false,
								labelString: 'Month'
							}
						}],
						yAxes: [{
							display: false,
							gridLines: false,
							scaleLabel: {
								display: false,
								labelString: 'Month'
							}
						}]
					},
					layout: {
						padding: {
							left: 6,
							right: 0,
							top: 4,
							bottom: 0
						}
					}
				}
			});
		}
	});
</script>
</body>

</html>
