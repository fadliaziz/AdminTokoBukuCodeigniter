<!-- detail buku -->
<div class="modal fade" id="detail-buku">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<div class="loading-container mr-auto"></div>
				<button class="btn" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- modal edit buku -->
<div class="modal fade" id="edit-buku">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form>
				<div class="modal-body">
					<div class="row clearfix">
						<input type="hidden" name="idbuku">
						<div class="col-md-12">
							<label>Judul</label>
							<input type="text" name="judul" class="form-control" required="" autofocus="">
						</div>
						<div class="col-md-12">
							<br>
							<label>Nomor ISBN</label>
							<input type="text" name="noisbn" required="" class="form-control">
						</div>
						<div class="col-md-6">
							<br>
							<label>Penulis</label>
							<input type="text" name="penulis" required="" class="form-control">
						</div>
						<div class="col-md-6">
							<br>
							<label>Penerbit</label>
							<input type="text" name="penerbit" required="" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="loading-container mr-auto"></div>
					<button class="btn btn-primary" type="submit">Simpan & edit buku !</button>
					<button class="btn" data-dismiss="modal">Batal</button>
				</div>
			</form>	
		</div>
	</div>
</div>

<script type="text/javascript">
	let loading = $(".loading-container");

	var tableBuku = $("#table-buku").DataTable({
		language : {
			emptyTable : "Data buku tidak tersedia",
			zeroRecords : "Buku tidak ditemukan !"
		},
		serverside : true,
		processing : true,
	ajax : "<?php echo base_url('admin/load/touch/buku') ?>"
	})

	tableBuku.on("click", "a", function() {
		let id = $(this).attr("id");
		let action = $(this).attr("data-action");
		let _this = $(this);

		let detail = function() {
			let parent = $("#detail-buku");
			parent.modal("show");			

			$.ajax({
				url : "<?php echo base_url('admin/load/touch/part_buku') ?>",
				data : {idbuku : id},
				type : "POST",
				beforeSend : function() {
					loading.text("Loading...");
				},
				success : function(data) {
					data = JSON.parse(data);

					loading.text("");

					let el = "";
					el += "<ul class=\"list-group\">";
					el += "<li class=\"list-group-item\"><b>ID Buku</b> : "+data['data'][0].idbuku+"</li>";
					el += "<li class=\"list-group-item\"><b>Judul</b> : "+data['data'][0].judul+"</li>";
					el += "<li class=\"list-group-item\"><b>Nomor ISBN</b> : "+data['data'][0].noisbn+"</li>";
					el += "<li class=\"list-group-item\"><b>Penulis</b> : "+data['data'][0].penulis+"</li>";
					el += "<li class=\"list-group-item\"><b>Penerbit</b> : "+data['data'][0].penerbit+"</li>";
					el += "<li class=\"list-group-item\"><b>Tahun</b> : "+data['data'][0].tahun+"</li>";
					el += "<li class=\"list-group-item\"><b>Stok</b> : "+data['data'][0].stok+"</li>";
					el += "<li class=\"list-group-item\"><b>Harga Pokok</b> : "+accounting.formatMoney(data['data'][0].harga_pokok, "Rp ", ".")+"</li>";
					el += "<li class=\"list-group-item\"><b>Harga Jual</b> : "+accounting.formatMoney(data['data'][0].harga_jual, "Rp ", ".")+"</li>";
					el += "<li class=\"list-group-item\"><b>PPN</b> : "+String(data['data'][0].ppn).replace(".0", "")+"%</li>";
					el += "<li class=\"list-group-item\"><b>Diskon</b> : "+String(data['data'][0].diskon).replace(".0", "")+"%</li>";
					el += "</ul>";

					parent.find($(".modal-body")).html(el);
				}
			})
		}

		let hapus = function() {
			let confirm = window.confirm("Hapus buku ini ?");
			if(confirm) {
				$.ajax({
					url : "<?php echo base_url('admin/hapus/touch/buku') ?>",
					data : {idbuku : id},
					type : "POST",
					beforeSend : function() {
						_this.closest("tr").remove();
					},
					success : function(data) {

						data = JSON.parse(data);

						if(data.status == "ok") notifSukses(data.msg);
						else notifError(data.msg);

					}
				})
			}
		}

		let edit = function() {
			let parent = $("#edit-buku");
			let form = parent.find($("form"));

			parent.modal("show");

			$.ajax({
				url : "<?php echo base_url('admin/load/touch/part_buku') ?>",
				data : {idbuku : id},
				type : "POST",
				beforeSend : function() {
					loading.text("Loading...");
				},
				success : function(data) {

					loading.text("");

					data = JSON.parse(data);

					form.find($("[name=\"idbuku\"]")).val(data['data'][0].idbuku);
					form.find($("[name=\"judul\"]")).val(data['data'][0].judul);
					form.find($("[name=\"noisbn\"]")).val(data['data'][0].noisbn);
					form.find($("[name=\"penulis\"]")).val(data['data'][0].penulis);
					form.find($("[name=\"penerbit\"]")).val(data['data'][0].penerbit);
				},
				complete : function() {
					form.submit(function(e) {
						e.preventDefault();

						$.ajax({
							url : "<?php echo base_url('admin/edit/touch/buku') ?>",
							data : form.serialize(),
							type : "POST",
							beforeSend : function() {
								loading.text("Loading...");
							},
							success : function(data) {

								data = JSON.parse(data);

								if(parent.modal("hide")) {

									if(data.status == "ok") notifSukses(data.msg);
									else notifError(data.msg);

									tableBuku.ajax.reload();
								}

							}
						})
					})
				}
			})
		}

		switch(action) {
			case "detail" :
				return detail();
				break;
			case "hapus" :
				return hapus();
				break;
			case "edit" :
				return edit();
				break;
		}
	})
</script>