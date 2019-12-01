"use strict";

class Store {
    constructor() {
        this.store = null;
        this.storeName = '';
        this.storage = null;
    }

    /**
     * @param storeName
     * @param storage
     * @returns {Store}
     */
    createStore(storeName, storage) {
        this.store = {};
        this.storeName = storeName;

        if (typeof storage === 'undefined') {
            this.storage = storage;
        } else {
            this.storage = localStorage;
        }

        this.storage.setItem(this.storeName, JSON.stringify(this.store));

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