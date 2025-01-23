export default {

    state: () => ({
        title: '',
    }),

    getters: {
        //person - название переменной аналогично объявленному в state()
        title: state => { //state - это обращение к блоку state

            return state.title
        },

    },
    mutations: {

        setTitle(state, title) {
            state.title = title
        },
    },

    actions: {

        setValue( { commit }, valtitle) { // commit прокидываем для обращения к мутациям

            commit('setTitle', valtitle); //обращение к SetPerson и передача значения (второй аргумент person)

        },

    }
}
