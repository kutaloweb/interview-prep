import React from 'react'
import {v4 as uuid} from 'uuid'

class TodoListClasses extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            todos: []
        }
        this.create = this.create.bind(this)
        this.remove = this.remove.bind(this)
        this.edit = this.edit.bind(this)
        this.toggle = this.toggle.bind(this)
    }

    create(newTodo) {
        this.setState({
            todos: [...this.state.todos, newTodo]
        })
    }

    remove(id) {
        this.setState({
            todos: this.state.todos.filter(t => t.id !== id)
        })
    }

    edit(id, newTodo) {
        const editedTodoList = this.state.todos.map(t => {
            if (id === t.id) return {...t, task: newTodo}
            else return t
        })
        this.setState({
            todos: editedTodoList
        })
    }

    toggle(id) {
        const updatedTodos = [...this.state.todos]
        const todo = updatedTodos.find(t => t.id === id)
        todo.complete = !todo.complete
        this.setState({
            todos: updatedTodos
        })
    }

    componentDidMount() {
        console.log("componentDidMount()")
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        console.log("componentDidUpdate()", this.state.todos)
    }

    componentWillUnmount() {
        console.log("componentWillUnmount()")
    }

    render() {
        const todosList = this.state.todos.map(todo => {
            return (
                <Todo
                    key={todo.id}
                    id={todo.id}
                    task={todo.task}
                    removeTodo={this.remove}
                    editTodo={this.edit}
                    toggleTodo={this.toggle}
                />
            )
        })

        return (
            <div>
                <div>{todosList}</div>
                <NewTodoForm createTodo={this.create}/>
            </div>
        )
    }
}

class Todo extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            isEditing: false,
            newName: this.props.task
        }
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleEditing = this.handleEditing.bind(this)
    }

    handleChange(e) {
        this.setState({
            newName: e.target.value
        })
    }

    handleSubmit(e) {
        e.preventDefault()
        this.props.editTodo(this.props.id, this.state.newName)
        this.setState({isEditing: false})
    }

    handleEditing(edit) {
        this.setState({
            isEditing: edit
        })
    }

    render() {
        const view = (
            <div>
                <input type="checkbox" checked={this.props.complete} onChange={() => this.props.toggleTodo(this.props.id)} />
                {this.props.task}
                <button onClick={() => this.props.removeTodo(this.props.id)}>
                    Delete
                </button>
                <button onClick={() => this.handleEditing(true)}>
                    Edit
                </button>
            </div>
        )

        const edit = (
            <form onSubmit={this.handleSubmit}>
                <input
                    type="text"
                    value={this.state.newName}
                    onChange={this.handleChange}
                />
                <button type="submit">
                    Save
                </button>
            </form>
        )

        return <div>{this.state.isEditing ? edit : view}</div>
    }
}

class NewTodoForm extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            task: ''
        }
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleChange = this.handleChange.bind(this)
    }

    handleSubmit(e) {
        e.preventDefault()
        this.props.createTodo({...this.state, id: uuid(), complete: false})
        this.setState({task: ''})
    }

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                <input
                    type="text"
                    placeholder="New Todo Classes"
                    name="task"
                    value={this.state.task}
                    onChange={this.handleChange}
                />
                <button>Add</button>
            </form>
        )
    }
}

export default TodoListClasses
