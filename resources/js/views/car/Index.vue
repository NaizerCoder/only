<template>
    <CreateCar
        id="create_car"
        ref="modal_create_car"
    >
    </CreateCar>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Модель</th>
                <th scope="col">Год выпуска</th>
                <th scope="col">Категория комфорта</th>
                <th scope="col">Дата публикации</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="car in cars">
                <tr>
                    <td>{{car.id}}</td>
                    <td>{{car.model}}</td>
                    <td>{{car.year}}</td>
                    <td>{{car.category_comfort.title}}</td>
                    <td>{{car.date_created}}</td>
                    <td></td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>

</template>

<script>
import CreateCar from "@/views/car/Create.vue";

export default {
    name: "Car",
    components: {
        CreateCar,
    },
    data() {
        return {
            cars: ''
        }
    },

    mounted() {
        this.$store.commit('setTitle', 'Автомобили')
        this.getCars()
    },

    methods: {
        getCars() {
            axios.get('/api/car')
                .then(res => {
                    //console.log(res.data.data)
                    this.cars = res.data.data
                })
        },
    }


}
</script>

<style scoped>

</style>


