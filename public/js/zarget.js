(function( $ ) {

	NewZargetAPI = function(token,orgid) {
		this.outstandingRequests = 0;
		this.token = token;
		this.orgid = orgid;
	}

	NewZargetAPI.prototype.call = function( type, appender, data, callback ) {
		var self = this;
		var options = {
			url: 'admin.php?token='+this.token+'&orgid='+this.orgid,
			type: type,
			contentType: 'application/json',
			dataType: "json",
			success: function( response ) {
				$('#zg_info_msg').hide();
				self.outstandingRequests -= 1;
				callback( response );
				$('#zg_info_msg').hide();	
				$('#zg_disp_msg').show();
			},
			error: function(req, status, err){
				alert('something went wrong '+ status + err);
				$('#zg_disp_msg').html(err);
				$('#zg_disp_msg').removeClass('ZAPIsuccess').addClass('ZAPIwarning');
                                $('#zg_disp_msg').show();
			}
		};
		this.outstandingRequests += 1;
		$.ajax( options );
	}

	NewZargetAPI.prototype.get = function( appender, callback ) {
		this.call( 'GET', appender, '', callback );
	}
})(  jQuery  );

