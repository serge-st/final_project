document.addEventListener("DOMContentLoaded", () => {
    
    const baseURL = "/final_project/api";
    const testAPI = "/test_api.php?user_id=";
    
    // FIELDS THAT ARE GOING TO BE MODIFIED:
    if (!document.getElementById("session-heading")){
        return "";
    }
    
    const userId = document.getElementById("session-heading").getAttribute('user-id');
    const taskNumber = document.getElementById("task-number");
    const encourage = document.getElementById("encourage");
    const encourageText = ["Let's do some work 💪", "Time to rest 👌"];
    // const encourageText = ["Let's do some work", "Time to rest"];
    const tableIncomplete = document.getElementById("user-tasks");
    const tableComplete = document.getElementById("user-completed-tasks");
    console.group("Testing info:");
    console.log("user_id: ", userId);
    console.log("API URL: ", `${baseURL}${testAPI}${userId}`);
    console.groupEnd();

    getUserData()
    .catch(err => console.error(err));


    // FUNCTION TO GET DATA FROM THE API
    async function getUserData() {
        const response = await fetch(`${baseURL}${testAPI}${userId}`);
        const apiData = await response.json();
        incompleteTasks = apiData.filter( task => !Number(task.is_completed));
        completeTasks = apiData.filter( task => Number(task.is_completed));
        // apiData.forEach( task => console.log("compl: ",task.is_completed));
        taskNumber.innerText = incompleteTasks.length;
        incompleteTasks.length ? encourage.innerText = encourageText[0] : encourage.innerText = encourageText[1];

        console.group("Grouping tasks to complete and not:");
        console.log("incomplete:")
        console.log(incompleteTasks);
        console.log("complete:")
        console.log(completeTasks);
        console.groupEnd();

        incompleteTasks.forEach( task => console.log(`<tr>${task.description}</tr>`));

        console.log(tableIncomplete);

        tableIncomplete.innerHTML = incompleteTasks.map( task => {
            return `
            <tr>
                <td> <input type="checkbox"> </td>
                <td class="td-description"> ${task.description} <hr class="td-hr"> </td>
                <td class="td-btn"> <button class="btn edit-btn"> <i class="fas fa-edit"></i> </button> </td>
                <td class="td-btn"> <button class="btn delete-btn"> <i class="fas fa-trash"></i> </button> </td>
            </tr>
            `;
        }).join("");

        tableComplete.innerHTML = completeTasks.map( task => {
            return `
            <tr>
                <td> <input type="checkbox"> </td>
                <td class="td-description completed-task"> ${task.description} <hr class="td-hr"> </td>
                <td class="td-btn"> <button class="btn big-delete-btn"> Delete </button> </td>
            </tr>
            `;
        }).join("");
    }





});