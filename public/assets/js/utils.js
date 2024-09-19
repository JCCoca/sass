function time(datetime = null, options=""){
	let result = new Date().getTime();

	if (datetime != null && datetime.toLowerCase().trim() != "now") {
		if (datetime.search(/\d{2}:\d{2}:\d{2}/g) != -1) {
			result = new Date(datetime.trim().replaceAll(/\-\:/gi, " ")).getTime();
		}
		else{
			result = new Date((datetime.trim()+" 00:00:00").replaceAll(/\-\:/gi, " ")).getTime();
		}
	}

	let aux = options.trim().split(" ");

	if (aux.length == 2) {
		let number = Number(aux[0].replaceAll(/\s/gi, ""));

		switch (aux[1].trim().toLowerCase()) {
			case "year":
			case "years":
				result = new Date(result).setFullYear(new Date(result).getFullYear() + number);
				break;
			case "month":
			case "months":
				result = new Date(result).setMonth(new Date(result).getMonth() + number);
				break;
			case "week":
			case "weeks":
				result = new Date(result).setDate(new Date(result).getDate() + (number * 7));
				break;
			case "day":
			case "days":
				result = new Date(result).setDate(new Date(result).getDate() + number);
				break;
			case "hour":
			case "hours":
				result = new Date(result).setHours(new Date(result).getHours() + number);
				break;
			case "minute":
			case "minutes":
				result = new Date(result).setMinutes(new Date(result).getMinutes() + number);
				break;
			case "second":
			case "seconds":
				result = new Date(result).setSeconds(new Date(result).getSeconds() + number);
				break;
		}
	}

	return result;
}

function date(format, timestamp = new Date().getTime()){
	let date = new Date(timestamp);

	format = format.replaceAll("%d", (date.getDate() > 9) ? date.getDate() : "0"+date.getDate());
	format = format.replaceAll("%j", date.getDate());
	format = format.replaceAll("%m", (date.getMonth()+1 > 9) ? Number(date.getMonth())+1 : "0"+(Number(date.getMonth())+1));
	format = format.replaceAll("%n", Number(date.getMonth())+1);
	format = format.replaceAll("%Y", date.getFullYear());
	format = format.replaceAll("%y", String(date.getFullYear()).substr(2));
	format = format.replaceAll("%g", (date.getHours() > 12) ? date.getHours()-12 : date.getHours());
	format = format.replaceAll("%G", date.getHours());
	format = format.replaceAll("%h", (date.getHours() > 12) ? ((date.getHours()-12 > 9) ? date.getHours()-12 : "0"+(date.getHours()-12)) : ((date.getHours() > 9) ? date.getHours() : "0"+date.getHours()));
	format = format.replaceAll("%H", (date.getHours() > 9) ? date.getHours() : "0"+date.getHours());
	format = format.replaceAll("%i", (date.getMinutes() > 9) ? date.getMinutes() : "0"+date.getMinutes());
	format = format.replaceAll("%s", (date.getSeconds() > 9) ? date.getSeconds() : "0"+date.getSeconds());
	format = format.replaceAll("%u", date.getMilliseconds());
	format = format.replaceAll("%L", (date.getFullYear() % 4 == 0) ? 1 : 0);
	format = format.replaceAll("%w", date.getDay());
	format = format.replaceAll("%W", date.toLocaleString(window.JCUtils.location, {weekday: "long"}));
	format = format.replaceAll("%F", date.toLocaleString(window.JCUtils.location, {month: "long"}));
	format = format.replaceAll("%R", date.toLocaleString(window.JCUtils.location, {weekday: "long", year: "numeric", month: "long", day: "numeric"}));
	format = format.replaceAll("%N", (date.getDay() == 0) ? 7 : date.getDay());
	format = format.replaceAll("%z", Math.round((date.getTime() - new Date(`${date.getFullYear()} 01 01 ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`).getTime()) / (24 * 60 * 60 * 1000)));
	format = format.replaceAll("%a", (date.getHours() > 12) ? "pm" : "am");
	format = format.replaceAll("%A", (date.getHours() > 12) ? "PM" : "AM");

	if (
		date.getMonth() == 0 || 
		date.getMonth() == 2 || 
		date.getMonth() == 4 || 
		date.getMonth() == 6 || 
		date.getMonth() == 7 || 
		date.getMonth() == 9 || 
		date.getMonth() == 11  
	) {
		format = format.replaceAll("%t", 31);
	}
	else if (
		date.getMonth() == 3 || 
		date.getMonth() == 5 || 
		date.getMonth() == 8 || 
		date.getMonth() == 10 
	) {
		format = format.replaceAll("%t", 30);
	}
	else{
		format = format.replaceAll("%t", (date.getFullYear() % 4 == 0) ? 29 : 28);
	}

	return format;
}

function dateDiff(datetime1, datetime2, resultIn = "days"){
	let d1 = new Date((datetime1.search(/\d{2}:\d{2}:\d{2}/g) != -1) ? datetime1.trim().replaceAll(/\-\:/gi, " ") : (datetime1.trim()+" 00:00:00").replaceAll(/\-\:/gi, " "));
	let d2 = new Date((datetime2.search(/\d{2}:\d{2}:\d{2}/g) != -1) ? datetime2.trim().replaceAll(/\-\:/gi, " ") : (datetime2.trim()+" 00:00:00").replaceAll(/\-\:/gi, " "));

	let result;

	switch (resultIn.trim().toLowerCase()) {
		case "year":
		case "years":
			result = d1.getFullYear() - d2.getFullYear();
			break;
		case "month":
		case "months":
			result = (d1.getMonth()+12 * d1.getFullYear())-(d2.getMonth()+12 * d2.getFullYear());
			break;
		case "week":
		case "weeks":
			result = (d1.getTime() - d2.getTime()) / (7 * 24 * 60 * 60 * 1000);
			break;
		case "day":
		case "days":
			result = (d1.getTime() - d2.getTime()) / (24 * 60 * 60 * 1000);
			break;
		case "hour":
		case "hours":
			result = (d1.getTime() - d2.getTime()) / (60 * 60 * 1000);
			break;
		case "minute":
		case "minutes":
			result = (d1.getTime() - d2.getTime()) / (60 * 1000);
			break;
		case "second":
		case "seconds":
			result = (d1.getTime() - d2.getTime()) / 1000;
			break;
	}

	return Math.abs(Math.round(result));
}

function dateFormat(datetime, location = window.JCUtils.location, options = {}){
	let result;

	if (datetime.search(/\d{2}:\d{2}:\d{2}/g) != -1) {
		result = new Date(datetime.trim().replaceAll(/\-\:/gi, " "));
	}
	else{
		result = new Date((datetime.trim()+" 00:00:00").replaceAll(/\-\:/gi, " "));
		options = (Object.keys(options).length == 0) ? {year: "numeric", month: "numeric", day: "numeric"} : options;
	}

	return result.toLocaleString(location, options);
}

function numberFormat(number, location = window.JCUtils.location, options = {minimumFractionDigits: 2}) {
	return Number(number).toLocaleString(location, options);
}

function moneyFormat(number, location = window.JCUtils.location, currency = window.JCUtils.currency) {
	return Number(number).toLocaleString(location, {style: "currency", currency: currency});
}

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

function empty(variable){
	switch (typeof variable) {
		case "string":
			if (variable == 0) {
				return true;
				break;
			}
			return (variable.length > 0) ? false : true;
			break;
		case "number":
			return (variable == 0 || isNaN(variable)) ? true : false;
			break;
		case "object":
			if (variable === null) {
				return true;
			}
			else{
				return (Object.keys(variable).length > 0) ? false : true;
			}
			break;
		case "undefined":
			return true;
			break;
		case "boolean":
			return (variable == false) ? true : false;
			break;
		case "function":
			return false;
			break;
		default:
			return true;
	}
}

function foreach(data, callback){
	switch (typeof data) {
		case "object":
			if (data !== null) {
				if (Array.isArray(data)) {
					for (let i=0; i < data.length; i++) {
						callback(i, data[i]);
					}
				}
				else{
					let keys = Object.keys(data);
					for (let i=0; i < keys.length; i++) {
						callback(keys[i], data[keys[i]]);
					}
				}
			}
			else{
				throw "Invalid data format in 'foreach'"; 
			}
			break;
		case "string":
			for (let i=0; i < data.length; i++) {
				callback(i, data[i]);
			}
			break;
		default:
			throw "Invalid data format in 'foreach'"; 
			break;
	}
}

function map(data, callback){
	let result = [];
	let aux;

	switch (typeof data) {
		case "object":
			if (data !== null) {
				if (Array.isArray(data)) {
					for (let i=0; i < data.length; i++) {
						aux = callback(data[i], i);
						if (aux != undefined) {
							result.push(aux);
						}
					}
				}
				else{
					let keys = Object.keys(data);
					for (let i=0; i < keys.length; i++) {
						aux = callback(data[keys[i]], keys[i]);
						if (aux != undefined) {
							result.push(aux);
						}
					}
				}
			}
			else{
				throw "Invalid data format in 'map'";
			}
			break;
		case "string":
			for (let i=0; i < data.length; i++) {
				aux = callback(data[i], i);
				if (aux != undefined) {
					result.push(aux);
				}
			}
			break;
		default:
			throw "Invalid data format in 'map'"; 
			break;
	}

	return result;
}

function objectMerge(object1, object2){
	if (
		typeof object1 === "object" && 
		typeof object2 === "object" && 
		Array.isArray(object1) == false && 
		Array.isArray(object2) == false
	) {
		let result = object2;
		let keys = Object.keys(object1);

		for (let i=0; i < keys.length; i++) {
			result[keys[i]] = object1[keys[i]];
		}

		return result;
	}
	else{
		throw "Invalid data format in 'objectMerge'"; 
	}
}

function arrayMerge(array1, array2){
	if (Array.isArray(array1) && Array.isArray(array2)) {
		let result = array1;

		for (let i=0; i < array2.length; i++) {
			if (result.includes(array2[i]) == false) {
				result.push(array2[i]);
			}
		}

		return result;
	}
	else{
		throw "Invalid data format in 'arrayMerge'"; 
	}
}

function serialize(element){
	if (element.nodeName === "FORM") {
		return new URLSearchParams(Array.from(new FormData(element))).toString();
	}
	else{
		throw "Invalid element type in 'serialize'";
	}
}

function serializeObject(element){
	if (element.nodeName === "FORM") {
		let formData = new FormData(element);
		let result = {};

		for (let key of formData.keys()) {
			result[key] = formData.get(key);
		}

		return result;
	}
	else{
		throw "Invalid element type in 'serializeObject'";
	}
}

function serializeArray(element){
	if (element.nodeName === "FORM") {
		let formData = new FormData(element);
		let result = [];

		for (let key of formData.keys()) {
			result.push({name: key, value: formData.get(key)});
		}

		return result;
	}
	else{
		throw "Invalid element type in 'serializeArray'";
	}
}

function parseXML(string){
	if (typeof string === "string") {
		return new DOMParser().parseFromString(string, "text/xml");
	}
	else{
		throw "Invalid data format in 'parseXML'";
	}
}

function parseHTML(string){
	if (typeof string === "string") {
		return new DOMParser().parseFromString(string, "text/html").firstChild.childNodes[1].childNodes;
	}
	else{
		throw "Invalid data format in 'parseHTML'";
	}
}

function parseJSON(string){
	if (typeof string === "string") {
		return JSON.parse(string);
	}
	else{
		throw "Invalid data format in 'parseJSON'";
	}
}

function stringToObject(string){
	if (typeof string === "string") {
		let object = {};
		let aux;

		if (string.search(":") !== -1) {
			if (string.search(",") !== -1) {
				string.split(",").forEach(function(obj){
					aux = obj.split(":");
					object[aux[0]] = aux[1];
				});
			}
			else{
				aux = string.split(":");
				object[aux[0]] = aux[1];
			}
		}
		else if (string.search("=") !== -1) {
			if (string.search("&") !== -1) {
				string.split("&").forEach(function(obj){
					aux = obj.split("=");
					object[aux[0]] = aux[1];
				});
			}
			else{
				aux = string.split("=");
				object[aux[0]] = aux[1];
			}
		}
		else{
			throw "String in invalid format to convert to Object in 'stringToObject'";
		}

		return object;
	}
	else{
		throw "Invalid data format in 'stringToObject'";
	}
}