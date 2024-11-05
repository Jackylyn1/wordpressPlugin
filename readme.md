## Introduction | Explaination ##
### /wp-content/plugins/article-app/Article-app.php ###
1. I decided to make it a class, so I can reuse some variables in Object context and have everything needed on startup in the constructor. Because it was only a small script no complex architecture was needed.
2. I made the registration of the .js and .css more flexible, so they will be loaded with dynamic filenames even if the name of the file changes, which happens for example after a rebuild of the React Application.
3. I also registered the Button for the "Gutenberg-Editor" and the shortcode for the App "[article_app]" here. It has the name "Article Overview".

### /wp-content/plugins/article-app/Article-overview-block.js ###
1. The Button for the "Gutenberg-Editor" is created here and added to the editor.

### /wp-content/plugins/article-app/src (React) ###
1. I decided to use a basic structure for Components which handle the API-calls. They are extending from an abstract class with already implements some basic API-Calls.
3. Every Result of an API-Call has a state, a resultset and potential errors. So I decided to make an Interface for Results.
3.1. Because every resultset of the child classes (e.g. user, article, category) can have a different structure I decided to use generic Types for results inside of the API-Call Class
3.2. I also added Interfaces for the different types to enhance type security
4. Apps root ist app.tsx

### DDEV ###
1. I added pre-stop and post-start-hooks for exporting and importing the database so you won't have to install anything after you checked out the repo from git.

### What would I have done if I had more time ###
1. I would have invested more time for thinking about architecture, especially inside of the react-App. 
1.1. I still have some open questions about this e.g. I could have implemented services or think about using contexts. 
1.2. There also could have been better options to implement the users instead of using render inside of a component.
2. I would have added phpdocs
3. More thoughts about efficient API-Calls. E.g. get the users and categories all together instead of getting every single one after another.

## dependencies ##
- Docker
- ddev
- npm

## Start the project ##
1. run "ddev start"
2. open https://wordpressplugin.ddev.site
3. that's it ;)

### Logindata ###
* Path: https://wordpressplugin.ddev.site/wp-admin/
* Username: Admin
* Password: Password


## structure ##
you can find all files releated to the app in
plugins/article-app/

## Used technologies ##
I used React and Wordpress as base technologies. Additionally I used the following:
### Vite ###
I used Vite for creating the React-App, because it seems to be more straight forward to get quick solutions, than f.e. next.js. It also gives me a base structure for the beginning and some functionalities.

### ddev ###
I wanted to have a testing environment you can use easily on your own system.