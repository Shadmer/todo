<template>
    <section class="categories">
        <h2 class="categories__title">Категории:</h2>
        <ul class="categories__list">
            <li class="categories__item"
                :class="{'categories__item--active': $store.state.categories.currentCategoryId === 0}"
                @click="chooseCategory(0)">Без категории</li>
            <li class="categories__item"
                v-for="(category, index) in categories"
                :key="index"
                :class="{'categories__item--active': $store.state.categories.currentCategoryId === category.id}"
                @click="chooseCategory(category.id)"
            >
                <span>{{ category.title }}</span>
                <span class="categories__remove" @click.stop="remove(category.id)">&#10008;</span>
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

    export default {
        name: "Categories",
        components: {
            AddItem
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
            chooseCategory(id) {
                if (this.$store.state.tasks.currentTaskId) {
                    let task = this.$store.state.tasks.all
                        .find(task => task.id === this.$store.state.tasks.currentTaskId);
                    task.category_id = id;
                    this.$store.dispatch('tasks/editTask', task);
                    this.$store.dispatch('tasks/setCurrentTaskId', 0);
                    this.$store.dispatch('stub/closeStub');
                    return;
                }
                this.$store.dispatch('categories/setCurrentCategoryId', id);

            },
            remove(id) {
                let isDel = confirm('Удалить категорию?');
                if (!isDel) {
                    return;
                }
                this.$store.dispatch('categories/removeCategory', id);
                this.$store.dispatch('tasks/removeTasksByCategoryId', id);
                if (this.$store.state.categories.currentCategoryId === id) {
                    this.$store.dispatch('categories/setCurrentCategoryId', 0);
                }

            }
        },
    }
</script>

<style lang="less">
    .categories {

        &__list {
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px solid @color--gray;
            background-color: #fff;
            z-index: 1001;

            &:last-of-type {
                border-bottom: 0;
                margin-bottom: 0;
            }
        }

        &__item {
            position: relative;
            padding: 10px 30px 10px 25px;
            cursor: default;
            transition: background-color .3s;

            &--active {
                font-weight: bold;
                background-color: @color--gray;
            }

            &:hover {
                background-color: @color--gray;
                transition: background-color .3s;

                .categories__remove {
                    opacity: 1;
                    transition: opacity .3s;
                }
            }
        }

        &__add {
            margin-top: 10px;
        }

        &__remove {
            opacity: 0;
            position: absolute;
            top: 50%;
            margin-top: -15px;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: opacity .3s;
        }
    }
</style>