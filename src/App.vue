<template>
    <div id="app">
        <!--<div>-->
            <!--<div id="nav">-->
                <!--<router-link to="/">Home</router-link>-->
                <!--|-->
                <!--<router-link to="/about">About</router-link>-->
            <!--</div>-->
            <!--<router-view/>-->
        <!--</div>-->
        <pre>{{some}}</pre>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {
                some: 'Всё не всё и то и не то!'
            }
        },
        created() {
            let data = new FormData();
            data.append('task', '131313 не 1');
            data.append('is_folder', '1');

            this.axios.post('/api/test/add', data)
                .then((res) => {
                console.log(res);
                this.some = res.data;
            })


            // this.axios({
            //     method: 'post',
            //     url: '/api/test',
            //     data: data
            // }).then((res) => {
            //     console.log(res.data);
            //     this.some = res.data;
            // });
        }
    }
</script>

<style lang="less">
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
    }

    #nav {
        padding: 30px;
        a {
            font-weight: bold;
            color: #2c3e50;
            &.router-link-exact-active {
                color: #42b983;
            }
        }
    }
</style>
