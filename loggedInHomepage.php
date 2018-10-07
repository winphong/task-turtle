<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>

    <body>
    	<h1> Welcome to Task Turtle </h1>
        
        <div class="searchBar">
            <input type="text" name="search" placeholder="Washing car"/> 
        </div>

        <div class="taskList">
            <?php 
                include ('taskList.php'); 
            ?>
        </div>

    </body> 
</html>
