<template>
    <li class="nav-item">
        <router-link :to="{ name: 'trips' }" class="nav-link">
          <i class="nav-icon fas fa-car-side"></i>
            Служебные поездки
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'users' }" class="nav-link">
          <i class="nav-icon fas fa-users"></i>
            Сотрудники
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'positions' }" class="nav-link">
          <i class="nav-icon fas fa-sitemap"></i>
            Должности
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'drivers' }" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            Водители
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'cars' }" class="nav-link">
          <i class="nav-icon fas fa-car"></i>
            Автомобили
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'category.comfort' }" class="nav-link">
          <i class="nav-icon fas fa-star"></i>
            Категории комфорта
        </router-link>
    </li>



</template>

<script>

export default {
    name: "Leftside",
    data() {
        return {
            message: ''
        }
    },

}
</script>

<style scoped>

</style>
