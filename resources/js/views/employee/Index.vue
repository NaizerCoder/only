<template>
    <CreateEmployee
        id="create_car"
        ref="modal_create_car"
    >
    </CreateEmployee>

    <div>
        <table class="table table-hover text-nowrap text-justify">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Должность</th>
                <th scope="col">Дата создания</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="employee in employees">
                <tr>
                    <td>{{employee.id}}</td>
                    <td>{{employee.surname}}</td>
                    <td>{{employee.name}}</td>
                    <td>{{employee.patronymic}}</td>
                    <td>{{employee.position.title}}</td>
                    <td>{{employee.date_created}}</td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>

</template>

<script>
import CreateEmployee from "@/views/employee/Create.vue";

export default {
    name: "Employee",
    components: {
        CreateEmployee

    },
    data() {
        return {
            employees: ''
        }
    },

    mounted() {
        this.$store.commit('setTitle', 'Сотрудники')
        this.getEmployees()
    },

    methods: {
        getEmployees() {
            axios.get('/api/employee')
                .then(res => {
                    //console.log(res.data.data)
                    this.employees = res.data.data
                })
        },
    }


}
</script>

<style scoped>

</style>


