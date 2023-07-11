$(document).ready(function () {
	$('table.dataTables').each(function () {
		$('#' + $(this).attr('id')).DataTable({
			"language": {
				"emptyTable": '<div class="text-center p-4">' +
					'<img class="mb-3" src="assets/dist/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
					'<p class="mb-0">No data to display</p>' +
					'</div>'
			},
			"scrollX": true,
			"responsive": true
		});
	});
});