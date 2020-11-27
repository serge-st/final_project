import {getUserData} from "./getUserData.js";

export function callDelete(id) {
    const baseURL = "/final_project/api";
    const deleteTaskAPI = "/deleteTask.php";
    const userId = document.getElementById("session-heading").getAttribute('user-id');

    fetch(`${baseURL}${deleteTaskAPI}`, {
        method: 'POST',
        body: JSON.stringify({id: id})
    })
    .then( () => {
        getUserData(userId);
    })
    .catch(err => console.error(err));
}