"use strict";

class View {
    constructor() {
        this.ajax = new Ajax(false);
        this.ajax.get('/views/base.html',function (xhttp) {
            document.body = document.createElement("body");
            document.body.innerHTML = xhttp.responseText;
        });
    }

    blog() {
        const store = new Store();
        store.createStore('blogItem', localStorage);
        this.ajax.get('/views/blog/post.html', function (xhttp) {
            document.body.main.innerHTML = xhttp.responseText;
        });
    }
}