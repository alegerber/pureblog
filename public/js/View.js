"use strict";

class View {
    constructor() {
        this.ajax = new Ajax(false);
        this.ajax.get('/views/base.html',function (xhttp) {
            document.createElement("body");
            document.body.innerHTML = xhttp.responseText;
        });
    }

    blog() {
        const store = new Store();
        store.createStore('blogItem', localStorage);
        const ajaxHtml = new Ajax('/views/blog/post.html');
        ajaxHtml.get(function (xhttp) {
        });
        const ajaxJson = new Ajax('/post/');
        ajax.get(function (xhttp) {
            document.body.main.innerHTML = xhttp.responseText;
        });
    }
}