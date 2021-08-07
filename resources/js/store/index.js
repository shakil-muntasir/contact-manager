import { createStore } from "vuex";

import user from "./modules/user";

const modules = {
    user,
};

const store = createStore({
    modules,
});

export default store;
