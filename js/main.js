document.addEventListener("DOMContentLoaded", () => {
    
    const baseURL = "/final_project/api";
    const testAPI = "/test_api.php?user_id=";
    const saveTaskAPI = "/saveTask.php";
    const deleteTaskAPI = "/deleteTask.php";
    const updateTaskAPI = "/updateTask.php";

    console.group("API URL:");
    console.log("user_id: ", "< userId_goes_here >");
    console.log("API URL: ", `${baseURL}${testAPI}< userId_goes_here >`);
    console.groupEnd();
    

    // CHECK IF THE USER LOGGED IN
    if (!document.getElementById("session-heading")){
        return "";
    }

    // FIELDS THAT ARE GOING TO BE MODIFIED:
    const userId = document.getElementById("session-heading").getAttribute('user-id');
    const taskInput = document.getElementById('task-input-form');
    const taskNumber = document.getElementById("task-number");
    const encourage = document.getElementById("encourage");
    const tableIncomplete = document.getElementById("user-tasks");
    const tableComplete = document.getElementById("user-completed-tasks");
    const saveButton = document.getElementById('task-form-btn');

    // if value.length is 0 change name to save and remove taskid attribute
    taskInput.addEventListener("input", () => console.log('task input field character amount: ', taskInput.value.length));

    // LISTEN TO CHANGES IN ATTRIBUTE
    const observer = new MutationObserver( mutations => {
        mutations.forEach( mutation => {
            console.log(mutation)
            if (mutation.type === "attributes" && mutation.attributeName === "taskid") {
            console.log("attributes changed");
            saveButton.removeEventListener("click", () => callSave(userId));
            saveButton.innerText = "Update";
            }
        });
        });
    
    // Observer listening to atribute changes in taskInput const
    observer.observe(taskInput, {
        attributes: true
    });
    
    // Encouragment text - if there are tasks display 1st element, if no tasks - display 2nd element
    const encourageText = ["Let's do some work 💪", "Time to rest 👌"];
    
    // Get data for the current user and update all the elements
    getUserData()
    .catch(err => console.error(err));

    saveButton.addEventListener("click", () => callSave(userId));
    
    function callSave(userId) {
        const formData = {
            user_id: userId,
            description: taskInput.value
        };

        taskInput.value = "";

        // implement error handling
        if (formData.description.length === 0) return;

        fetch(`${baseURL}${saveTaskAPI}`, {
            method: 'POST',
            body: JSON.stringify(formData)
        })
        .then(response => {
            getUserData();
            console.log(response);
        })
        .catch(err => console.error(err));
        // then implement error handling
        
        
        // .catch(err => console.error(err));
    }

    function callDelete(id) {
        // implement error handling

        fetch(`${baseURL}${deleteTaskAPI}`, {
            method: 'POST',
            body: JSON.stringify({id: id})
        })
               .then(response => {
            getUserData();
            console.log(response);
        })
        .catch(err => console.error(err));
    }

    async function callUpdate(id) {
        // maybe will need to use MutationObserver
        const taskInput = document.getElementById("task-input-form");
        taskInput.setAttribute("taskId", id);
        
        const response = await fetch(`${baseURL}${updateTaskAPI}?id=${id}`);
        
        const [taskData] = await response.json();
        
        taskInput.value = taskData.description;
        console.log(taskData);
    }


    // FUNCTION TO GET DATA FROM THE API
    async function getUserData() {
        // Call the API
        const response = await fetch(`${baseURL}${testAPI}${userId}`);

        // Parse incoming JSON
        const apiData = await response.json();

        // Separate all incoming tasks into incompleted tasks:
        incompleteTasks = apiData.filter( task => !Number(task.is_completed));

        // And completed tasks
        completeTasks = apiData.filter( task => Number(task.is_completed));

        // Display remaining task number in the "Task Counter"
        taskNumber.innerText = incompleteTasks.length;

        // Display the encouragment text
        incompleteTasks.length ? encourage.innerText = encourageText[0] : encourage.innerText = encourageText[1];

        // FOR TESTING PURPOSES
        console.group("Grouping tasks to complete and not:");
        console.log("incomplete:")
        console.log(incompleteTasks);
        console.log("complete:")
        console.log(completeTasks);
        console.groupEnd();

        // Populate incompleted task table with data
        tableIncomplete.innerHTML = incompleteTasks.map( task => {
            return `
            <tr>
                <td> <input type="checkbox"> </td>
                <td class="td-description"> ${task.description} <hr class="td-hr"> </td>
                <td class="td-btn"> <button class="btn edit-btn" buttonId="${task.id}"> <i class="fas fa-edit"></i> </button> </td>
                <td class="td-btn"> <button class="btn delete-btn delete" buttonId="${task.id}"> <i class="fas fa-trash"></i> </button> </td>
            </tr>
            `;
        }).join("");

        // Populate completed task table with data
        tableComplete.innerHTML = completeTasks.map( task => {
            return `
            <tr>
                <td> <input type="checkbox" class="checkbox-completed"> </td>
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
            callDelete(button.getAttribute("buttonId"));
            getUserData()
            .catch(err => console.error(err));
        }));

        // Add EDIT event listeners
        const editButtons = document.querySelectorAll(".edit-btn");
        Object.values(editButtons).forEach( button => button.addEventListener("click", () => {
            callUpdate(button.getAttribute("buttonId"));
        }));

    }





});