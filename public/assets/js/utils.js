function getURLParams(key = null){
	let url = new URL(window.location);
	let result = {};

	if (key != null) {
		result = url.searchParams.getAll(key);
	}
	else{
		url.searchParams.forEach(function(v, k){
			if (result[k] == undefined) {
				result[k] = v;
			}
			else if (typeof result[k] == "object") {
				result[k].push(v);
			}
			else{
				result[k] = [result[k], v];
			}
		});
	}

	return (key != null) ? ((result.length > 0) ? ((result.length == 1) ? result[0] : result) : undefined) : result;
}

function setURLParams(key, value){
	let url = new URL(window.location);
	
	if (typeof value == "object") {
		url.searchParams.delete(key);

		value.forEach(function(v){
			if (typeof v != "object") {
				url.searchParams.append(key, v);
			}
		});
	}
	else{
		url.searchParams.set(key, value);
	}

	window.history.pushState("", "", url);
}

function removeURLParams(key){
	let url = new URL(window.location);

	url.searchParams.delete(key);

	window.history.pushState("", "", url);
}

function removeAllURLParams(){
	window.history.pushState("", "", window.location.href.replace(window.location.search, ""));
}

function hasURLParams(key){
	let url = new URL(window.location);

	return url.searchParams.has(key);
}