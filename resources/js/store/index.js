import { createStore } from "vuex";

const modules = {
    module: {
        state() {
            return {
                test: "It works!",
            };
        },
        getters: {
            getTest: (state) => state.test,
        },
        mutations: {},
        actions: {},
    },
};

const store = createStore({
    modules,
});

export default store;
