import axios from "axios";

export default {
    state() {
        return {
            user: null,
        };
    },
    getters: {
        getUser: (state) => state.user,
    },
    mutations: {
        setUser: (state, payload) => (state.user = payload),
    },
    actions: {
        fetchAuthUser: ({ state, commit }) => {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/user")
                    .then((response) => {
                        commit("setUser", response.data);

                        resolve(response.data);
                    })
                    .catch((error) => reject(error.response.data));
            });
        },
    },
};
