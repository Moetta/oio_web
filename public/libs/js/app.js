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
	var LOG = function () { return 'salut'; };
	
	exports.app = {
		GET: GET,
		PUT: PUT,
		POST: POST,
		DELETE: DELETE,
		LOG: LOG
	};

})(this);
