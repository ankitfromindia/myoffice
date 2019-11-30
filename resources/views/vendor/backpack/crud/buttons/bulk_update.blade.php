@if ($crud->hasAccess('update') && $crud->bulk_actions)
	<a href="javascript:void(0)" onclick="bulkUpdateEntries(this)" class="btn btn-default btn-sm bulk-button"><i class="fa fa-edit"></i> {{ trans('backpack::crud.update') }}</a>
@endif

@push('after_scripts')
<script>
	if (typeof bulkUpdateEntries != 'function') {
	  function bulkUpdateEntries(button) {

	      if (typeof crud.checkedItems === 'undefined' || crud.checkedItems.length == 0)
	      {
	      	new PNotify({
	              title: "{{ trans('backpack::crud.bulk_no_entries_selected_title') }}",
	              text: "{{ trans('backpack::crud.bulk_no_entries_selected_message') }}",
	              type: "warning"
	          });

	      	return;
	      }

	      var message = ("{{ trans('backpack::crud.bulk_update_are_you_sure') }}").replace(":number", crud.checkedItems.length);
	      var button = $(this);

	      // show confirm message
	      if (confirm(message) == true) {
	      	  var ajax_calls = [];
      		  var update_route = "{{ url($crud->route) }}/bulkUpdate/create";
      		  window.location.href=update_route + '?entries=' + crud.checkedItems
	      	
	      }
      }
	}
</script>
@endpush