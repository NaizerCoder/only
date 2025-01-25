<template>
    <li class="nav-item">
        <router-link :to="{ name: 'trips' }" class="nav-link">
          <i class="nav-icon fas fa-car-side"></i>
            Служебные поездки
        </router-link>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Персонал
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none; margin-left: 10px">
            <li class="nav-item">
                <router-link :to="{ name: 'employee.index' }" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    Сотрудники
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'positions.index' }" class="nav-link">
                  <i class="nav-icon fas fa-sitemap"></i>
                    Должности
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'cat_pos.index' }" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    Категории должностей
                </router-link>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <router-link :to="{ name: 'cars.index' }" class="nav-link">
          <i class="nav-icon fas fa-car"></i>
            Автомобили
        </router-link>
    </li>
    <li class="nav-item">
        <router-link :to="{ name: 'cat_comfort.index' }" class="nav-link">
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
