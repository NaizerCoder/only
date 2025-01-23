<template>
    <div class="m-2">
<!--        <router-link :to="{name:'post.create'}">-->
<!--            <button class="btn btn-primary">Добавить</button>-->
<!--        </router-link>-->
    </div>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col">Заголовок</th>
                <th scope="col">Категория</th>
                <th scope="col">Дата публикации</th>
                <th scope="col" class="w-25">Текст</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</template>

<script>

export default {
    name: "User",

}
</script>

<style scoped>

</style>
