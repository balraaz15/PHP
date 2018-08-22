function main() {
	const btn = document.querySelector('#clickme');
	btn.addEventListener('click', apple);
}

function apple() {
	const xmlHttp = new XMLHttpRequest();

	xmlHttp.open('GET', 'request.php', true);

	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState > 3) {
			const datedisp = document.querySelector('#date');
			datedisp.innerHTML = xmlHttp.responseText;
		}
	};

	xmlHttp.send();
}

document.addEventListener('DOMContentLoaded', main);