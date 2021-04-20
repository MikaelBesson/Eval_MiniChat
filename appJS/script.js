
const requestURL = "../messages.php";

let xhr = new XMLHttpRequest();
xhr.open("POST", requestURL);

xhr.responseType = "json";
xhr.send();