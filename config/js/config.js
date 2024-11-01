(function( $ ) {
	
	function hideShowDiv(dispText){
		$('#zg_info_msg').hide();
		$('#zg_alert_msg').html(dispText);
		$('#zg_alert_msg').show();
		setTimeout(function(){
			$('#zg_alert_msg').hide();
			$('#zg_info_msg').show();
		}, 5000);
	}

	// Javascript for plugin config page
	function zargetConfigPage() {
	
	var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};


		$( 'button#connect_zarget' ).click(function( event ) {
			event.preventDefault();
			if($('#token').val() == ''){
				hideShowDiv('Please enter the token in the text field');
				return false;	
			}	
			var encstring = $( '#token' ).val();	
			//decoding the given string
			var decodedString = Base64.decode(encstring);
			var arrayOfStrings = decodedString.split('#');
	
			if(arrayOfStrings.length<2){
				hideShowDiv('Please enter the valid token');
				return false;
			}	
	
			zargetAPI = new NewZargetAPI( arrayOfStrings[0], arrayOfStrings[1]);
			zargetAPI.get( '', function( response ) {
				var pid = response.validate.project_id;
				var oid = response.validate.org_id;
				var userid = response.validate.user_id;
				var script = response.validate.script_source;
				$( '#project_code' ).val( script );
				$( '#org_id' ).val(oid);
				$( '#project_id' ).val(pid);
				$( '#user_id' ).val(userid);
				$( '#auth_token' ).val(arrayOfStrings[0]);
				setTimeout(function(){
					$( '#zg_approval_form').submit();
				}, 3000);
			});

		});

  
	}
	
	$( document ).ready(function() {
		zargetConfigPage();

	});

})( jQuery );

