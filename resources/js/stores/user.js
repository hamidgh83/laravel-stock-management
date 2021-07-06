import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    errors: [],
    hasError: false
  },
  mutations: {
    handleLoading: state => {},  
    requestFailed: (state, data) => {
      state.hasError = true;  
      Object.keys(data).forEach(element => {
        let messages = data[element];
        state.errors = messages;
      });
    },
    requestSuccess: state => {
      state.hasError = false;  
    },
    clearErrors: state => {
      state.errors = [];
      state.hasError = false;
    }
  },
  getters: {
    errorMessage: state => {
      if (state.hasError) {
        let message = _.get(state, 'errors[0]');
        return message != undefined ? message : "Unknown error!";
      }
      return null;
    },
    hasError: state => {
      return state.hasError;
    }
  }
});
