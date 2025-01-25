<template>
    <CreatePosition
        id="create_position"
        ref="modal_create_position"
    >
    </CreatePosition>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Должность</th>
                <th scope="col">Категория должности</th>
                <th scope="col">Категория комфорта</th>
                <th scope="col">Дата публикации</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="position in positions">
                <tr>
                    <td>{{ position.id }}</td>
                    <td>{{ position.title }}</td>
                    <td>{{ position.category_position.title }}</td>
                    <td>
                        <div v-for="cat_comfort in position.category_comfort">
                            {{ cat_comfort.title }}
                        </div>
                    </td>
                    <td>{{ position.date_created }}</td>
                    <td></td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>


</template>

<script>
import CreatePosition from "./Create.vue";

export default {
    name: "Position",
    components: {
        CreatePosition,
    },
    data() {
        return {
            positions: ''
        }
    },

    mounted() {
        this.$store.commit('setTitle', 'Должности')
        this.getPosition()
    },

    methods: {
        getPosition() {
            axios.get('/api/position')
                .then(res => {
                    console.log(res.data.data)
                    this.positions = res.data.data
                })
        },
    }


}
</script>

<style scoped>

</style>

