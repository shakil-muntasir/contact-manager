import axios from 'axios'

export default {
    state() {
        return {
            user: null
        }
    },
    getters: {
        getUser: state => state.user
    },
    mutations: {
        setUser: (state, payload) => (state.user = payload)
    },
    actions: {
        fetchAuthUser: ({ commit }) => {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get('/api/user')

                    commit('setUser', response.data)

                    resolve(response)
                } catch (error) {
                    reject(error)
                }
            })
        },
        logoutAuthUser: async () => {
            await axios.post('/logout')
            window.location.replace('/login')
        }
    }
}
