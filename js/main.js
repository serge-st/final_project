document.addEventListener("DOMContentLoaded", () => {
    
    const baseURL = "/final_project/api";
    const testAPI = "/test_api.php?user_id=";

    // FIELDS THAT ARE GOING TO BE MODIFIED:
    const userId = document.getElementById("session-heading").getAttribute('user-id');
    const taskNumber = document.getElementById("task-number");
    const encourage = document.getElementById("encourage");
    const encourageText = ["Let's do some work 💪", "Time to rest 👌"];
    const tableIncomplete = document.getElementById("user-tasks");
    const tableComplete = document.getElementById("user-completed-tasks");

    console.group("Testing info:");
    console.log("user_id: ", userId);
    console.log("API URL: ", `${baseURL}${testAPI}${userId}`);
    console.groupEnd();

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
                <td>${task.description}</td>
                <td> <button class="btn">Edit</button> </td>
                <td> <button class="btn">Delete</button> </td>
            </tr>
            `;
        }).join("");

        tableComplete.innerHTML = completeTasks.map( task => {
            return `
            <tr>
                <td class="completed-task">${task.description}</td>
                <td> <button class="btn">Delete</button> </td>
            </tr>
            `;
        }).join("");
    }

    getUserData()
    .catch(err => console.error(err));

    // fetch(`/final_project/api/test_api.php?user_id=${userId}`)
    // .then(result => result.json())
    // .then(data => console.log( data ) );


});