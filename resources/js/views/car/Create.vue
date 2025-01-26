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
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить автомобиль</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Название-->
                    <div class="mb-2">
                        <input type="text" v-model="title" class="form-control" id="title" placeholder="*Модель">
                    </div>

                    <div v-if="this.errors.title" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.title
                        }}
                    </div>

                    <!--ГОД-->
                    <div class="mb-2">
                        <input type="number" min="2000" max="2099" v-model="year" class="form-control" id="year" placeholder="*Год выпуска">
                    </div>

                    <div v-if="this.errors.year" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.year
                        }}
                    </div>

                    <!--КАТЕГОРИЯ КОМФОРТА-->
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
    name: "CreateCar",
    props: [
        'id',
    ],
    components: {
        Multiselect
    },
    data() {
        return {
            title: '',
            year: '',
            categories_comfort: [],
            cat_comfort_id: '',
            errors: {
                title: null,
                cat_comfort_id: null,
            },
        }
    },
    mounted() {
        this.getCategories()
    },

    methods: {
        closeModal() {
            document.getElementById('mod_close').click();
        },
        clearData() {
            this.errors.title = null
            this.errors.cat_comfort_id = null
            this.errors.year = null
            this.title = ''
            this.year = ''
            this.cat_comfort_id = ''
        },
        getCategories() {
            axios.get('/api/car/create')
                .then(res => {
                    //console.log(res.data);
                    /*Категории комфорта*/
                    res.data.forEach((item, index) => {
                        this.categories_comfort.push({'name': item.title, 'code': item.id})
                    })
                })
        },

        store() {
            let comfort_id

            if(this.cat_comfort_id.code) {
                comfort_id = this.cat_comfort_id.code
            }
            else comfort_id = ''

            let data = {
                model: this.title,
                year: this.year,
                cat_comfort_id: comfort_id
            }
            //console.log(data);

            axios.post('/api/car', data)
                .then(res => {
                    this.closeModal()
                    this.$parent.getCars()
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        //console.log(error.response.data.errors);
                        this.errors.title = (error.response.data.errors.model) ? error.response.data.errors.model[0] : null
                        this.errors.year = (error.response.data.errors.year) ? error.response.data.errors.year[0] : null
                        this.errors.cat_comfort_id = (error.response.data.errors.cat_comfort_id) ? error.response.data.errors.cat_comfort_id[0] : null
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


