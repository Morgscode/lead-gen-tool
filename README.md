# lead-gen-tool

//--- INTRODUCTION

A pretty basic tool you can use to track and manage you leads. Obviously it's a little side project.

If you pull this repo and load it into your preferred php/mysql environemnt (MAMP, XAMMP, WAMP) it will create the necessary DBs and Tables so long as it is allowed root access to your server.

Nothing special here guys, mostly just some self-teaching as I work hard to progress from front-end to server-side development.

This project isn't a codealong, but I did use the very helpful PHP practitioner lectures from Laracasts to kickstart the thinking process. 

//--- OVERVIEW

It's essentially a very simple SPA built in pure PHP. The entry point is the index.php file which requires and instantiates a router, this handles the HTTP requests and will return a view based on the URI. These views give the page access to designated controller Logic which will handle the on-page functionality when further requests are made. 

I've decided to use pure JS for the client-side logic, but this is really just DOM manipulation. There was no real need for jQuery. 

The client-side logic uses IIFEs stored within a variable to prevent the scripts from polluting the global scope, as the app progresses, I would like to build in some AJAX functions for handling META data associated to companies. 

//--- STACK

SERVER-SIDE -> PHP, MySQL (PDO)
CLIENT-SIDE -> Bootstrap, JS
