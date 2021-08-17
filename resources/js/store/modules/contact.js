import axios from 'axios'

export default {
    state() {
        return {
            contacts: [],
            contact: null,
            form: null,
            errors: null
        }
    },
    getters: {
        getContacts: state => state.contacts,
        getContact: state => state.contact,
        getContactForm: state => state.form,
        getContactErrors: state => state.errors
    },
    mutations: {
        setContacts: (state, payload) => (state.contacts = payload),
        setContact: (state, payload) => (state.contact = payload),
        setContactForm: (state, payload) => (state.form = payload),
        setContactErrors: (state, payload) => (state.errors = payload)
    },
    actions: {
        createContact: ({ commit }, payload) => {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.post('/api/contacts', payload)
                    commit('setContact', response.data)
                    resolve(response)
                } catch (error) {
                    commit('setContactErrors', error.response.data.errors)
                    reject(error)
                }
            })
        },
        fetchContacts: ({ commit }) => {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get('/api/contacts')
                    commit('setContacts', response.data)
                    resolve(response)
                } catch (error) {
                    reject(error)
                    console.log(error)
                }
            })
        },
        fetchContact: ({ commit }, contact_id) => {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(`/api/contacts/${contact_id}`)
                    commit('setContact', response.data)
                    resolve(response)
                } catch (error) {
                    reject(error)
                    console.log(error)
                }
            })
        },
        fetchContactForm: ({ commit }, contact_id) => {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.get(`/api/contacts/${contact_id}`)
                    commit('setContactForm', response.data.data.attributes)
                    resolve(response)
                } catch (error) {
                    reject(error)
                    console.log(error)
                }
            })
        },
        updateContact: ({ commit }, { contact_id, payload }) => {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.patch(`/api/contacts/${contact_id}`, payload)
                    commit('setContact', response.data)
                    resolve(response)
                } catch (error) {
                    commit('setContactErrors', error.response.data.errors)
                    reject(error)
                }
            })
        },
        deleteContact: (_, contact_id) => {
            return new Promise(async (resolve, reject) => {
                try {
                    axios.delete(`/api/contacts/${contact_id}`)
                    resolve()
                } catch (error) {
                    reject(error)
                    console.log(error)
                }
            })
        }
    }
}
