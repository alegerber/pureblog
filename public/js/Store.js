"use strict";

class Store {
    constructor() {
        this.store = null;
        this.storeName = '';
    }

    /**
     * @param storeName
     * @returns {Store}
     */
    createStore(storeName) {
        this.store = {};
        this.storeName = storeName;

        localStorage.setItem(this.storeName, JSON.stringify(this.store));

        return this
    }

    /**
     * @param storeName
     * @returns {Store}
     */
    initStore(storeName) {
        this.storeName = storeName;

        const json = localStorage.getItem(storeName);

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
            localStorage.setItem(this.storeName, JSON.stringify(this.store));
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
            localStorage.setItem(this.storeName, JSON.stringify(this.store));
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