Laravel version: 9
PHP version : 8.1

Need to follow this steps:

Steps -1
First need to install composer using this command : `composer install`

Step -2 
First need to Create `.env` file and paste data on this file `.env.example`
make sure you have to check to `.env` of your db credentials

Step - 3
Database Set Up:
    -> First create one Database:
    -> Database name should be `innvonix`
    -> then after run migration , run this command to terminal: `php artisan migrate`
    -> then after run seeder, run this command to terminal : `php artisan db:seed`

Step - 4
    Run project using `php artisan serve`


------------------- PRACTICAL TASK DETAILS------------------------------   

    USER ROLES:
        Admin
        Project Manager
        Developer
    
    Admin:
        Admin can access the all rights of project and create project tasks and assign project to project manager and developer.

    Project Manager:
        Only Access assigned project and project manager can access all rights of assigned project.

    Developer:
        Developer can see only this project and task.
    

    ------ SIGN UP PROCESS ------

    First user need to sign up with respected roles.
    user can login with respected credentials.

    ---------------

    NOTE:
    -> First you have to show project list then after you can click on project name then see their project all task.
    -> Then after admin or project manager assign task to developer.
    