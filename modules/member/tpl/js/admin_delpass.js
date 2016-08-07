jsux.fn = {

	returnToURL: function () {

		var table_name = $('input[name=table_name]').val(),
			url = '../member/member.admin.php?table_name=' + table_name + '&action=list&pagetype=member';

		return url;
	},

	sendJSON: function() {

		var self = this,
			params = {
				table_name: $('input[name=table_name]').val(),
				memberid: $('input[name=memberid]').val(),
				id :$('input[name=id]').val()
			};	

		jsux.getJSON('member.admin.php?action=record_delete', params, function( e )  {

			trace( e.msg );

			if (e.result == 'Y') {
				jsux.goURL( self.returnToURL() );
			}
		});
	},
	setEvent: function() {

		var self = this;

		$('.articles .del .box ul > li > a').on('click', function( e ) {

			var key = $(this).data('key');

			if (key == 'del') {
				self.sendJSON();
			} else if (key == 'back') {
				jsux.goURL( self.returnToURL() );
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};