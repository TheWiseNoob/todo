<style lang="scss">
    #todo-container {
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

            &:hover,
            &:focus {
                box-shadow: 0 0 0 4px rgba(220,220,220,1);
            }
        }

        .todo {
            display: flex;
            align-items: center;

            min-width: 150px;

            margin: 12px;
            padding: 5px 10px;

            background-color: white;

            border: 1px solid rgba(130,130,130,1);
            border-radius: 4px;

            box-shadow: inset 0 0 3px 1px rgba(0,0,0,0.1);

            font-size: 15px;
            font-family: 'Open Sans', sans-serif;

            .todo-checkbox:checked + .todo-text {
                 text-decoration: line-through;
             }

            .todo-text {
                flex-grow: 1;

                margin-left: 10px;
            }

            .todo-close-button {
                margin-left: 10px;

                background-color: transparent;

                border: 2px solid rgba(130,130,130,0);

                color: rgba(70,70,70,1);
                font-size: 18px;
            }
        }
    }
</style>

<template>
    <div id="todo-container">
        <h1>Todo List</h1>

        <form
            id="todo-form"
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
            <div class="todo" v-for="(todo, todoIndex) in todos">
                <input
                    class="todo-checkbox"
                    type="checkbox"
                    :checked="todo.completed"
                    @change="updateTodo($event, todo.id, todoIndex)"
                >

                <div class="todo-text">
                    {{ todo.task }}
                </div>

                <button
                    class="todo-close-button"
                    type="button"
                    @click="deleteTodo(todo.id, todoIndex)"
                >
                    <i class="fas fa-times"></i>
                </button>
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

            // Create todo item.
            createTodo (event) {
                const task = this.task;
                this.task = '';

                event.preventDefault();

                axios.post('api/todos', {task: task})
                   .then(response => (this.todos.push({
                       task: task,
                       id: response.data.id,
                       completed: response.data.completed
                   })));
            },

            // Delete todo item.
            deleteTodo (id, todoIndex) {
                axios.delete(`api/todos/${id}`)
                   .then(response => {
                       this.todos.splice(todoIndex, 1);
                   });
            },

            // Mark todo item as checked.
            updateTodo(event, id, todoIndex) {
                const checked = event.currentTarget.checked;

                this.todos[todoIndex].completed = checked;

                axios.put(`api/todos/${id}`, {completed: checked})
                   .then(response => {
                   });
            },
        }
    }
</script>
