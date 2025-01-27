<template>
        <CreateTrip
            id="create_trip"
            ref="modal_create_trip"
        >
        </CreateTrip>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col" style="width: 10%">Пассажир</th>
                <th scope="col" style="width: auto">Автомобиль</th>
                <th scope="col">Категория комфорта</th>
                <th scope="col">Дата начала</th>
                <th scope="col">Дата окончания</th>
                <th scope="col">Статус</th>
                <th scope="col" class="text-center">Действие</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="trip in trips">
                <tr>
                    <td>{{trip.employee.surname}} {{trip.employee.name}} {{trip.employee.patronymic}}</td>
                    <td>{{trip.car.model}}</td>
                    <td>{{trip.car.category_comfort.title}}</td>
                    <td>{{trip.date_start}}</td>
                    <td>{{trip.date_end}}</td>
                    <td>{{trip.status}}</td>
                    <td></td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>

</template>

<script>

import CreateTrip from "./Create.vue";

export default {
    name: "Car",
    components: {CreateTrip},
    data() {
        return {
            trips: '',
        }
    },

    mounted() {
        this.$store.commit('setTitle', 'Служебные поездки')
        this.getTrips()
    },

    methods: {
        getTrips() {
            axios.get('/api/trip')
                .then(res => {
                    console.log(res.data.data)
                    this.trips = res.data.data
                })
        },

    }


}
</script>

<style scoped>

</style>


