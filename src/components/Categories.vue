<template>
    <section class="categories">
        <h2 class="categories__title">Категории:</h2>
        <ul class="categories__list">
            <!--<li class="categories__item"-->
                <!--:class="{'categories__item&#45;&#45;active': $store.state.categories.currentCategoryId === 0}"-->
                <!--@click="chooseCategory(0)">Без категории</li>-->

            <li class="categories__item"
                is="CategoryItem"
            >
            <li class="categories__item"
                v-for="category in categories"
                :key="category.id"
                is="CategoryItem"
                :item="category"
            >
            </li>
        </ul>
        <div class="categories__add"
             is="AddItem"
             @add="addCategory"
             modifier="small"
             :isFocus="false"
        ></div>
    </section>
</template>

<script>
    import AddItem from "@/components/AddItem";
    import CategoryItem from "@/components/CategoryItem";

    export default {
        name: "Categories",
        components: {
            AddItem,
            CategoryItem
        },
        computed: {
            categories() {
                return this.$store.state.categories.all;
            },
        },
        methods: {
            getCategory(title, cache, n) {
                let isSameCategory = this.$store.state.categories.all
                    .find(category => category.title === title);

                if (!isSameCategory) {
                    return title;
                }

                if (!cache) {
                    cache = title;
                    n = 1;
                }
                title = cache + " (" + n++ + ")";
                return this.getCategory(title, cache, n);
            },
            addCategory(title) {
                let newTitle = this.getCategory(title);
                this.$store.dispatch('categories/addCategory', newTitle);
            },
        },
    }
</script>

<style lang="less">
    .categories {

        &__list {
            position: relative;
            background-color: #fff;
            z-index: 1001;
        }

        &__add {
            margin-top: 10px;
        }
    }
</style>