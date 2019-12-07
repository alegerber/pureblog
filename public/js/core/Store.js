"use strict";

class Store {
    constructor() {
        this.store = null;
        this.storeName = '';
        this.storage = null;
        this.ajax = null;
    }

    /**
     * @param storeName
     * @param storage
     * @param autoloadUrl
     * @returns {Store}
     */
    createStore(storeName, storage, autoloadUrl) {
        this.store = {};
        this.storeName = storeName;

        if (typeof storage === 'undefined') {
            this.storage = storage;
        } else {
            this.storage = localStorage;
        }

        if (typeof autoloadUrl !== 'undefined') {
            this.ajax = new Ajax(false);
            this.ajax.tempObject = this;
            this.ajax.get(autoloadUrl, function (xhttp) {
                xhttp.tempObject.store = JSON.parse(xhttp.responseText);

                xhttp.tempObject.storage.setItem(xhttp.tempObject.storeName, JSON.stringify(xhttp.tempObject.store));
            });
        } else {
            this.storage.setItem(this.storeName, JSON.stringify(this.store));
        }

        return this
    }

    /**
     * @param storeName
     * @returns {Store}
     */
    initStore(storeName) {
        this.storeName = storeName;

        const json = this.storage.getItem(storeName);

        if (json !== null) {
            this.store = JSON.parse(json);
        }

        return this
    }

    /**
     * @param itemName
     * @param itemValue
     * @returns {Store}
     */
    addItem(itemName, itemValue) {
        if (typeof this.store.itemName === 'undefined') {
            this.store.itemName = itemValue;
            this.storage.setItem(this.storeName, JSON.stringify(this.store));
        }

        return this
    }

    /**
     * @param itemName
     * @param itemValue
     * @returns {Store}
     */
    setItem(itemName, itemValue) {
        if (typeof this.store.itemName !== 'undefined') {
            this.store.itemName = itemValue;
            this.storage.setItem(this.storeName, JSON.stringify(this.store));
        }

        return this
    }

    /**
     * @param itemName
     * @returns {null|*}
     */
    getItem(itemName) {
        if (typeof this.store.itemName !== 'undefined') {

            return this.store.itemName
        }

        return null;
    }
}