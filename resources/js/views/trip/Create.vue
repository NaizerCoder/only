<template>
    <span class="mr-2">
        <a
            class="btn btn-primary mb-2"
            data-bs-toggle="modal"
            :data-bs-target="`#${id}`"
            title="оформить"
            @click.prevent="actionTrip"
        >
            Оформить
        </a>
    </span>

    <!-- Modal -->
    <div class="modal"
         :id="id"
         data-bs-backdrop="static"
         data-bs-keyboard="false"
         tabindex="-1"
         aria-labelledby="staticBackdropLabel"
         aria-hidden="true"
    >
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Оформление поездки</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!--EMPLOYEES-->
                    <div class="mb-1">
                        <span class="font-weight-bold">Пассажир</span>
                    </div>

                    <div class="mb-2">
                        <multiselect
                            id="single-select-object"
                            v-model="employee_id"
                            selectLabel="нажмите Enter для добавления"
                            deselectLabel="нажмите Enter для удаления"
                            placeholder="Выберите сотрудника"
                            selectedLabel="добавлено"
                            track-by="name"
                            label="name"
                            :options="employees"
                            :searchable="false"
                            :allow-empty="false"
                            aria-label="pick a value"
                            @select="selectEmployees"
                        >
                        </multiselect>
                    </div>

                    <!--CATEGORY COMFORT-->
                    <div class="mb-1">

                    </div>

                    <!--DATE START-->
                    <div class="mb-1">
                        <span class="font-weight-bold">Дата и время начала поездки</span>
                    </div>

                    <div class="mb-2 w-25">
                        <input type="datetime-local"
                               class="form-control bg-white border"
                               :class="{'border-danger': date_start.style.border_danger, 'border-success': date_start.style.border_success}"
                               id="date_start"
                               readonly
                               ref="date_start"
                               @input="eventDateStart"
                               v-model="date_start.data"
                        >
                    </div>

                    <!--DATE CLOSED-->
                    <div class="mb-1">
                        <span class="font-weight-bold">Дата и время завершения поездки</span>
                    </div>

                    <div class="mb-2 w-25">
                        <input type="datetime-local"
                               class="form-control bg-white border"
                               :class="{'border-danger': date_end.style.border_danger, 'border-success': date_end.style.border_success}"
                               id="date_start"
                               readonly
                               ref="date_end"
                               @input="eventDateEnd"
                               v-model="date_end.data"
                        >
                    </div>

                    <div v-if="this.errors.date_trip" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.date_trip
                        }}
                    </div>

                    <!--CHECK FREE CARS-->
                    <div v-if="check.button">
                        <a
                            class="btn btn-secondary btn-sm mb-2"
                            @click.prevent="checkFreeCars"
                        >
                            проверить свободные автомобили
                        </a>
                    </div>

                    <!--FREE CARS-->
                    <div v-if="check.free_cars">
                        <div class="mb-1">
                            <span class="font-weight-bold">Доступные автомобили</span>
                        </div>

                        <table class="table table-hover text-nowrap text-justify">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 20%">Модель</th>
                                <th scope="col">Категория комфорта</th>
                                <th scope="col">Год выпуска</th>
                                <th scope="col">Выбор</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="car in cars">
                                <tr>
                                    <td>{{ car.model }}</td>
                                    <td>{{ car.comfort }}</td>
                                    <td>{{ car.car_year }}</td>
                                    <td>
                                        <input type="radio"
                                               v-bind:value="{
                                                        employee_id: car.employee_id,
                                                        car_id: car.car_id,
                                                        date_start: this.date_start.data,
                                                        date_end: this.date_end.data,
                                                     }"
                                               v-model="data"
                                        >
                                    </td>
                                </tr>

                            </template>
                            </tbody>
                        </table>
                        <div v-if="cars.length === 0">
                            свободных автомобилей на заданные даты нет
                        </div>

                        <div v-if="this.errors.data" class="text-danger" style="margin: -10px 0 0 4px">{{
                                this.errors.data
                            }}
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="mod_close">Закрыть
                    </button>
                    <button
                        @click.prevent="store"
                        type="button"
                        class="btn btn-primary"
                    >
                        Оформить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    name: "CreateTrip",
    props: [
        'id',
    ],
    components: {
        Multiselect
    },
    data() {
        return {
            employee_id: '',
            employees: [],
            date_start: {
                data: '',
                style: {
                    border_danger: true,
                    border_success: false
                }
            },
            date_end: {
                data: '',
                style: {
                    border_danger: true,
                    border_success: false
                }
            },
            errors: {
                date_trip: '',
                data: ''
            },
            check: {
                button: false,
                free_cars: false
            },
            cars: '',
            data: ''
        }
    },
    methods: {
        closeModal() {
            document.getElementById('mod_close').click();
        },
        clearData() {
            this.employee_id = ''
            this.date_start.data = ''
            this.date_end.data = ''
            this.errors.data = ''
            this.errors.ate_trip = ''
            this.cars = ''
            this.check.button = false
            this.check.free_cars = false
        },
        actionTrip() {
            this.clearData()
            this.getEmployees()
        },
        getEmployees() {
            let fio_employees
            axios.get('/api/trip/create')
                .then(res => {
                    //console.log(res.data);
                    /*Все сотрудники кроме водителей*/
                    res.data.forEach((item, index) => {
                        fio_employees = item.surname + ' ' + item.name + ' ' + item.patronymic
                        this.employees.push({'name': fio_employees, 'code': item.id})
                    })
                })
        },
        selectEmployees() {
            this.date_start.style.border_danger = false
            this.date_start.style.border_success = true
            this.$refs['date_start'].readOnly = false
        },

        eventDateStart() {
            if (this.date_start.data) {
                this.date_end.style.border_danger = false
                this.date_end.style.border_success = true
                this.$refs['date_end'].readOnly = false
            } else {
                //если не заполнено поле даты начала
                this.date_end.style.border_danger = true
                this.date_end.style.border_success = false
                this.$refs['date_end'].readOnly = true

                this.date_end.data = ''
                this.check.button = false
            }
        },
        eventDateEnd() {
            if (this.date_end.data) {
                const dateStart = new Date(this.date_start.data)
                const dateEnd = new Date(this.date_end.data)

                if (dateStart.getTime() >= dateEnd.getTime()) {
                    this.errors.date_trip = 'Дата завершения поездки не может совпадать или быть раньше даты начала'
                } else {
                    this.errors.date_trip = ''
                    this.check.button = true
                }
            } else {
                //если не заполнено поле даты окончания
                this.check.button = false

            }
        },
        checkFreeCars() {
            const data = {
                id: this.employee_id.code,
                date_start: this.date_start.data,
                date_end: this.date_end.data
            }
            axios.post(`/api/employee/car`, data)
                .then(res => {
                    //console.log(res.data);
                    this.check.free_cars = true
                    /*Свободные автомобили*/
                    this.cars = res.data
                })
        },


        store() {
            if (this.data) {
                this.errors.data = ''
                axios.post(`/api/trip`, this.data)
                    .then(res => {
                        this.closeModal()
                        this.$parent.getTrips()
                    })
            } else {
                this.errors.data = 'необходимо выбрать автомобиль'
            }

        },

    },

}
</script>

<style>
.select2-container {
    width: 100% !important;
}
</style>

