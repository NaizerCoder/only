<template>
    <CreateCategoryPosition
        id="create_cat"
        ref="modal_create_cat"
    >
    </CreateCategoryPosition>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Категория</th>
                <th scope="col">Описание</th>
                <th scope="col">Дата публикации</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="category in categories">
                <tr>
                    <td>{{ category.id }}</td>
                    <td>{{ category.title }}</td>
                    <td>{{ category.description }}</td>
                    <td>{{ category.date_created }}</td>
                </tr>

            </template>
            </tbody>
        </table>
    </div>


</template>

<script>
import CreateCategoryPosition from "./Create.vue";

export default {
    name: "CategoryPosition",
    components: {
        CreateCategoryPosition,
    },
    data() {
        return {
            categories: {}
        }
    },

    mounted() {
        this.$store.commit('setTitle', 'Категории должностей')
        this.getCategories()
    },

    methods: {
        getCategories() {
            axios.get('/api/category_position')
                .then(res => {
                    this.categories = res.data.data
                })
        },
    }


}
</script>

<style scoped>

</style>
