import React from 'react'
import {v4 as uuid} from 'uuid'

function TodoListHooks() {
    const [todos, setTodos] = React.useState([])

    const create = newTodoText => {
        setTodos([...todos, {id: uuid(), task: newTodoText, complete: false}])
    }

    const remove = id => {
        const updatedTodos = todos.filter(t => t.id !== id)
        setTodos(updatedTodos)
    }

    const edit = (id, newTodoText) => {
        const editedTodoList = todos.map(t => {
            if (id === t.id) {
                return {...t, task: newTodoText}
            }
            return t
        })
        setTodos(editedTodoList)
    }

    const toggle = id => {
        const updatedTodos = [...todos]
        const todo = updatedTodos.find(t => t.id === id)
        todo.complete = !todo.complete
        setTodos(updatedTodos)
    }

    React.useEffect(() => {
        console.log("useEffect()", todos)
    }, [todos])

    const todosList = todos.map(todo => {
        return (
            <Todo
                key={todo.id}
                {...todo}
                removeTodo={remove}
                editTodo={edit}
                toggleTodo={toggle}
            />
        )
    })

    return (
        <div>
            {todosList}
            <NewTodoForm createTodo={create}/>
        </div>
    )
}

function Todo({id, task, complete, removeTodo, editTodo, toggleTodo}) {
    const [isEditing, setEditing] = React.useState(false)
    const [newName, setNewName] = React.useState(task)

    const handleChange = e => {
        setNewName(e.target.value)
    }

    const handleSubmit = e => {
        e.preventDefault()
        editTodo(id, newName)
        setEditing(false)
    }

    const handleEditing = edit => {
        setEditing({isEditing: edit})
    }

    const view = (
        <div>
            <input type="checkbox" checked={complete} onChange={() => toggleTodo(id)} />
            {task}
            <button onClick={() => removeTodo(id)}>
                Delete
            </button>
            <button onClick={() => handleEditing(true)}>
                Edit
            </button>
        </div>
    )

    const edit = (
        <form onSubmit={handleSubmit}>
            <input
                type="text"
                value={newName}
                onChange={handleChange}
            />
            <button type="submit">
                Save
            </button>
        </form>
    )

    return <div>{isEditing ? edit : view}</div>
}

function NewTodoForm({createTodo}) {
    const [value, setValue] = React.useState("")

    const handleSubmit = e => {
        e.preventDefault()
        createTodo(value)
        setValue('')
    }

    const handleChange = e => {
        setValue(e.target.value)
    }

    return (
        <div>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    placeholder="New Todo Hooks"
                    name="task"
                    value={value}
                    onChange={handleChange}
                />
                <button>Add</button>
            </form>
        </div>
    )
}

export default TodoListHooks
