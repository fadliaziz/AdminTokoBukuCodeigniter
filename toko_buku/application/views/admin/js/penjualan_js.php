<script type="text/javascript">
let loading = $(".loading-container");
	let form = $("#table-penjualan");
	let appendCol = form.find($("a#tambah-kolom"));

	let index = 0;
	appendCol.click(function() {
		index++;

		let el = "";
		el += "<tr id=\""+index+"\">";
		el += "<th class=\"text-center\">"+index+"</th>";
		el += "<input type=\"hidden\" name=\"harga_jual[]\"></input>";
		el += "<input type=\"hidden\" name=\"diskon[]\"></input>";
		el += "<input type=\"hidden\" name=\"ppn[]\"></input>";
		el += "<td><select name=\"idbuku[]\" id=\""+index+"\" required></select></td>";
		el += "<td><input class=\"form-control form-control-sm\" required type=\"number\" min=\"1\" max=\"999\" name=\"jumlah[]\"></input></td>";
		el += "<td class=\"text-center\"><a id=\"hapus-kolom\" data-position=\""+index+"\" href=\"#\" class=\"text-danger\"><i class=\"fa fa-trash\"></i></a></td>";
		el += "</tr>";

		form.find($("tbody")).append(el);

		// show button submit if col available
		if(form.find($("tbody tr")).length > 0) form.find($("tfoot")).attr("hidden", false);
		else form.find($("tfoot")).attr("hidden", true);

		// get data buku
		$(document).find($("tr#"+index+" [name=\"idbuku[]\"]")).select2({
			placeholder : "ex : simalakama jilid 1",
			width : "100%",
			language : {
				noResults : function() {return "ID / Judul buku tidak ditemukan !"}
			},
			ajax : {
				url : "<?php echo base_url('admin/load/touch/buku') ?>",
				type : "POST",
				dataType : "JSON",
				delay : 250,
				data : function(params) {
					return {
						q : params.term,
						page : params.page || 1,
						tipe : "select2"
					}
				},
				processResults : function(params, data) {
					params.page = params.page || 1;

					return {
						results : params.items,
						pagination : {
							more : (params.page * 10) < data.count_filtered
						}
					}
				}
			}
		}).on("select2:select", function(e) {
			let id = e.params.data.id;
			let index = $(this).attr("id");

			$.ajax({
				url : "<?php echo  base_url('admin/load/touch/part_buku') ?>",
				data : {idbuku : id},
				type : "POST",
				beforeSend : function() {
					loading.text("Loading...");
				},
				success : function(data) {
					data = JSON.parse(data);

					loading.text("");

					form.find($("tr#"+index+" [name=\"diskon[]\"]")).val(String(data['data'][0].diskon).replace(".0", ""));
					form.find($("tr#"+index+" [name=\"ppn[]\"]")).val(String(data['data'][0].ppn).replace(".0", ""));
					form.find($("tr#"+index+" [name=\"harga_jual[]\"]")).val(accounting.formatMoney(data['data'][0].harga_jual, "Rp ", "."));
					
					if(Number(data['data'][0].stok) < 1) {
						notifError("Buku ini telah kosong silahkan tambah di halaman pasok terlebih dahulu");
						form.find($("tr#"+index+" [name=\"jumlah[]\"]")).attr("disabled", true);
						form.find($("tfoot button")).attr("disabled", true);
					}
				}
			})
		});
	})

	form.submit(function(e) {
		e.preventDefault();

		$.ajax({
			url : "<?php echo base_url('admin/insert/touch/penjualan') ?>",
			data : form.serialize(),
			type : "POST",
			beforeSend : function() {loading.text("loading...")},
			success : function(data) {
				data = JSON.parse(data);

				loading.text("");

				if(data.status == "ok") notifSukses(data.msg);
				else notifError(data.msg);

				form.find($("tbody tr")).remove();
				form.find($("tfoot")).attr("hidden", true);
			}
		})
	})

	$(document).on("click", "a#hapus-kolom", function() {
		let index = $(this).attr("data-position");

		form.find($("tbody tr#"+index)).remove();
		
		if(form.find($("tbody tr")).length < 1) form.find($("tfoot")).attr("hidden", true);
	})
</script>