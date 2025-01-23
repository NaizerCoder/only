import {createApp} from "vue/dist/vue.esm-bundler"
import {createStore} from "vuex/dist/vuex.esm-bundler.js";
import Post from './modules/post';

const store = createStore({
    modules: {
        Post
    },
})
export default store
