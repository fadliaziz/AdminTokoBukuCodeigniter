<!-- modal show detail distributor -->
<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<div class="mr-auto loading-container"></div>
				<button class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- modal edit distributor -->
<div class="modal fade" id="modal-edit-distributor">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form>
				<div class="modal-body">
					<input type="hidden" name="iddistributor">

					<label>Nama</label>
					<input type="text" name="namadistributor" class="form-control" required="" autofocus="">

					<label>telepon</label>
					<input type="text" name="telepon" class="form-control" required="" id="numeric-data">

					<label>Alamat</label>
					<textarea class="form-control" required="" name="alamat" rows="5"></textarea>
				</div>
				<div class="modal-footer">
					<div class="loading-container mr-auto"></div>
					<button class="btn btn-primary" type="submit">Edit</button>
					<button class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var loading = $(".loading-container");
	var tableDistributor = $("#table-distributor").DataTable({
		language : {
			emptyTable : "Data distributor tidak tersedia !",
			zeroRecords : "Distributor tidak di temukan !"
		},
		processing : true,
		serverside : true,
		ajax : "<?php echo base_url('admin/load/touch/distributor') ?>"
	});

	tableDistributor.on("click", "a", function() {
		let _this = $(this);
		let id = $(this).attr("id");
		let action = $(this).attr("data-action");

		let detail = () => {
			let parent = $("#modal-detail");
			parent.modal("show");
			
			$.ajax({
				url : "<?php echo base_url('admin/load/touch/part_distributor') ?>",
				data : {iddistributor : id},
				type : "POST",
				beforeSend : function() {
					loading.text("Loading...");
				},
				success : function(data) {
					loading.text("");
					data = JSON.parse(data);

					let el = "";
					el += "<ul class=\"list-group\">";
					el += "<li class=\"list-group-item\"><b>ID</b> : "+data['data'][0].iddistributor+"</li>";
					el += "<li class=\"list-group-item\"><b>Nama</b> : "+data['data'][0].namadistributor+"</li>";
					el += "<li class=\"list-group-item\"><b>Telepon</b> : "+data['data'][0].telepon+"</li>";
					el += "<li class=\"list-group-item\"><b>Alamat</b> : "+data['data'][0].alamat+"</li>";
					el += "</ul>";

					parent.find($(".modal-body")).html(el);
				}
			})
		}

		let edit = () => {
			let parent = $("#modal-edit-distributor");
			let form = parent.find($("form"));
			parent.modal("show");

			$.ajax({
				url : "<?php echo base_url('admin/load/touch/part_distributor') ?>",
				data : {iddistributor : id},
				type : "POST",
				beforeSend : function() {
					loading.text("Loading...");
				},
				success : function(data) {
					data = JSON.parse(data);

					loading.text("");

					form.find($("[name=\"iddistributor\"]")).val(data['data'][0].iddistributor);
					form.find($("[name=\"namadistributor\"]")).val(data['data'][0].namadistributor);
					form.find($("[name=\"telepon\"]")).val(data['data'][0].telepon);
					form.find($("[name=\"alamat\"]")).val(data['data'][0].alamat);
				},
				complete : function() {
					// on submit form
					form.submit(function(e) {
						e.preventDefault();

						$.ajax({
							url : "<?php echo base_url('admin/edit/touch/distributor') ?>",
							data : form.serialize(),
							type : "POST",
							beforeSend : function() {
								loading.text("Loading...");
							},
							success : function(data) {
								loading.text("");
								data = JSON.parse(data);

								if(data.status == "ok") notifSukses(data.msg);
								else notifError(data.msg);

								tableDistributor.ajax.reload();

								parent.modal("hide");
							}
						})

					})
				}
			})
		}

		let hapus = () => {
			let confirm = window.confirm("Hapus distributor ini ?");

			if(confirm) {
				$.ajax({
					url : "<?php echo base_url('admin/hapus/touch/distributor') ?>",
					data : {iddistributor : id},
					type : "POST",
					beforeSend : function() {
						$(this).closest("tr").remove()
						notifSukses("Distributor telah di hapus");
					},
					success : function(data) {
						tableDistributor.ajax.reload();
					}
				})
			}
		}

		switch(action) {
			case "detail" :
				return detail();
				break;
			case "edit" :
				return edit();
				break;
			case "hapus" :
				return hapus();
				break;
		}
	})
</script>