## What do you need?

To work this app, you need to create:
1. Database with the name: vueschool
2. Execute the command " php artisan migrate --seed " : with this command automatically create to table users with 20 users

## Update Information of users

Use the command " php artisan app:update-users ", you can update with data fake the information of user specially the name, last_name and the time_zone.

## Exercise 

You need to change the branch to VS-UpdateUserByApi

Before to test you need to execute again the command migration (php artisan migrate) because I use job, batches and queue, I worked with Service in where contained the logic.

## For Batch Request

In the service, UserService handles the logic. I created a job that executes the API call, and a controller called BatchUserController. I also used Bus::batch() to process users in batches of up to 1,000 users.
Additionally, I created a new command for two reasons:

1. To call the controller (BatchUserController).
2. To execute the command in the kernel and schedule it to run hourly.

Before execute the command you need to change in the .env file the value of QUEUE_CONNECTION to database. (QUEUE_CONNECTION=database)

When execute the command is necessary, have the command run "php artisan queue:listen" in your local or in the service the command "php artisan queue:work".

## For Individual Request

Create a controller UserThirdApiController, call to the method updateUserIndividual of UserService, this controller has a route for call the method.  
