export async function callEdit(id) {
    const baseURL = "/final_project/api";
    const editTaskAPI = "/editTask.php?id=";

    const taskInput = document.getElementById("task-input-form");
    taskInput.setAttribute("taskId", id);
    
    const response = await fetch(`${baseURL}${editTaskAPI}${id}`);
    const [taskData] = await response.json();
    
    taskInput.value = taskData.description;
    taskInput.focus();
}