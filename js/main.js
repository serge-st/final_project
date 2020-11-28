import {getUserData} from "./components/getUserData.js";
import {callSave} from "./components/saveUpdate.js";

document.addEventListener("DOMContentLoaded", () => {
    // CHECK IF THE USER LOGGED IN (SAFETY FALLBACK) 
    if (!document.getElementById("session-heading")){
        return "";
    }
    // Get data for the current user and update all the elements
    getUserData()
    .catch(err => console.error(err));

    
    // const baseURL = "/final_project/api";
    // const saveTaskAPI = "/saveTask.php";

    // const getUserDataAPI = "/getUserData.php?user_id=";
    // const deleteTaskAPI = "/deleteTask.php";
    // const editTaskAPI = "/editTask.php?id=";
    // const completeTaskAPI = "/completeTask.php";
   
    
    // FIELDS THAT ARE GOING TO BE MODIFIED:
    const userId = document.getElementById("session-heading").getAttribute('user-id');
    const taskInput = document.getElementById('task-input-form');
    const saveButton = document.getElementById('task-form-btn');

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

    // SAVE / UPDATE BUTTONS EVENT LISTENERS
    saveButton.addEventListener("click", () => {
        callSave(userId);
    });

    // Allow to save/update data by pressing "Enter"
    taskInput.addEventListener("keydown", event => {
        if (event.code === "Enter"){
            callSave(userId);
        }
    });

    // const taskNumber = document.getElementById("task-number");
    // const encourage = document.getElementById("encourage");
    // const tableIncomplete = document.getElementById("user-tasks");
    // const tableComplete = document.getElementById("user-completed-tasks");
    
    // Encouragment text - if there are tasks display 1st element, if no tasks - display 2nd element
    // const encourageText = ["Let's do some work 💪", "Time to rest 👌"];


    // // if value.length is 0 change name to save and remove taskid attribute
    // taskInput.addEventListener("input", () => {
    //     if (taskInput.value.length === 0) {
    //         taskInput.setAttribute("taskid", "");  
    //     } 
    // });

    // // track if input field is selected
    // taskInput.addEventListener("keydown", event => {
    //     if (event.code === "Enter"){
    //         callSave(userId);
    //     }
    // });

    // // SAVE / UPDATE BUTTONS EVENT LISTENERS
    // saveButton.addEventListener("click", () => {
    //     callSave(userId);
    // });
    
    // // LISTEN TO CHANGES IN ATTRIBUTE
    // const observer = new MutationObserver( mutations => {
    //     mutations.forEach( mutation => {
    //         console.log("mutation triggered");
    //         if (mutation.type === "attributes" && mutation.attributeName === "taskid") {
    //             if (!!taskInput.getAttribute("taskid")){
    //                 saveButton.innerText = "Update";
    //             } else {
    //                 saveButton.innerText = "Save";
    //             }
    //         }
    //     });
    // });
    
    // // Observer listening to atribute changes in taskInput const
    // observer.observe(taskInput, {
    //     attributes: true
    // });
    
    // // SAVE FUNCTIONALITY
    // function callSave(userId) {
    //     const formData = {
    //         id: taskInput.getAttribute("taskid"),
    //         user_id: userId,
    //         description: taskInput.value
    //     };

    //     taskInput.value = "";
    //     taskInput.setAttribute("taskid", "");

    //     // implement error handling
    //     if (formData.description.length === 0) return;

    //     fetch(`${baseURL}${saveTaskAPI}`, {
    //         method: 'POST',
    //         body: JSON.stringify(formData)
    //     })
    //     .then( () => {
    //         getUserData();
    //     })
    //     .catch(err => console.error(err));
    // }



    // // UPDATE FUNCTIONALITY
    // async function callEdit(id) {
    //     const taskInput = document.getElementById("task-input-form");
        
    //     taskInput.setAttribute("taskId", id);
        
    //     const response = await fetch(`${baseURL}${editTaskAPI}${id}`);
        
    //     const [taskData] = await response.json();
        
    //     taskInput.value = taskData.description;
    //     taskInput.focus();
    // }

    // CHECKBOX FUNCTIONNALITY
    // function handleCheckbox(taskStatus){
    //     fetch(`${baseURL}${completeTaskAPI}`, {
    //         method: 'POST',
    //         body: JSON.stringify(taskStatus)
    //     })
    //     .then( () => {
    //         // then re-render the page contents
    //         getUserData(userId);
    //     })
    //     .catch(err => console.error(err));
    // }

    // DELETE FUNCTIONALITY
    // function callDelete(id) {
    //     // implement error handling
    //     fetch(`${baseURL}${deleteTaskAPI}`, {
    //         method: 'POST',
    //         body: JSON.stringify({id: id})
    //     })
    //     .then( () => {
    //         getUserData(userId);
    //     })
    //     .catch(err => console.error(err));
    // }


    // FUNCTION TO GET DATA FROM THE API
    // async function getUserData() {
    //     // Call the API
    //     const response = await fetch(`${baseURL}${getUserDataAPI}${userId}`);

    //     // Parse incoming JSON
    //     const apiData = await response.json();

    //     // Separate all incoming tasks into incompleted tasks:
    //     const incompleteTasks = apiData.filter( task => !Number(task.is_completed));

    //     // And completed tasks
    //     const completeTasks = apiData.filter( task => Number(task.is_completed));

    //     // Display remaining task number in the "Task Counter"
    //     taskNumber.innerText = incompleteTasks.length;

    //     // Display the encouragment text
    //     incompleteTasks.length ? encourage.innerText = encourageText[0] : encourage.innerText = encourageText[1];

    //     // FOR TESTING PURPOSES
    //     // console.group("Grouping tasks to complete and not:");
    //     // console.log("incomplete:")
    //     // console.log(incompleteTasks);
    //     // console.log("complete:")
    //     // console.log(completeTasks);
    //     // console.groupEnd();

    //     // Populate incompleted task table with data
    //     tableIncomplete.innerHTML = incompleteTasks.map( task => {
    //         return `
    //         <tr>
    //             <td> <input type="checkbox" checkboxId="${task.id}"> </td>
    //             <td class="td-description"> ${task.description} <hr class="td-hr"> </td>
    //             <td class="td-btn"> <button class="btn edit-btn" buttonId="${task.id}"> <i class="fas fa-edit"></i> </button> </td>
    //             <td class="td-btn"> <button class="btn delete-btn delete" buttonId="${task.id}"> <i class="fas fa-trash"></i> </button> </td>
    //         </tr>
    //         `;
    //     }).join("");

    //     // Populate completed task table with data
    //     tableComplete.innerHTML = completeTasks.map( task => {
    //         return `
    //         <tr>
    //             <td> <input type="checkbox" class="checkbox-completed" checkboxId="${task.id}"> </td>
    //             <td class="td-description completed-task"> ${task.description} <hr class="td-hr"> </td>
    //             <td class="td-btn"> <button class="btn big-delete-btn delete" buttonId="${task.id}"> Delete </button> </td>
    //         </tr>
    //         `;
    //     }).join("");

    //     // Get all checkboxes from the complete table and set checed status to true
    //     const completedCheckboxes = document.querySelectorAll(".checkbox-completed");
    //     Object.values(completedCheckboxes).forEach( checkBox => checkBox.checked = true);

    //     // Add DELETE event listeners
    //     const deleteButtons = document.querySelectorAll(".delete");
    //     Object.values(deleteButtons).forEach( button => button.addEventListener("click", () =>  {
    //         callDelete(button.getAttribute("buttonId"));
    //     }));

    //     // Add EDIT event listeners
    //     const editButtons = document.querySelectorAll(".edit-btn");
    //     Object.values(editButtons).forEach( button => button.addEventListener("click", () => {
    //         callEdit(button.getAttribute("buttonId"));
    //     }));

    //     // Add event listeners to checkboxes
    //     const checkboxes = document.querySelectorAll("input[type=checkbox]");
    //     Object.values(checkboxes).forEach( checkbox => checkbox.addEventListener("change", () => {
    //         //checkbox.checked is a boolean, so setting the accordng status:
    //         const taskStatus = {
    //             id: Number(checkbox.getAttribute("checkboxId")),
    //             is_completed: Number(checkbox.checked)
    //         };
            
    //         //calling update
    //         handleCheckbox(taskStatus);
            
    //     }));

    // }

});