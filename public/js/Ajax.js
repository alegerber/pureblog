"use strict";

class Ajax {
    /**
     * @param url
     */
    constructor(url) {
        this.url = url;
    }

    /**
     * @param callback
     */
    get(callback) {
        this.xhttp = new XMLHttpRequest();
        this.xhttp.open('GET', this.url, true);

        if(typeof callback !== 'undefined') {
            this.xhttp.onload = callback;
        }

        this.xhttp.send();
    }

    /**
     * @param string
     * @param contentType
     * @param callback
     */
    post(string, contentType, callback) {
        this.xhttp = new XMLHttpRequest();
        this.xhttp.open('POST', this.url, true);
        this.setRequestHeader(contentType);

        if(typeof callback !== 'undefined') {
            this.xhttp.onload = callback;
        }

        this.xhttp.send(string);
    }

    /**
     * @param string
     * @param contentType
     * @param callback
     */
    put(string, contentType, callback) {
        this.xhttp = new XMLHttpRequest();
        this.xhttp.open('PUT', this.url, true);
        this.setRequestHeader(contentType);

        if(typeof callback !== 'undefined') {
            this.xhttp.onload = callback;
        }

        this.xhttp.send(string);
    }
    delete(callback) {
        this.xhttp = new XMLHttpRequest();
        this.xhttp.open('DELETE', this.url, true);

        if(typeof callback !== 'undefined') {
            this.xhttp.onload = callback;
        }

        this.xhttp.send();
    }

    /**
     * @param contentType
     */
    setRequestHeader(contentType) {
        switch(contentType) {
            case 'text':
                this.xhttp.setRequestHeader("Content-type", "application/text");
                break;
            case 'html':
                this.xhttp.setRequestHeader("Content-type", "application/html");
                break;
            case 'x-www-form-urlencoded':
                this.xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                break;
            default: //json
                this.xhttp.setRequestHeader("Content-type", "application/json");
        }
    }
}