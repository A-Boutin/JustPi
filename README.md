# JustPi
<b>Math Api (for Web Services)</b></br>

This API allows developers to use certain functions that calculate various math expressions with the use of our built-in equations. </br></br>

<h2>File Structure:</h2>

For this API, we used the MVC architecture for our structure. Our API contains authentication, formula, history and client models/controllers. 
We have a database that is responsible for storing records every time someone uses a formula to calculate, retrieving the formulas, etc. 
We made an index.php script that manages and handles authorization and the POST/GET logic.

![fgh drawio_2_65](https://user-images.githubusercontent.com/54519892/146440711-45688aba-0101-4471-acad-649f86066f74.png)


<h2>How to install and use:</h2>
1.  Create an account and install Postman: https://www.postman.com/ </br>
2.  Install XAMPP (with PHP8): https://www.apachefriends.org/download.html </br>
3.  Start the MySQL module. </br>
4.  Unzip the JustPi folder. </br>
5.  Locate the database file (.sql) in the "JustPi\justpi\database\" directory. </br>
6.  Add the database file into the PhpMyAdmin database creator (can be easily accessed on the XAMPP control panel next to the MySQL module) </br>
7.  Open up Postman and use the API's endpoints to see if they work:
     &emsp;<h3>Examples of Entry Points:</h3>
      &emsp;GET: </br>
        &emsp;- localhost/JustPi/justpi/api/auth/authorize?api=KEYABC123&clientName=John </br>
        &emsp;- localhost/JustPi/justpi/api/formula/all </br>
        &emsp;- localhost/JustPi/justpi/api/formula/1 </br>
        &emsp;- localhost/JustPi/justpi/api/history/all </br>
        &emsp;- localhost/JustPi/justpi/api/history/1 </br></br>
      &emsp;POST: </br>
        &emsp;- localhost/JustPi/justpi/api/client </br>
        &emsp;- localhost/JustPi/justpi/api/formula/getResult?formulaName=Circle Circumference&variables=6 </br>
