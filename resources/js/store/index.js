import { createStore } from 'vuex'

import user from './modules/user'
import contact from './modules/contact'

const modules = {
    user,
    contact
}

const store = createStore({
    modules
})

export default store
