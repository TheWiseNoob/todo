<style lang="scss">
    .todoContainer {
        display: flex;
        flex-direction: column;
        align-items: center;

        padding: 20px;

        h1 {
            font-family: 'Roboto', sans-serif;
            font-size: 38px;
            color: rgba(70,70,70,1);

            margin: 30px 0 10px 0;
        }

        #todo-input {
            width: 420px;
            max-width: 100%;

            margin-bottom: 15px;
            padding: 5px 10px;

            border-radius: 4px;
            border: 2px solid rgba(130,130,130,1);

            font-size: 20px;

            outline: none !important;

            box-shadow: 0 0 0 0 rgba(220,220,220,0);

            transition: box-shadow 0.2s linear;

            &:focus {
                box-shadow: 0 0 0 4px rgba(220,220,220,1);
            }
        }

        .todo {
            display: flex;

            min-width: 150px;

            margin: 12px;
            padding: 5px;

            background-color: white;

            border: 1px solid rgba(130,130,130,1);
            border-radius: 4px;

            box-shadow: inset 0 0 3px 1px rgba(0,0,0,0.1);

            font-size: 15px;
            font-family: 'Open Sans', sans-serif;
        }
    }
</style>

<template>
    <div class="todoContainer">
        <h1>Todo List</h1>

        <form
            id="todoForm"
            @submit="createTodo"
        >
            <input
                v-model="task"
                ref="todoInput"
                id="todo-input"
                type="text"
                placeholder="Type a new task and press enter."
                maxlength=50
            >
        </form>

        <div>
            <div class="todo" v-for="todo in todos">
                {{ todo.task }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                task: '',
                todos: [],
            }
        },

        mounted() {
            const self = this;

            this.$refs.todoInput.focus();

            axios.get('api/todos')
               .then(function(response) {
                   self.todos = response.data;
               });
        },

        methods: {
            createTodo (event) {
                const task = this.task;
                this.task = '';

                event.preventDefault();

                axios.post('api/todos', {task: task})
                   .then(response => (this.todos.push({task: task})))
            }
        }
    }
</script>
