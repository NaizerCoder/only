<template>
    <span class="mr-2">
        <a
            class="btn btn-primary mb-2"
            data-bs-toggle="modal"
            :data-bs-target="`#${id}`"
            title="добавить"
            @click.prevent="clearData"
        >
            Добавить
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
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить сотрудника</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Фамилия-->
                    <div class="mb-2">
                        <input type="text" v-model="surname" class="form-control" id="surname" placeholder="*Фамилия">
                    </div>

                    <div v-if="this.errors.surname" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.surname
                        }}
                    </div>

                    <!--Имя-->
                    <div class="mb-2">
                        <input type="text" v-model="name" class="form-control" id="name" placeholder="*Имя">
                    </div>

                    <div v-if="this.errors.name" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.name
                        }}
                    </div>

                    <!--Отчество-->
                    <div class="mb-2">
                        <input type="text" v-model="patronymic" class="form-control" id="patronymic" placeholder="*Отчество">
                    </div>

                    <div v-if="this.errors.patronymic" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.patronymic
                        }}
                    </div>

                    <!--ДОЛЖНОСТЬ-->
                    <div class="mb-2">
                        <multiselect
                            id="single-select-object"
                            v-model="cat_comfort_id"
                            selectLabel="нажмите Enter для добавления"
                            deselectLabel="нажмите Enter для удаления"
                            placeholder="Категория комфорта"
                            selectedLabel="добавлено"
                            track-by="name"
                            label="name"
                            :options="categories_comfort"
                            :searchable="false"
                            :allow-empty="false"
                            aria-label="pick a value"
                        >
                        </multiselect>
                    </div>

                    <div v-if="this.errors.cat_comfort_id" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.cat_comfort_id
                        }}
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
                        Добавить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'

export default {
    name: "CreateEmployee",
    props: [
        'id',
    ],
    components: {
        Multiselect
    },
    data() {
        return {
            name: '',
            surname: '',
            patronymic: '',
            positions: [],
            categories_comfort: [], //?
            cat_comfort_id: '', //?
            errors: {
                surname: null,
                name: null,
                patronymic: null,
                position_id: null,
            },
        }
    },
    mounted() {
        this.getPositions()
    },

    methods: {
        closeModal() {
            document.getElementById('mod_close').click();
        },
        clearData() {
            // this.errors.title = null
            // this.errors.cat_comfort_id = null
            // this.errors.year = null
            // this.title = ''
            // this.year = ''
            // this.cat_comfort_id = ''
        },
        getPositions() {
            axios.get('/api/employee/create')
                .then(res => {
                    //console.log(res.data);
                    /*Должности*/
                    // res.data.forEach((item, index) => {
                    //     this.positions.push({'name': item.title, 'code': item.id})
                    // })
                })
        },

        store() {
            // let comfort_id
            //
            // if(this.cat_comfort_id.code) {
            //     comfort_id = this.cat_comfort_id.code
            // }
            // else comfort_id = ''
            //
            // let data = {
            //     model: this.title,
            //     year: this.year,
            //     cat_comfort_id: comfort_id
            // }
            // console.log(data);
            //
            // axios.post('/api/car', data)
            //     .then(res => {
            //         this.closeModal()
            //         this.$parent.getCars()
            //     })
            //     .catch(error => {
            //         if (error.response.data.errors) {
            //             //console.log(error.response.data.errors);
            //             this.errors.title = (error.response.data.errors.model) ? error.response.data.errors.model[0] : null
            //             this.errors.year = (error.response.data.errors.year) ? error.response.data.errors.year[0] : null
            //             this.errors.cat_comfort_id = (error.response.data.errors.cat_comfort_id) ? error.response.data.errors.cat_comfort_id[0] : null
            //         }
            //     })
        },

    },

}
</script>

<style>
.select2-container {
    width: 100% !important;
}
</style>



