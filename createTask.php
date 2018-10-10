<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
                $("#category").change(function(){
                    $("#category_hidden").val($("#category").find(":selected").text());
                });
            });
            function validateForm() {
                $submitForm = true;
                $('.mandatory').each(function() {
                    if(!$(this).val()){
                        alert("Please fill out all the mandatory fields.");
                        $submitForm = false;
                        return false;
                    }
                });
                return $submitForm;
            }
        </script>
    </head>
    <body>
    	<h1> Welcome to Task Turtle </h1>

        <h3>Create A New Task</h3>

        <a href="loggedInHomePage.html">
            <button> Back </button>
        </a>

		<form id="taskForm" action="handleTaskCreation.php" method="post" onsubmit="return validateForm()">
            <table>
                <tr>
                    <td>Title</td>
                    <td>: <input class="mandatory" type="text" name="title" size="40"/></td>
                </tr>
                <tr>
                    <td>Description (Optional)</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea form="taskForm" name="description" rows="4" cols="50" maxlength="1024"></textarea></td>
                </tr>
                <tr>
                    <td>Task Date</td>
                    <td>: <input id="datepicker" class="mandatory" type="date" name="task_date" size="40" placeholder="YYYY-MM-DD"/></td>
                </tr>
                <tr>
                    <td>Start Time</td>
                    <td>: <input class="mandatory" type="time" name="start_time" size="40" placeholder="HH:MM"/></td>
                </tr>
                <tr>
                    <td>End Time</td>
                    <td>: <input class="mandatory" type="time" name="end_time" size="40" placeholder="HH:MM"/></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>: <input class="mandatory" type="text" name="location" size="40"/></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>:
                        <select id="category" class="mandatory" style="width:170px">
                            <option value="">Choose a category</option>
                            <option value="1">Mounting & Installation</option>
                            <option value="2">Moving & Packing</option>
                            <option value="3">Furniture Assembly</option>
                            <option value="4">Home Improvement</option>
                            <option value="5">General Handyman</option>
                            <option value="6">Heavy Lifting</option>
                            <option value="7">Others</option>
                        </select>
                        <input id="category_hidden" type="hidden" name="category" />
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right"><input type="submit" name="create_task" value="Confirm"/></td>
                </tr>
            </table>
        </form>
	</body>
</html>
