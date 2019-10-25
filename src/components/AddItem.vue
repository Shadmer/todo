<template>
    <div class="add-item"
         :class="getModifier"
    >
        <span v-if="isNew" @click="add">+</span>
        <input type="text"
               v-model="newItem"
               @keyup.enter="add"
               maxlength="255"
               placeholder="Добавить ... "
        >
    </div>
</template>

<script>
    export default {
        name: "AddItem",
        props: {
            'modifier': String
        },
        data() {
            return {
                newItem: ''
            }
        },
        computed: {
            isNew() {
                return this.newItem.trim() !== '';
            },
            getModifier() {
                return this.modifier ? ('add-item--' + this.modifier) : '';
            }
        },
        methods: {
            add() {
                if (!this.newItem) {
                    return;
                }
                this.$emit('add', this.newItem);
                this.newItem = '';

            },
        }
    }
</script>

<style lang="less">
    .add-item {
        position: relative;
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;

        span {
            position: absolute;
            top: 50%;
            left: 10px;
            margin-top: -25px;
            font-size: 32px;
            cursor: pointer;
        }

        input {
            width: 100%;
            padding: 15px 40px;
            line-height: 1.15;
            outline-color: black;
            border: 0;
            border-top: 1px solid gray;
            border-bottom: 1px solid gray;
        }

        &--small {
            span {
                left: 5px;
                margin-top: -20px;
                font-size: 26px;
            }

            input {
                padding: 10px 10px 10px 25px;
            }
        }
    }
</style>