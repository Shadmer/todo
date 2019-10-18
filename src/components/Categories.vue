<template>
    <section class="categories">
        <h2 class="categories__title">Категории:</h2>
        <ul class="categories__list">
            <li class="categories__item"
                :class="{'categories__item--active': isCategoryActive(0)}"
                @click="chooseCategory(0)">Без категории</li>
            <li class="categories__item"
                v-for="(category, index) in categories"
                :key="index"
                :class="{'categories__item--active': isCategoryActive(category.id)}"
                @click="chooseCategory(category.id)"
            >
                <span>{{ category.title }}</span>
                <span class="categories__remove" @click.stop="remove(category.id)">&#10008;</span>
            </li>
        </ul>
        <div class="categories__add">
            <span v-if="isNewCategory" @click="add">+</span>
            <input type="text"
                   v-model="newCategory"
                   @keyup.enter="add"
                   placeholder="Добавить категорию">
        </div>

    </section>
</template>

<script>
    export default {
        name: "Categories",
        data() {
            return {
                newCategory: '',
            }
        },
        computed: {
            categories() {
                return this.$store.state.categories.all;
            },
            isNewCategory() {
                return this.newCategory.trim() !== '';
            }
        },
        methods: {
            isCategoryActive(id) {
                return this.$store.state.categories.currentCategoryId === id && !this.$store.state.tasks.currentTaskId;
            },
            chooseCategory(id) {
                if (this.$store.state.tasks.currentTaskId) {
                    let task = this.$store.state.tasks.all.find(task => task.id === this.$store.state.tasks.currentTaskId);
                    task.category_id = id;
                    this.$store.dispatch('tasks/editTask', task);
                    this.$store.dispatch('tasks/setCurrentTaskId', 0);
                    this.$store.dispatch('closeStub');
                    return;
                }
                this.$store.dispatch('categories/setCurrentCategoryId', id);

            },
            add() {
                if (!this.isNewCategory) {
                    return;
                }
                this.$store.dispatch('categories/addCategory', this.newCategory);
                this.newCategory = '';
            },
            remove(id) {
                let isDel = confirm('Удалить категорию?');
                if (!isDel) {
                    return;
                }
                this.$store.dispatch('categories/removeCategory', id);
                this.$store.dispatch('tasks/removeTaskByCategoryId', id);
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
            position: relative;
            margin-top: 10px;

            span {
                position: absolute;
                top: 50%;
                margin-top: -20px;
                left: 5px;
                font-size: 26px;
                cursor: pointer;
            }

            input {
                width: 100%;
                padding: 10px 10px 10px 25px;
                outline-color: black;
                border: 0;
                border-top: 1px solid gray;
                border-bottom: 1px solid gray;
            }
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