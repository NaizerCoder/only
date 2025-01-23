<template>
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <span class="brand-link brand-text text-center">Only System Auto</span>
            <!-- Sidebar -->
            <ul class="pt-3 nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <Leftside></Leftside>
            </ul>

            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="h2">{{title}}</div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
<!--            <strong>Copyright &copy; 2025</strong>-->
            &copy; developed by Alexey Klinkov
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

</template>

<script>

import Leftside from "./Leftside.vue";
export default {
    name: "Index",
    components: {
        Leftside
    },

    data(){
        return{
            message: 'test_mes',
        }
    },

    computed:{
        title(){
            return this.$store.getters.title
        }
    },

}
</script>

<style scoped>

</style>

