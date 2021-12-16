File Structure:

For this API, we used the MVC architecture for our structure. Our API contains authentication, formula, history and client models/controllers. We have a database that is responsible for storing records every time someone uses a formula to calculate, retrieving the formulas, etc. We made an index.php script that manages and handles authorization and the POST/GET logic.


How to install and use:

1.  Create an account and install Postman: https://www.postman.com/
2.  Install XAMPP (with PHP8): https://www.apachefriends.org/download.html
3.  Start the MySQL module.
4.  Unzip the JustPi folder.
5.  Locate the database file (.sql) in the "JustPi\justpi\database\" directory.
6.  Add the database file into the PhpMyAdmin database creator (can be easily accessed on the XAMPP control panel next to the MySQL module)
7.  Open up Postman and use the API's endpoints to see if they work:
     <h3>Examples of Entry Points:</h3>
      GET:
        - localhost/JustPi/justpi/api/auth/authorize?api=KEYABC123&clientName=John
        - localhost/JustPi/justpi/api/formula/all
        - localhost/JustPi/justpi/api/formula/1
        - localhost/JustPi/justpi/api/history/all
        - localhost/JustPi/justpi/api/history/1
      POST:
        - localhost/JustPi/justpi/api/client
        - localhost/JustPi/justpi/api/formula/getResult?formulaName=Circle Circumference&variables=6