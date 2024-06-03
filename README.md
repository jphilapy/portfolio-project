# README
Follow this repo to get a better idea of my skillset. This codebase includes a semi-roll my own MVC, utlizing PHP-DI for
dependency injection. 

The MVC is a bit rough around the edges. Although I have used Laravel and Codeigniter, and tinkered
with others, I have never attempted to assemble one from, mostly, scratch. *For learning purposes.*

### Setup
1. Necessary sql files are located in the res directory
2. See .env.example to make your .env file. Configure it with the relevant details
3. Run: **composer install**
4. Run: npm install
4. Run server: **php -S localhost:8000**

### OTher
To run testing: At command line type: **npx cypress run**
or ***npx cypress open** to open the interface 


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
Looking for a post route in routes.php. Make sure you have the relevant route to handle a POST
