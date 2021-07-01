require("./bootstrap");

import Vue from 'vue'
import Purchase from './components/Purchase';
import Clients from './components/Clients';
import Stocks from './components/Stocks';
import ClientsStocks from './components/ClientsStocks';


const app = new Vue({
    el: '#app',
    components: {
        Purchase,
        Clients,
        Stocks,
        ClientsStocks
    }
});