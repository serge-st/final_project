import {getUserData} from "./getUserData.js";

export function handleCheckbox(taskStatus){
    const baseURL = "/final_project/api";
    const handleCheckboxAPI = "/handleCheckbox.php";

    fetch(`${baseURL}${handleCheckboxAPI}`, {
        method: 'POST',
        body: JSON.stringify(taskStatus)
    })
    .then( () => getUserData())
    .catch(err => console.error(err));
}