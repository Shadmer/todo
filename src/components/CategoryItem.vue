<template>
    <li class="category-item"
        :class="{'category-item--active': $store.state.categories.currentCategoryId === category.id}"
        @click="chooseCategory(category.id)"
    >
        <span class="category-item__title"
              v-if="!editing"
              @dblclick="startEdit(category)"
        >
            {{ category.title }}
        </span>
        <input class="category-item__title"
               v-else type="text"
               v-model="category.title"
               @blur="doneEdit(category)"
               @keyup.enter="doneEdit(category)"
               @keyup.esc="cancelEdit(category)"
               maxlength="255"
               v-focus
        >
        <span class="category-item__remove" v-if="item" @click.stop="remove(category.id)">&#10008;</span>
    </li>
</template>

<script>
    export default {
        name: "CategoryItem",
        props: ['item'],
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus();
                }
            }
        },
        data() {
            return {
                cache: '',
                editing: false
            }
        },
        computed: {
            category() {
                return this.item ? this.item : {id: 0, title: 'По умолчанию'};
            }
        },
        methods: {
            startEdit(category) {
                if (!this.item) {
                    return;
                }
                this.editing = true;
                this.cache = category.title;
            },
            cancelEdit(category) {
                category.title = this.cache;
                this.editing = false;
                this.cache = '';
            },
            doneEdit(category) {
                if (category.title.trim() === '') {
                    category.title = this.cache;
                    this.editing = false;
                    return;
                }
                this.$store.dispatch('categories/editCategory', category);
                this.editing = false;
                this.cache = '';
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
    .category-item {
        position: relative;
        cursor: default;
        transition: background-color .3s;

        &--active {
            font-weight: bold;
            background-color: @color--gray;
        }

        &:hover {
            background-color: @color--gray;
            transition: background-color .3s;

            .category-item__remove {
                opacity: 1;
                transition: opacity .3s;
            }
        }

        &__title {
            display: block;
            width: 100%;
            padding: 10px 30px 10px 25px;
            line-height: 1.5;
            border: 0;
            outline-color: black;
            word-wrap: break-word;
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