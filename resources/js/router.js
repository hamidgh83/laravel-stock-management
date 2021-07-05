import Vue from "vue";
import Router from "vue-router";
import Stocks from "./components/Stocks";
import Clients from "./components/Clients";
import ClientsStocks from "./components/ClientsStocks";

Vue.use(Router);

const router = new Router({
  base: "/",
  mode: "history",
  routes: [
    {
      path: "/",
      name: "default",
      component: Stocks,
      meta: {
        title: "Stocks"
      }
    },
    {
      path: "/client",
      name: "clients",
      component: Clients,
      meta: {
        title: "Clients"
      }
    },
    {
      path: "/client/:id/stocks",
      name: "clientStocks",
      component: ClientsStocks,
      meta: {
        title: "Client stocks"
      }
    }
  ]
});

router.beforeEach((to, from, next) => {
  return next();
});

export default router;
