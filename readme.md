## Start the project ##
run "ddev start"
open https://wordpressplugin.ddev.site

## dependencies ##
- Docker
- npm

## structure ##
you can find all files releated to the app in
plugins/article-app/

## Used technologies ##
I used Vite for creating the react-App, because it seems to be more straight forward to get quick solutions.

## To-Do ##
- Plugin direkt über die Oberfläche installieren können
- Plugin via Gutenberg Editor einbinden können
- react so einbinden, dass der Code nicht im Pluin-Ordner liegt, es jedoch automatisch dorthin gerendet werden kann
- bilder aus assets ordner zum laufen bringen

## Installation ##
ddev config --project-type=wordpress --docroot=.
ddev start
ddev wp core download
ddev wp config create --dbname="db" --dbuser="db" --dbpass="db" --dbhost="ddev-wordpressPlugin-db"?
ddev wp db create?
ddev wp core install --url="https://wp-plugin.ddev.site" --title="My WordPress Plugin" --admin_user="admin" --admin_password="password" --admin_email="admin@example.com"
ddev wp rewrite flush
ddev restart

ddev wp option get siteurl

---

Plugin erstellen
npm init -y
npm install -g npm (update npm)
npx clear-npx-cache
npm create vite@latest article-app --template react
cd article-app
npm install
npm run dev (führt laufend automatisch builds bei Änderungen durch)
npm run build (führt bei Eingabe build durch)

---
Plugin aktivieren
- wp adminpanel Plugins > Installed Plugins

getestete VS-Code Extensions:
- Wordpress Development Toolkit
- WordPress Snippets

ablauf:
- scripts enqueuen (actions are the hooks, that the wp-core launches at specific points)