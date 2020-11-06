import React from 'react'
import {Link, Route, Switch} from 'react-router-dom'
import TodoListClasses from "./components/TodoListClasses"
import TodoListHooks from "./components/TodoListHooks"

function App() {
    return (
        <div>
            <Switch>
                <Route exact path="/todo-list-classes" component={TodoListClasses}/>
                <Route exact path="/todo-list-hooks" component={TodoListHooks}/>
            </Switch>
            <h3>React Interview Questions</h3>
            <div>
                1. Make a Todo List <Link to="/todo-list-classes">TodoListClasses</Link> <Link to="/todo-list-hooks">TodoListHooks</Link>
            </div>
        </div>
    );
}

export default App;
