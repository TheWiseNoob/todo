<style lang="scss">
    .todoContainer {
        display: flex;
        flex-direction: column;
        align-items: center;

        padding: 20px;

        h1 {
            font-family: 'Roboto', sans-serif;

            margin: 0 0 10px 0;
        }

        .card {
            font-family: 'Open Sans', sans-serif;

            color: red;
        }
    }
</style>

<template>
    <div class="todoContainer">
        <h1>Todo List</h1>

        <input type="text" placeholder="Enter a new task.">
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
