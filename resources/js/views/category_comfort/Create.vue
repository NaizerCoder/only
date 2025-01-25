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
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить категорию комфорта</h5>
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

                    <!--Описание-->
                    <div class="mb-2 form_data">
                    <textarea ref="textarea_description" v-model="description" @input="resizeTextareaDesription()"
                              placeholder='Описание' rows="1">
                    </textarea>
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

export default {
    name: "CreateCategoryComfort",
    props: [
        'id',
    ],
    components: {

    },
    data() {
        return {
            title: '',
            description: '',
            errors: {
                title: null,
            },
        }
    },
    mounted() {
    },

    methods: {
        resizeTextareaDesription() {
            this.$refs.textarea_description.style.height = "auto";
            this.$refs.textarea_description.style.height = `${this.$refs.textarea_description.scrollHeight}px`;
        },
        closeModal() {
            document.getElementById('mod_close').click();
        },
        clearData(){
            this.errors.title = null
            this.title = ''
        },
        store() {
            let data = {
                title: this.title,
                description: this.description,
            }
            axios.post('/api/category_comfort', data)
                .then(res => {
                    this.closeModal()
                    this.$parent.getCategories()
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        //console.log(error.response.data.errors);
                        this.errors.title = (error.response.data.errors.title) ? error.response.data.errors.title[0] : null
                    }
                })

        },

    },

}
</script>

<style>
.form_data textarea {
    resize: none;
    box-sizing: border-box;
    width: 100%;
    min-height: 50px;
    max-height: 150px;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    padding: 0.5rem;
    border-radius: 0.25rem;

}
</style>

