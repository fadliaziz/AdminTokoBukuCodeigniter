<!-- modal tambah buku -->
<div class="modal fade" id="tambah-buku">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form>
				<div class="modal-header"><h5>Form tambah buku</h5></div>
				<div class="modal-body">
					<div class="row clearfix">
						<div class="col-md-12">
							<label>Judul</label>
							<input type="text" name="judul" class="form-control" required="" autofocus="">
						</div>
						<div class="col-md-12">
							<label>Distributor</label>
							<select name="iddistributor" class="form-control" required=""></select>
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
						<div class="col-md-4">
							<br>
							<label>Stok</label>
							<input type="number" name="stok" min="1" max="1000" required="" class="form-control">
						</div>
						<div class="col-md-4">
							<br>
							<label>PPN (%)</label>
							<input type="number" step=".1" name="ppn" min="0" max="100" class="form-control">
						</div>
						<div class="col-md-4">
							<br>
							<label>Diskon (%)</label>
							<input type="number" step=".1" name="diskon" min="0" max="100" class="form-control">
						</div>
						<div class="col-md-6">
							<br>
							<label>Harga Pokok (IDR)</label>
							<input type="text" id="numberFormat" name="harga_pokok" required="" min="1" class="form-control">
						</div>
						<div class="col-md-6">
							<br>
							<label>Harga Jual (IDR)</label>
							<input type="text" name="harga_jual" id="numberFormat" required="" min="1" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="loading-container mr-auto"></div>
					<button class="btn btn-primary" type="submit">Simpan & tambahkan buku !</button>
					<button class="btn" data-dismiss="modal">Batal</button>
				</div>
			</form>	
		</div>
	</div>
</div>

<!-- modal tambah distributor -->
<div class="modal fade" id="tambah-distributor">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<form>
				<div class="modal-header"><h5 class="modal-title">form tambah distributor</h5></div>
				<div class="modal-body">
					<label>Nama</label>
					<input type="text" name="namadistributor" class="form-control" required="" autofocus="">
					<br>
					<label>Telepon</label>
					<input type="text" name="telepon" id="numeric-data" class="form-control" required="">
					<br>
					<label>Alamat</label>
					<textarea class="form-control" required="" name="alamat" rows="5"></textarea>
				</div>
				<div class="modal-footer">
					<div class="loading-container mr-auto"></div>
					<button class="btn btn-primary" type="submit">Tambah distributor</button>
					<button class="btn" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

	//handle form tambah buku
	$("#tambah-buku").find($("form [name='noisbn']")).keyup(function() {
		this.value = this.value.replace(/[^0-9$-]/gi, "");
	})

	// get distributor
	let getDistributor = function() {
		$("[name='iddistributor']").select2({
			tags : true,
			width : "100%",
			placeholder : "Silahkan pilih distributor buku...",
			language : {
				noResults : function() {
					return "distributor yang anda cari tidak tersedia";
				}
			},
			ajax : {
				url : "<?php echo base_url('admin/load/touch/distributor') ?>",
				type : "POST",
				delay : 250,
				dataType : "JSON",
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
			let parent = $("#tambah-buku");
			let form = parent.find($("form"));
			let loading = parent.find($(".loading-container"));

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

					if(Number(data['total']) == 0){
						$("#tambah-distributor")
						.find($("form"))
						.find($("[name=\"namadistributor\"]")).val(id);

						$("#tambah-distributor")
						.find($(".modal-header .modal-title"))
						.text("Lengkapi data distributor baru")

						$("#tambah-distributor")
						.find($(".modal-header .modal-title"))
						.append("<br><div class=\"small\">Distributor yang dipilih belum terdaftar di database !</div>");
						$("#tambah-distributor").modal("show");
					} 
				}
			})
		});
	}
	getDistributor();

	$("#tambah-buku").find($("form")).submit(function(e) {
		e.preventDefault();

		let parent = $("#tambah-buku");
		let form = $(this);
		let loading = parent.find(".loading-container");


		$.ajax({
			url : "<?php echo base_url('admin/insert/touch/buku') ?>",
			data : form.serialize(),
			type : "POST",
			beforeSend : function() {
				loading.text("Loading...");
			},
			success : function(data) {
				loading.text("");
				data = JSON.parse(data);

				
				if(parent.modal("hide")) {
					form.find($(":input")).val("");
					if(data.status == "ok") notifSukses(data.msg);
					else notifError(data.msg);

				}
				
				if(typeof tableBuku == "object") tableBuku.ajax.reload();
			}
		})
	})

	// tambah distributor handle 
	$("#tambah-distributor").find($("form")).submit(function(e) {
		e.preventDefault();

		let parent = $("#tambah-distributor");
		let form = $(this);
		let loading = parent.find($(".loading-container"));

		$.ajax({
			url : "<?php echo base_url('admin/insert/touch/distributor') ?>",
			data : form.serialize(),
			type : "POST",
			beforeSend : function() {
				loading.text("Loading...");
			},
			success : function(data) {

				if(typeof tableDistributor == "object") tableDistributor.ajax.reload();

				data = JSON.parse(data);
				
				loading.text("");
				form.find($(":input")).val("");
				parent.modal("hide");

				if(data.status == "ok") notifSukses(data.msg);
				else notifError(data.msg);

				// set distributor data
				let disText = form.find($("[name='namadistributor']")).val();
				
				let disID = data.id;

				let newDistributor = new Option(String(data.text + " [ "+disID+" ] "), disID, true , true);
				$("[name='iddistributor']").append(newDistributor).trigger("change");
			}
		})
	})
</script>