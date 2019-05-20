<?php
/*
 * Test for OO(unit testing):(during discussion)

Admin:
1.Showing events on calender after admins had upload them.
Situation: Events added can not be shown on the event calender.
Problem addressed: There is no code especially for the function that showing new added event.
Result: This part will be added soon.

2.The function adding events is not flexible enough.
Situation: Admins can not add an event holding weekly in one submission. (The function for adding events can only be selected for a period of time, which means if the time is separated, the admin have to redo this function for several time. It dose not meet our requirement, user friendly.)
Problem addressed: A check table, which asks admins to select the weekdays they want through the time period they typed in, should be added on the interface while adding events.
Result: The code of check box and SQL sentences will be added.

3.The “view events” and “view bookings” functions can not be reach.
Situation:  The events and bookings can not be viewed by the admin after clicking on it.
Problem addressed: The SQL sentences about these two functions have some issues.
Result: The SQL sentences have been replaced by the working ones.

4.The “block booking” function is too much flexible while picking up the date, which created trouble for calculated the capacity of each facility.
Situation: The capacity of each facility is calculated using data stored in the database. For convenient in calculation, we divide the whole capacity into capacities for every hours in database. However, the block function stored the data in a different way which can not be selected by hour.
Problem addressed: A new method for calculating the capacity should be established or the admins should be limited to only choose the sharp time.
Result: A compromise method should be created.


User:

1.Users can not indicated they are members of the Durham University.
Situation: The prices about a certain facility are different between the normal users and the university members. We should send out an email, that includes the total price of one booking, to the user after he books successfully. However, we can not know if he is a member, so the total price might be wrong for him.
Problem addressed: The user should be able to indicate whether he is a member during the booking process.
Result: A check box has been added for users during the booking process.

2.Message should be sent out by emails to the users after their accounts have been logged in for security reason.
Situation: If a hacker get the log in details of an user, the hacker might change the information of the user. However, the user might not be able to notice that.
Problem addressed: We should email users when they logged in.
Result: A function to send emails to users after they logged in has been added.


Interface:

1.The highlighting color of the users’ calender make the words on it hard to read.
Situation: The words in white color is hard to read with a background color in yellow.
Problem addressed: The colors of the background and the words is not suitable.
Result: The colors have been changed.
 */
    ?>
