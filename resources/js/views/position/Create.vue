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
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить должность</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Название-->
                    <div class="mb-2">
                        <input type="text" v-model="title" class="form-control" id="title" placeholder="*Название">
                    </div>

                    <div v-if="this.errors.title" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.title
                        }}
                    </div>

                    <!--КАТЕГОРИЯ ДОЛЖНОСТИ-->
<!--                    <div class="mb-2 w-100">-->
<!--                        <Select2 v-model="cat_position_id"-->
<!--                                 :options="categories_position"-->
<!--                                 :settings="{minimumResultsForSearch: -1}"-->
<!--                                 placeholder="Категория должности"-->
<!--                        >-->
<!--                        </Select2>-->
<!--                    </div>-->


                    <div class="mb-2">
                        <multiselect
                            id="single-select-object"
                            v-model="cat_position_id"
                            selectLabel="нажмите Enter для добавления"
                            deselectLabel="нажмите Enter для удаления"
                            placeholder="Категория должности"
                            selectedLabel="добавлено"
                            track-by="name"
                            label="name"
                            :options="categories_position"
                            :searchable="false"
                            :allow-empty="false"
                            aria-label="pick a value"
                        >
                        </multiselect>
                    </div>

                    <div v-if="this.errors.cat_position_id" class="text-danger" style="margin: -10px 0 0 4px">{{
                            this.errors.cat_position_id
                        }}
                    </div>

                    <!--КАТЕГОРИИ КОМФОРТА-->
                    <div>
                        <multiselect
                            id="tagging"
                            v-model="cat_comfort_data"
                            selectLabel="нажмите Enter для добавления"
                            deselectLabel="нажмите Enter для удаления"
                            placeholder="Категории комфорта"
                            selectedLabel="добавлено"
                            label="name"
                            track-by="code"
                            :options="categories_comfort"
                            :multiple="true"
                            :taggable="true"
                            :searchable="false"
                        >
                        </multiselect>
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
import Select2 from 'vue3-select2-component'

export default {
    name: "CreatePosition",
    props: [
        'id',
    ],
    components: {
        Select2,
        Multiselect
    },
    data() {
        return {
            title: '',
            categories_position: [],
            categories_comfort: [],
            cat_position_id: '',
            cat_comfort_data: [],
            errors: {
                title: null,
                cat_position_id: null,
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
            this.title = ''
        },
        getCategories() {
            axios.get('/api/position/create')
                .then(res => {
                    console.log(res.data);
                    /*Категории должностей*/
                    // res.data.categories_position.forEach((item, index) => {
                    //     this.categories_position[index] = {
                    //         id: item.id,
                    //         text: item.title,
                    //     }
                    // })
                    res.data.categories_position.forEach((item, index) => {
                        this.categories_position.push({'name': item.title, 'code': item.id})
                    })
                    /*Категории комфорта*/
                    res.data.categories_comfort.forEach((item, index) => {
                        this.categories_comfort.push({'name': item.title, 'code': item.id})
                    })
                })
        },

        store() {
            let cat_comfort_ids = []
            let position_id

            if (this.cat_comfort_data) {
                this.cat_comfort_data.forEach(item => {
                    cat_comfort_ids.push(item.code)
                })
            }

            if(this.cat_position_id.code) {
                position_id = this.cat_position_id.code
            }
            else position_id = ''

            let data = {
                title: this.title,
                cat_position_id: position_id,
                cat_comfort_ids: cat_comfort_ids
            }
            console.log(data);

            axios.post('/api/position', data)
                .then(res => {
                    //this.closeModal()
                    //this.$parent.getCategories()
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        console.log(error.response.data.errors);
                        this.errors.title = (error.response.data.errors.title) ? error.response.data.errors.title[0] : null
                        this.errors.cat_position_id = (error.response.data.errors.cat_position_id) ? error.response.data.errors.cat_position_id[0] : null
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

