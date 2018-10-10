<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>
    <body>
    	<h1> Welcome to Task Turtle </h1>

        <h3>Create A New Task</h3>
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
                    <td>: <input type="text" name="task_date" size="52"/></td>
                </tr>
                <tr>
                    <td>Start Time</td>
                    <td>: <input type="text" name="start_time" size="52"/></td>
                </tr>
                <tr>
                    <td>End Time</td>
                    <td>: <input type="text" name="end_time" size="52"/></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>: <input type="text" name="location" size="52"/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>: <input type="text" name="category" size="52"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right"><input type="submit" name="create_task" value="Confirm"/></td>
                </tr>
            </table>
        </form>
	</body>
</html>
