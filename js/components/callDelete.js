import {getUserData} from "./getUserData.js";

export function callDelete(id) {
    const baseURL = "/final_project/api";
    const deleteTaskAPI = "/deleteTask.php";

    fetch(`${baseURL}${deleteTaskAPI}`, {
        method: 'POST',
        body: JSON.stringify({id: id})
    })
    .then( () => getUserData())
    .catch(err => console.error(err));
}