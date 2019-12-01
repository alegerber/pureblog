"use strict";

class Ajax {
    /**
     * @param url
     * @param async
     */
    constructor(url, async) {
        this.url = url;

        if(typeof async !== 'undefined') {
            this.async = true;
        } else {
            this.async = async;
        }
    }

    /**
     * @param callback
     */
    get(callback) {
        this.xhttp = new XMLHttpRequest();
        this.xhttp.open('GET', this.url, this.async);

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
        this.xhttp.open('POST', this.url, this.async);
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
        this.xhttp.open('PUT', this.url, this.async);
        this.setRequestHeader(contentType);

        if(typeof callback !== 'undefined') {
            this.xhttp.onload = callback;
        }

        this.xhttp.send(string);
    }
    delete(callback) {
        this.xhttp = new XMLHttpRequest();
        this.xhttp.open('DELETE', this.url, this.async);

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