import {callDelete} from "./callDelete.js";

export async function getUserData(userId) {
    const baseURL = "/final_project/api";
    const getUserDataAPI = "/getUserData.php?user_id=";

    // Call the API
    const response = await fetch(`${baseURL}${getUserDataAPI}${userId}`);

    // Parse incoming JSON
    const apiData = await response.json();

    // Separate all incoming tasks into incompleted tasks:
    const incompleteTasks = apiData.filter( task => !Number(task.is_completed));

    // And completed tasks
    const completeTasks = apiData.filter( task => Number(task.is_completed));

    // Display remaining task number in the "Task Counter"
    const totalTaskCount = document.getElementById("task-number");
    totalTaskCount.innerText = incompleteTasks.length;

    // Display the encouragment text
    const encourageElement = document.getElementById("encourage");
    const encourageText = ["Let's do some work 💪", "Time to rest 👌"];
    incompleteTasks.length ? encourageElement.innerText = encourageText[0] : encourage.innerText = encourageText[1];

    // Populate incompleted task table with data
    const tableIncomplete = document.getElementById("user-tasks");
    tableIncomplete.innerHTML = incompleteTasks.map( task => {
        return `
        <tr>
            <td> <input type="checkbox" checkboxId="${task.id}"> </td>
            <td class="td-description"> ${task.description} <hr class="td-hr"> </td>
            <td class="td-btn"> <button class="btn edit-btn" buttonId="${task.id}"> <i class="fas fa-edit"></i> </button> </td>
            <td class="td-btn"> <button class="btn delete-btn delete" buttonId="${task.id}"> <i class="fas fa-trash"></i> </button> </td>
        </tr>
        `;
    }).join("");

    // Populate completed task table with data
    const tableComplete = document.getElementById("user-completed-tasks");
    tableComplete.innerHTML = completeTasks.map( task => {
        return `
        <tr>
            <td> <input type="checkbox" class="checkbox-completed" checkboxId="${task.id}"> </td>
            <td class="td-description completed-task"> ${task.description} <hr class="td-hr"> </td>
            <td class="td-btn"> <button class="btn big-delete-btn delete" buttonId="${task.id}"> Delete </button> </td>
        </tr>
        `;
    }).join("");

    // Get all checkboxes from the complete table and set checed status to true
    const completedCheckboxes = document.querySelectorAll(".checkbox-completed");
    Object.values(completedCheckboxes).forEach( checkBox => checkBox.checked = true);

    // Add DELETE event listeners
    const deleteButtons = document.querySelectorAll(".delete");
    Object.values(deleteButtons).forEach( button => button.addEventListener("click", () =>  {
        const buttonId = button.getAttribute("buttonId");
        callDelete(buttonId);
    }));

    // Add EDIT event listeners
    const editButtons = document.querySelectorAll(".edit-btn");
    Object.values(editButtons).forEach( button => button.addEventListener("click", () => {
        const buttonId = button.getAttribute("buttonId")
        callEdit(buttonId);
    }));

    // Add event listeners to checkboxes
    const checkboxes = document.querySelectorAll("input[type=checkbox]");
    Object.values(checkboxes).forEach( checkbox => checkbox.addEventListener("change", () => {
        //checkbox.checked is a boolean, so setting the accordng status:
        const taskStatus = {
            id: Number(checkbox.getAttribute("checkboxId")),
            is_completed: Number(checkbox.checked),
        };
        
        //call endpoint
        handleCheckbox(taskStatus);
        
    }));

}