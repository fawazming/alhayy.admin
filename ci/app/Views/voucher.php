</div>
<div>
	<link href="<?= base_url('assets/admin/vendors/sweetalert2/dist/sweetalert2.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/admin/vendors/summernote/dist/summernote-bs4.css') ?>" rel="stylesheet" />

	<div class="card">
		<div class="card-body">
			<h5 class="box-title">Generate Voucher</h5>
			<div class="container mb-4">
				<form action="<?=base_url('addVoucher')?>" method="post">
					<div class="mb-2">
						<label for="worth">Worth:</label>
						<input class="form-control form-control-rounded" type="number" value="" name="worth">
					</div>
					<div class="mb-3">
						<label for="worth">Voucher Pin:</label>
						<div class="flexbox">
							<input class="form-control form-control-rounded pin" type="text" value="" name="pin" inputmode="">
							<a class="genpin input-icon btn btn-secondary font-16"><i class="ft-shuffle position-relative"></i></a>
						</div>
						
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="Add Voucher">
				</form>
			</div>
			<div class="table-responsive">
				<h6>All Vouchers Generated</h6>
				<table class="table table-bordered w-100" id="dt-filter">
					<thead class="thead-light">
						<tr>
							<th>ID</th>
							<th>Pin</th>
							<th>Used</th>
							<th>Worth</th>
							<th>Generated</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($vouchers as $key => $voucher): ?>
						<tr>
							<td><?=$voucher['id']?></td>
							<td><a href="javascript:;"><?=$voucher['pin']?></a></td>
							<td><?=empty($voucher['used'])?'Not Yet':$voucher['usedBy']?></td>
							<td>₦<?=$voucher['worth']?></td>
							<td><?=$voucher['genBy']?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div><!-- END: Page content-->
<script src="<?= base_url('assets/admin/vendors/DataTables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/vendors/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/vendors/summernote/dist/summernote-bs4.min.js') ?>"></script>

<script>
	$('.alert_6').click(function() {
		var name = $(this).data("prodname");
		var id = $(this).data("prodid");
		swal({
			title: 'Are you sure?',
			text: 'You want to delete' + name + 'NB: All images attached to this product MUST first be deleted!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,
			preConfirm: () => {
				return fetch('<?= base_url() ?>admin/del_product?id=' + id)
					.then(response => {
						if (!response.ok) {
							throw new Error(response.statusText)
						}
						console.log(response)
						return response.json()
					})
					.catch(error => {
						swal.showValidationError(
							`
							Request failed: $ {
								error
							}
							`
						)
					})
			},
			allowOutsideClick: () => !swal.isLoading()
		}).then((result) => {
			if (result.value) {
				swal(
					'Deleted!',
					'Your file has been deleted.',
					'success'
				)
			}
			document.location.reload();
		})
	});

	$(function() {
		// Ajax sourced data
		$('#dt-ajax-data').DataTable({
			ajax: 'assets/demo/data/datatable-data.json',
			responsive: true,
		});
		// Filter & custom search field
		$(function() {
			var table = $('#dt-filter').DataTable({
				responsive: true,
				"sDom": 'Brtip',
				buttons: [
					'copy', 'excel', 'pdf', 'csv', 'print'
				],
				columnDefs: [{
					targets: 'no-sort',
					orderable: false
				}]
			});
			$('#key-search').on('keyup', function() {
				table.search(this.value).draw();
			});
			$('#type-filter').on('change', function() {
				table.column(3).search($(this).val()).draw();
			});
		});
	});

	$('.genpin').click(function() {
		var keys = ['9','5','3','1','0','2','4','A','D','M','T'];
		var pinLen = 6;
		var pin = '';
		for (var i = pinLen - 1; i >= 0; i--) {
			let p = Math.ceil(Math.random()*10);
			pin += keys[p];
		}
		console.log(pin);
		document.querySelector('.pin').value = pin;
	})
</script>
