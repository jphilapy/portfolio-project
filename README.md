# README
Follow this repo to get a better idea of my skillset. This codebase includes a semi-roll my own MVC, utlizing PHP-DI for
dependency injection. 

The MVC is a bit rough around the edges. Although I have used Laravel and Codeigniter, and tinkered
with others, I have never attempted to assemble one from scratch, for learning purposes.

### Setup

necessary sql files are located in the res directory


To run: **php -S localhost:8000**


### Common Error Messages
**Class "AdminController" does not exist**

``` 
Fatal error: Uncaught ReflectionException: Class "AdminController" does not exist in /Users/yourusername/projects/projectname/src/Router.php:31 
```
Make sure you include the use statement for the relevant class being used in your routes.php file.

**No route found for POST /dashboard**
```
Fatal error: Uncaught Exception: No route found for POST /dashboard
```
