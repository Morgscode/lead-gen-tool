# lead-gen-tool

//--- INTRODUCTION

A pretty basic tool you can use to track and manage you leads. Obviously it's a little side project.

If you pull this repo and load it into your preferred php/mysql environemnt (MAMP, XAMMP, WAMP) it will create the necessary DBs and Tables so long as it is allowed root access to your server.

Nothing special here guys, mostly just some self-teaching as I work hard to progress from front-end to server-side development.

This project isn't a codealong, but I did use the very helpful PHP practitioner lectures from Laracasts to kickstart the thinking process. 

//--- OVERVIEW

It's essentially a very simple SPA built in pure PHP. The entry point is the index.php file which requires and instantiates a router, this handles the HTTP requests and will return a view based on the URI. These views give the page access to designated controller Logic which will handle the on-page functionality when further requests are made. 

I've decided to use pure JS for the client-side logic. There was no real need for jQuery. 

The client-side logic uses IIFEs stored within a variable to prevent the scripts from polluting the global scope. As the logic is specific to each view, methods returned from the relative IFFE are only trigger in that specific view. 

For the 'manage-view' I decided to veer of the original logic course, and instead of building a seperate view for each manage action, I'm now working towards creating a client-side ajax app which will handle the CRUD requests for each action, utilising js promises. As this is a personal project for self-teaching, I feel it's totally acceptable to do this as I'm pushing myself to learn newer concepts, instead of adding extra functionality, by using a 'frame-work' that I'm already comfortable with.  

Both the client and server-side logic uses an MVC style architecture, in an attempt to keep the code orderly, maintainable and perhaps even scalable. I also preffered an OOP pattern, as opposed to functional programming with a view of keeping to the DRY principle. Because everyone hates repition. 

There are still some blocks of code which need refactoring. For example, a query builder class on the server-side would really scale down the (php) controller logic.

//--- STACK

SERVER-SIDE -> PHP, MySQL (PDO)
CLIENT-SIDE -> Bootstrap, JS

//--- requirements
PHP, MySQL environment with root access to mysql server

Google chrome (Jquery still holds value for DOM traversing across browsers, so this will not work in firefox as the e.path values vary across the browsers).
