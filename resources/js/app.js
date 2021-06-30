import Vue from 'vue'
import Home from './components/Home';
import Clients from './components/Clients';
import Stocks from './components/Stocks';
import ClientsStocks from './components/ClientsStocks';

require("./bootstrap");

const app = new Vue({
    el: '#app',
    components: {
        Home,
        Clients,
        Stocks,
        ClientsStocks
    }
});