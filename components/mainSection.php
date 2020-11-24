<?php

?>
<div class="counter-section">
    <p id="task-counter-text">Task Counter:&nbsp<span id="task-number"></span></p> <p id="encourage"></p>
</div>

<h4 class="add-new-task-heading">Add A New Task:</h4>

<form method="POST" class="new-task-form">
    <input type="text" placeholder="Enter The New Task"></input>
    <button type="submit" class="btn">Update</button>
</form>

<table>
    <tbody id="user-tasks"></tbody>
</table>
<table>
    <tbody id="user-completed-tasks"></tbody>
</table>

