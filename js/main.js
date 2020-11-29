import {getUserData} from "./components/getUserData.js";
import {callSave} from "./components/saveUpdate.js";
import {copyrightYear} from "./components/copyrightYear.js";

document.addEventListener("DOMContentLoaded", () => {
    // Set footer copyright year
    document.getElementById("copyright-year").innerHTML = copyrightYear();

    // Check if user is logged in (safety fallback) 
    if (!document.getElementById("session-heading")){
        return "";
    }

    // Get data for the current user and update all the elements
    getUserData()
    .catch(err => console.error(err));
    
    const userId = document.getElementById("session-heading").getAttribute('user-id');
    const taskInput = document.getElementById('task-input-form');
    const saveButton = document.getElementById('task-form-btn');

    // Zoom functionality on the main page
    document.querySelector(".app-container").classList.add("zoomed");

    // When "Edit Task" is pressed id of the desired task is inserted in taskId attribute
    const observer = new MutationObserver( mutations => {
        mutations.forEach( mutation => {
            if (mutation.type === "attributes" && mutation.attributeName === "taskid") {
                if (!!taskInput.getAttribute("taskid")){
                    saveButton.innerText = "Update";
                } else {
                    saveButton.innerText = "Save";
                }
            }
        });
    });

    // Listen to "taskInput" elements attribute change
    observer.observe(taskInput, {
        attributes: true
    });

    // If nothing is in the input field change name to Save and remove taskid attribute
    taskInput.addEventListener("input", () => {
        if (taskInput.value.length === 0) {
            taskInput.setAttribute("taskid", "");  
        } 
    });

    // Save/Update button event listener
    saveButton.addEventListener("click", () => {
        callSave(userId);
    });

    // Allow to Save/Update data by pressing "Enter"
    taskInput.addEventListener("keydown", event => {
        if (event.code === "Enter"){
            callSave(userId);
        }
    });

});