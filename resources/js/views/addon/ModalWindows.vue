<template>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-info" data-bs-toggle="modal" :data-bs-target="`#${dt}`">
        {{ butmod }}
    </button>
    <!-- Modal -->
    <div class="modal fade" :id="`${dt}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-left">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{titlemod}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div v-for="item in items">
                        {{ item.title }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ModalWindows",

    props: [
        'dt',
        'textmod',
        'butmod',
        'items',
        'titlemod'
    ],

}
</script>

<style scoped>

</style>
