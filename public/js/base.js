ajax = new Ajax('/views/base.html');
ajax.get(function (xhttp) {
    document.createElement("body");
    document.body.innerHTML = xhttp.responseText;
});
