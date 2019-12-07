"use strict";

class Ajax {
    /**
     * @param async
     */
    constructor(async) {
        this.xhttp = new XMLHttpRequest();

        if(typeof async === 'undefined') {
            this.async = true;
        } else {
            this.async = async;
        }

        this.tempObject = null;
    }

    /**
     * @param url
     * @param callback
     */
    get(url, callback) {
        this.xhttp.open('GET', url, this.async);

        this.xhttp.onload = function () {
            if(typeof callback !== 'undefined') {
                callback(this);
            }
        };

        this.xhttp.send();
    }

    /**
     * @param url
     * @param string
     * @param contentType
     * @param callback
     */
    post(url, string, contentType, callback) {
        this.xhttp.open('POST', url, this.async);
        this.setXhttpRequestHeader(contentType);

        this.xhttp.onload = function () {
            if(typeof callback !== 'undefined') {
                callback(this);
            }
        };

        this.xhttp.send(string);
    }

    /**
     * @param url
     * @param string
     * @param contentType
     * @param callback
     */
    put(url, string, contentType, callback) {
        this.xhttp.open('PUT', url, this.async);
        this.setXhttpRequestHeader(contentType);

        this.xhttp.onload = function () {
            if(typeof callback !== 'undefined') {
                callback(this);
            }
        };

        this.xhttp.send(string);
    }

    /**
     * @param url
     * @param contentType
     * @param callback
     */
    delete(url, contentType, callback) {
        this.xhttp.open('DELETE', url, this.async);
        this.setXhttpRequestHeader(contentType);

        this.xhttp.onload = function () {
            if(typeof callback !== 'undefined') {
                callback(this);
            }
        };

        this.xhttp.send();
    }

    /**
     * @param contentType
     */
    setXhttpRequestHeader(contentType) {
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