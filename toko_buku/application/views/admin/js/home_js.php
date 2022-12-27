<script type="text/javascript">
	
	$.ajax({
		url : "<?php echo base_url('admin/load/touch/grafik') ?>",
		type : "POST",
		data : {call : "penjualan"},
		success : function(data) {
			data = JSON.parse(data);
			let chartBuku = document.getElementById("chart-buku").getContext("2d");
			let cb = new Chart(chartBuku, {
				type : "bar",
				data : {
					labels : ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
					datasets : [{
						data : data.penjualan,
						backgroundColor: 'rgba(233, 30, 99, 0.8)'
					}]
				},
				options : {
					responsive : true,
					legend :false
				}
			})
		}
	})

</script>