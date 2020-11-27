<?php

?>
<div class="counter-section">
    <p id="task-counter-text">Task Counter:&nbsp<span id="task-number"></span></p> <p id="encourage"></p>
</div>

<h4 class="add-new-task-heading">Add A New Task:</h4>

<div class="new-task-form">
    <input type="text" placeholder="Enter The New Task Here" maxlength="40" name="taskInput" id="task-input-form" taskId></input>
    <button class="btn wide-btn" id="task-form-btn">Save</button>
</div>

<table>
    <tbody id="user-tasks"></tbody>
</table>
<table>
    <tbody id="user-completed-tasks"></tbody>
</table>

