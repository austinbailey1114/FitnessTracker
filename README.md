# LiftAppSite
## Features ##
This repository is a companion website for [LiftApp](https://github.com/austinbailey1114/iOS). It tracks user data about weight lifting, nutrition, and bodyweight using MySQL. The site shares a MySQL database with the app, so user data is synced up on both platforms. 
### Lift Tracking ###
Users can quickly input a new lift and have it stored in MySQL. Their data is graphed using [Charts.js](http://www.chartjs.org/) in such a way that they can see their progress over time. Users can enter their own types of lifts, and each type the've used before is saved for them as an available choice. Users can also view their lifts as a table and delete any lifts they wish to remove. 
### Food Tracking ###
The website is connected to my [Nutrition API](https://github.com/austinbailey1114/NutritionAPI), making a GET call using user-input search information. Users can easily add a food that they've eaten. The API shows them a list of what foods they have eaten that day, as well as nutritional information about what they have eaten overall that day. 
### Weight Tracking ###
Much like the lift tracking, users can input their bodyweight and see how it changes over time using a graph.
## Pictures ## 
![alt-text](https://github.com/austinbailey1114/LiftAppSite/blob/master/screenshots/shot1.png)
![alt-text](https://github.com/austinbailey1114/LiftAppSite/blob/master/screenshots/shot2.png)

