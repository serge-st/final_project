import {getUserData} from "./getUserData.js";

export function callSave(userId) {
    const baseURL = "/final_project/api";
    const saveUpdateAPI = "/saveUpdate.php";
    const taskInput = document.getElementById('task-input-form');

    const formData = {
        id: taskInput.getAttribute("taskid"),
        user_id: userId,
        description: taskInput.value
    };
    
    taskInput.value = "";
    taskInput.setAttribute("taskid", "");
    
    if (formData.description.length === 0) return;
    
    fetch(`${baseURL}${saveUpdateAPI}`, {
        method: 'POST',
        body: JSON.stringify(formData)
    })
    .then( () => getUserData())
    .catch(err => console.error(err));
}