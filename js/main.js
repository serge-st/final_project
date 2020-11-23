document.addEventListener("DOMContentLoaded", () => {
    
    const baseURL = "/final_project/api";
    const testAPI = "/test_api.php?user_id=";

    // FIELDS THAT ARE GOING TO BE MODIFIED:
    const userId = document.getElementById("session-heading").getAttribute('user-id');
    const taskNumber = document.getElementById("task-number");
    const taskText = document.getElementById("task-counter-text");

    console.group("Testing info:");
    console.log("user_id: ", userId);
    console.log("API URL: ", `${baseURL}${testAPI}${userId}`);
    console.groupEnd();

    // FUNCTION TO GET DATA FROM THE API
    async function getUserData() {
        const response = await fetch(`${baseURL}${testAPI}${userId}`);
        const apiData = await response.json();
        taskNumber.innerText = apiData.length;
        apiData.forEach( task => console.log(task.description));
    }

    getUserData()
    .catch(err => console.error(err));

    // fetch(`/final_project/api/test_api.php?user_id=${userId}`)
    // .then(result => result.json())
    // .then(data => console.log( data ) );


});