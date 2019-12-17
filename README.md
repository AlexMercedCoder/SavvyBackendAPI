# Savvy Hotspots
### by Erik Ciceraro and Alex Merced (AlexMercedCoder.com)
* This repo is back-end code, find the front-end react code at https://github.com/AlexMercedCoder/SavannahHotspots

## Summary

Savvy Hotspots is an application that allows users to find restaurants in popular Savannah neighborhoods,
find their information, and leave a comment about the restaurant. There is also a feature to look up and
comment on restaurants from any zip-code.

## Technologies Used

- PHP to design the API
- PostgreSQL as the database for storing comments by users
- React to create a front-end Single Page Application
- React Router to manage navigation
- Heroku to host the backend API and database
- Netlify to host the front-end web Application

## Wireframes and planning documents

![plan](https://i.imgur.com/KMX7As5.jpg) "Planning Doc pg 1"

![plan](https://i.imgur.com/6nZpCjg.jpg) "Planning Doc pg 2"

![wireframe](https://i.imgur.com/MC5g0Ed.png) "Wireframe 1"

![wireframe](https://i.imgur.com/W13uoZT.png) "Wireframe 2"

![wireframe](https://i.imgur.com/bROwI4H.png) "Wireframe 3"

![wireframe](https://i.imgur.com/pVF4Gzu.png) "Wifeframe 4"

## Component Breakdown

### App

- Uses React router to manage menu

- Stateless, push zip code props to neighborhood pages

### Display

- Fetches restaurants from Opentables API for zip code passed as props

- Maintains a array state variable for holding array of restaurans.

- iterates through each array item and generates a restaurant Component which is passed the whole restaurant as props

### Restaurant

- populates information on restaurant and create a comments component.

- Stateless

- passes restaurant id to comments Component

### Comments

- Populates list of comments based on restaurant id from our custom PHP API

- State includes an array to hold Comments

- create a Comment component and gives it the restaurant id as props along with its getcomments function


### Comment

- Generates a form to create a new comment

- State includes variables for form submission

- Form is submitted, then getcomments function is run to re-get Comments

### Search

- Renders a form to enter any 5 digit zipcode, when submitted will mount a display component for that zip code.

- Maintains state for form

## Challenges

- Ran into issues avoiding CORS errors, while I tried adding the API headers many in class and online suggested the only thing that worked was CORS anywhere which definetley impacted the speed of the application.

- Since three of the navigation items displayed the same component with different props, they were initially not updating as router switched between them. The solution was to give each of them a unique key.

- CORS Anywhere was getting upset about too many API called when 25 restaurants would appear querying our back-end for comments. Solution was to create a show/hide button for comments so it would only mount the comments the user wants o see minimizing requests.

- After post a new comment, the response was not turning into JSON successfully so we could push it into the existing array of comments. Solution was to pass the getComments function as a prop but in production this could lead to overhead from excess API requests.
