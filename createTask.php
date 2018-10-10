<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>
    <body>
    	<h1> Welcome to Task Turtle </h1>

        <h3>Create A New Task</h3>
        <a href="loggedInHomePage.html">
            <button> Back </button>
        </a>
		<form id="taskForm" action="handleTaskCreation.php" method="post">
            <table>
                <tr>
                    <td>Title</td>
                    <td>: <input type="text" name="title" size="52"/></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea form="taskForm" name="description" rows="4" cols="50" maxlength="1024"></textarea></td>
                </tr>
                <tr>
                    <td>Task Date</td>
                    <td>: <input type="date" name="task_date" size="52"/></td>
                </tr>
                <tr>
                    <td>Start Time</td>
                    <td>: <input type="time" name="start_time" size="52"/></td>
                </tr>
                <tr>
                    <td>End Time</td>
                    <td>: <input type="time" name="end_time" size="52"/></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>: <input type="text" name="location" size="52"/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>: <select name="category">
                            <option>Select category</option>
                            <option value="Mounting & Installation">Mounting & Installation</option>
                            <option value="Moving & Packing">Moving & Packing</option>
                            <option value="Furniture Assembly">Furniture Assembly</option>
                            <option value="Home Improvement">Home Improvement</option>
                            <option value="General Handyman">General Handyman</option>
                            <option value="Heavy Lifting">Heavy Lifting</option>
                            <option value="Others">Others</option>
                          </select>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right"><input type="submit" name="create_task" value="Confirm"/></td>
                </tr>
            </table>
        </form>
	</body>
</html>
