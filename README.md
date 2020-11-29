# DOIT App
## The complete project is available [here](https://doitapp.live).

## Project's functionality:
1. Register / Login functionality.
2. Each user receives a unique id number upon registration.
3. Passwords are encrypted using PHP's hash_hmac() (using "sha256" algorythm and a randomly (once) generated token).
4. Input and Register form data validation (using inbuilt html validation).
5. Error handling (popups with error message).
6. User session validation upon login.
7. Dynamically rendered data on the App's main page (User's name, Total uncomplete task count, and list of tasks).
8. Input field to add new tasks (tasks get saved in the database).
9. Ability to edit and delete tasks.
---
## Task desciption:
### Create  a todo list
1. Create a page where we show a input field where we can add a to-do item
2. When submitted the item is shown in a list under the input
3. Before the item, there is a checkbox, when checked - the item goes to a second list under the first one. This action can be reversed.
4. Add the possibility to delete the items (from both lists)
5. Add the possibility to edit an existing item (from not checked list)

*Extra*:

6. Allow to order the items in unchecked list
7. Add a login page and track the list based on the user