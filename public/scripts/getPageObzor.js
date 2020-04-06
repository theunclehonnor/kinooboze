// Клик на наш обзор
function getPageObzor(param)
{
	var data = {
		idObzor: param
	};
	var xhr = new XMLHttpRequest();
	var body = "idObzor=" + data.idObzor;
	xhr.open("GET", "../pageObzor.php?" + body, true);
	xhr.send();
	document.location.href = "../pageObzor.php?" + body;
}