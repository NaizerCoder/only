<template>
    <span class="mr-2">
        <a
            class="btn btn-danger btn-sm mb-2"
            data-bs-toggle="modal"
            :data-bs-target="`#${id}`"
            title="назначить"
            @click.prevent="getDrivers"
        >
            назначить
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
                    <h5 class="modal-title" id="staticBackdropLabel">Назначить свободного водителя</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <multiselect
                            id="single-select-object"
                            v-model="driver_id"
                            selectLabel="нажмите Enter для добавления"
                            deselectLabel="нажмите Enter для удаления"
                            placeholder="Выберите водителя"
                            selectedLabel="добавлено"
                            track-by="name"
                            label="name"
                            :options="drivers"
                            :searchable="false"
                            :allow-empty="false"
                            aria-label="pick a value"
                        >
                        </multiselect>
                    </div>

                    <div v-if="this.errors.driver_id" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.driver_id
                        }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" :id="`close_driver_${id}`">Закрыть
                    </button>
                    <button
                        @click.prevent="update(id)"
                        type="button"
                        class="btn btn-primary"
                    >
                        Назначить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    name: "Driver",
    props: [
        'id',
    ],
    components: {
        Multiselect
    },
    data() {
        return {
            driver_id: '',
            drivers: [],
            errors: {
                driver_id: null
            },
        }
    },
    mounted() {
    },

    methods: {
        closeModal(id) {
            document.getElementById(`close_driver_${id}`).click();
        },
        clearData() {
            this.errors.driver_id = null
            this.driver_id = ''
            this.drivers = []
        },
        getDrivers() {
            let fio_drivers
            this.clearData()

            axios.get('/api/employee/drivers')
                .then(res => {
                    console.log(res.data);
                    /*Свободные водители*/
                    res.data.forEach((item, index) => {
                        fio_drivers = item.surname + ' ' + item.name + ' ' + item.patronymic
                        this.drivers.push({'name': fio_drivers, 'code': item.id})
                    })
                })
        },

        update(id) {
            let driver_id

            if(this.driver_id.code) {
                driver_id = this.driver_id.code
            }
            else driver_id = ''

            let data = {
                driver_id: driver_id
            }

            axios.patch(`/api/car/driver/${id}`, data)
                .then(res => {
                    this.closeModal(id)
                    this.$parent.getCars()
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        //console.log(error.response.data.errors);
                        this.errors.driver_id = (error.response.data.errors.driver_id) ? error.response.data.errors.driver_id[0] : null
                    }
                })

        },

    },

}
</script>

<style>
.select2-container {
    width: 100% !important;
}
</style>



