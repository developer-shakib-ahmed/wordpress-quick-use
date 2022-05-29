jQuery(document).ready(function() {
	jQuery('table#approveWait span.spinner').css({ 'float': 'none' });
	jQuery('body.role-editor strong#unapproved').parent().parent().remove();
	var editorRowLength = jQuery('body.role-editor strong#approved').parent().parent().length;
	if(editorRowLength === 0){
		jQuery('body.role-editor table.wp-list-table tbody#the-list').append('<span class="noPost" style="color:#e74c3c;font-style:italic;font-weight:bold;display:block;min-width: 250px;padding:12px 10px;">No Post Was Found!</span>');
		jQuery('body.post-type-post span.noPost').remove();
	}
	jQuery('body.role-author strong#unapproved').parent().parent().remove();
	var authorRowLength = jQuery('body.role-author strong#approved').parent().parent().length;
	if(authorRowLength === 0){
		jQuery('body.role-author table.wp-list-table tbody#the-list').append('<span class="noPost" style="color:#e74c3c;font-style:italic;font-weight:bold;display:block;min-width: 250px;padding:12px 10px;">No Post Was Found!</span>');
	}
	jQuery('table#approveWait button.btnApprove').each(function(){
		jQuery(this).click(function(){

			var Row = jQuery(this).parent().parent();
			var ID = jQuery(this).attr('id');
			var Type = jQuery(this).attr('type');

			var Data = {
				action: 'approve',
				id: ID
			};

			jQuery.ajax({
				url: approve_url,
				data: Data,
				beforeSend: function(){
					Row.find('span.spinner').css({ 'visibility': 'visible' });
					Row.css({ 'background-color': '#ecc8c8' });
				},
				success: function(response) {
					Row.remove();
				}
			});

		});
	});
	jQuery('body.role-author table.wp-list-table tbody#the-list a.row-title').contents().unwrap();
	jQuery('body.role-author table.wp-list-table tbody#the-list div.row-actions').remove();
});