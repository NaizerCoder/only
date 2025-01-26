<template>
    <CreateCategoryComfort
        id="create_cat"
        ref="modal_create_cat"
    >
    </CreateCategoryComfort>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Категория</th>
                <th scope="col">Описание</th>
                <th scope="col">Дата публикации</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="category in categories">
                <tr>
                    <td>{{ category.id }}</td>
                    <td>{{ category.title }}</td>
                    <td>{{ category.description }}</td>
                    <td>{{ category.date_created }}</td>
                    <td></td>
                </tr>

            </template>
            </tbody>
        </table>
    </div>


</template>

<script>
//import CreateCategoryPosition from "./Create.vue";

import CreateCategoryComfort from "@/views/category_comfort/Create.vue";

export default {
    name: "CategoryComfort",
    components: {
        CreateCategoryComfort
    },
    data() {
        return {
            categories: {}
        }
    },

    mounted() {
        this.$store.commit('setTitle', 'Категории комфорта')
        this.getCategories()
    },

    methods: {
        getCategories() {
            axios.get('/api/category_comfort')
                .then(res => {
                    this.categories = res.data.data
                })
        },
    }

}
</script>

<style>
.modal.fade {
    transition: opacity 0.15s linear;
}
</style>

