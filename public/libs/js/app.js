(function(exports) {

	function REST(method, url, data) {
		if (data !== undefined)
			data = JSON.stringify(data);
		return $.ajax({
			type: method,
			url: url,
			data: data,
			contentType: 'application/json',
			error: function(jqxhr, textStatus, errorThrown) {
				var res = jqxhr.responseText;
				try {
					jqxhr.err = $.parseJSON(res);
				} catch (e) {
					jqxhr.err = {
						code: 'unknown-error',
						message: 'Unknown Error',
						data: {
							response: res
						}
					};
				}
			}
		});
	}

	function mkREST(method) {
		return function (url, data) {
			return REST(method, url, data);
		};
	}

	var GET = mkREST('GET');
	var PUT = mkREST('PUT');
	var POST = mkREST('POST');
	var DELETE = mkREST('DELETE');
	
	// Encodes an image file to base 64 and outputs the result in a input field.
	var ToB64 = function(file, output) {
		var reader = new FileReader();
		reader.onloadend = function() {
			output.val(reader.result);
		}
		reader.readAsDataURL(file);
	};
	
	// On file input, clears previous stored base64, then checks before encoding it.
	var fileInput = function(file, output, msg) {
		output.val('');

		var fileSize = file.size;
		if (fileSize <= Math.pow(2,20)) {
			var img = new Image(),
				imgwidth = 0,
				imgheight = 0,
				maxwidth = 1920,
				maxheight = 1080;
			img.src = window.URL.createObjectURL(file);
			img.onload = function() {
				imgwidth = this.width;
				imgheight = this.height;
				if (imgwidth <= maxwidth && imgheight <= maxheight) {
					ToB64(file, output);
					msg.html('<span class="green-text text-darken-2">Image ok.</span>');
				}
				else {
					msg.html('<span class="red-text text-darken-2">La taille de l\'image dépasse les ' + maxwidth + 'x' + maxheight + ' pixels.</span>');
				}
			}
		}
		else {
			msg.html('<span class="red-text text-darken-2">Le poids de l\'image dépasse les 1Mo.</span>');
		}
	}
	
	exports.app = {
		GET: GET,
		PUT: PUT,
		POST: POST,
		DELETE: DELETE,
		encodeFileToB64: ToB64,
		checkFileAndEncode: fileInput
	};

})(this);
