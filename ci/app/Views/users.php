</div>
<div>
	<link href="<?= base_url('assets/admin/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/admin/summernote/summernote-bs4.css') ?>" rel="stylesheet" />

	<div class="card">
		<div class="card-body">
			<h5 class="box-title">All Registered Users</h5>
			<div class="flexbox mb-4">
				<div class="flexbox"><label class="mb-0 mr-2">Type:</label><select class="selectpicker form-control show-tick" id="type-filter" title="Please select" data-width="150px">
						<option value="">All</option>
					</select></div>
				<div class="input-group-icon input-group-icon-right mr-3"><span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span><input class="form-control form-control-rounded" id="key-search" type="text" placeholder="Search ..."></div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered w-100" id="dt-filter">
					<thead class="thead-light">
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Balance</th>
							<th>Email</th>
							<th>Ref</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $key => $user): ?>
						<tr>
							<td><?=$user['id']?></td>
							<td><a href="javascript:;"><?=$user['sname'].' '.$user['fname']?></a></td>
							<td><?=$user['phone']?></td>
							<td>₦<?=$user['bal']?></td>
						
							<td><?=$user['email']?></td>
							
							<!-- <td><span class="badge badge-success badge-pill">Shipped</span></td> -->
							<td><?=empty($user['ref'])?'No Ref':$user['ref']?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div><!-- END: Page content-->
<script src="<?= base_url('assets/admin/DataTables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/summernote/summernote-bs4.min.js') ?>"></script>

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
</script>
