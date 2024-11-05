## Introduction | Explaination ##
### /wp-content/plugins/article-app/Article-app.php ###
1. I structured this code as a class to allow reuse of variables in an object-oriented context, consolidating everything needed on startup in the constructor. Given that this is a small script, a more complex architecture wasn’t necessary.
2. I made the JavaScript and CSS registration more flexible, enabling dynamic filenames. This ensures that files are loaded correctly, even if filenames change after rebuilding the React application.
3. I registered the button for the Gutenberg editor here, as well as the app’s shortcode [article_app]. This button is labeled "Article Overview."

### /wp-content/plugins/article-app/Article-overview-block.js ###
1. This file creates the button for the Gutenberg editor and adds it to the editor interface.

### /wp-content/plugins/article-app/src (React) ###
1. I implemented a basic structure for components that handle API calls. Components inherit from an abstract class that already implements common API calls.
2. Each API call result has a state, a result set, and potential errors. I created an interface to standardize results.
2.1. Since child classes (e.g., user, article, category) may have different data structures, I used generic types for results within the API call class.
2.2. Additionally, I defined specific interfaces for each type to ensure type safety.
3. The app’s root file is app.tsx.

### DDEV ###
1. I added pre-stop and post-start hooks for exporting and importing the database, so after checking out the repository, no additional setup is required.

### What would I have done if I had more time ###
1. I would invest more time in planning the app’s architecture, particularly within the React app.
1.1. I would explore solutions like implementing services or using contexts.
1.2. There could also be more efficient ways to manage user data rather than rendering it within a component.
2. I’d refine API calls to improve efficiency. For instance, retrieving users and categories in a single request rather than making separate requests.

### Did I use a framework? ###
No

### What does Clean-Code mean to me ###
Clean code to me means maintainable, readable, and efficient code. The most important clean-code principles I follow include:

1. Readability and clarity e.g.: Use meaningful names for variables, functions, and objects.
2. Logical organization: Keep related code together and avoid redundancy.
3. Function structure: Keep functions concise, with minimal arguments and a single purpose.
4. Minimal comments: Write code that documents itself, with comments reserved for complex logic or PHPDocs.
5. Consistent formatting and a clear project structure.

### Do I programm OOP or functional? ###
I chose OOP for better modularity, easier maintenance, and to make the codebase easier to extend. Although the project is currently small, using OOP allows for scaling, for example, by adding more API functionality in the future.

## dependencies ##
- Docker
- ddev
- npm

## Start the project ##
1. run "ddev start"
2. open https://wordpressplugin.ddev.site
3. If it doesn’t load immediately, wait a moment and refresh the page.

### Logindata ###
* Url: https://wordpressplugin.ddev.site/wp-admin/
* Username: Admin
* Password: Password


## structure ##
All files related to the app are located in plugins/article-app/.

## Used technologies ##
This project uses React and WordPress as the base technologies, with additional tools as follows:

### Vite ###
I used Vite to create the React app. It provides a simple and efficient setup, making it a quicker solution than Next.js for this project. It also offers a foundational structure and some built-in functionalities.

### ddev ###
To facilitate an easy-to-use testing environment, I set up DDEV, allowing the project to run on any system with minimal setup.