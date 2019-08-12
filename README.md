# UserDonation

This project creates a sample user donation application.

The website is:

Donatemagic-env.zznusq9pzp.us-east-2.elasticbeanstalk.com

Scope of the project:

There are a given set of charities that a user can donate to.

A user can register and login into the system.

A user, when loggedin, gets a welcome message.

A list of charities & their details are displayed to both guest users and loggedin users

A charity can be clicked to be donated by a loggedin user.

A user can donate to any number of charities.

A user is provided a donation form to input donation amount and billing address. Each billing address entered is treated as new payment type.

A donation search can be performed by optional filtering parameters by charity_id, user_id or none.


Bonus items but did not have time to do:
1. Create re-usable billing addresses to make them unique.
2. Pagination on donation search and charity list.

My WhiteBoard notes to plan for this exercise:

Understand requirements
Technologies
   Laravel for both back end and front end (views)
   MySql Database
Implementation plan
- github repo set up
- basic laravel app setup
- define database and tables
- seed any tables
- Implement user donation
- Error handling & tests 
- Code cleanup
- create a README file

Tasks:

- Create migrations for tables creation and seed data for Charity.
- Create Models for this project and define the relationships.
- Create endpoint to add a user to the system.
- Create a login endpoint to allow a user to login.
- Create a logout endpoint for the user to logout.
- Create endpoint to return user details.
- Add a endpoint that posts user donation for a given charity
- Add a endpoint that returns donations based on filters
- Add route wrapped in Auth.
- Add views to display data and input data.
- Implement a function to find the winner and end the game
- Handle any race conditions

writing tests:
1. happy path use cases
2. variations of happy path
3. Edge cases
4. try complex use case


- Test that the donation can be made successfully to a specific charity
- Test that a donation cannot be made to a invalid charity or the one that is no longer active.
- Test that user can login to see the a list of charities to pick from.
- Test that donation action is complete


