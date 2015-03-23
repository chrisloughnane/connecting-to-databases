<!-- Some simple examples on form POST and GET methods -->
<!DOCTYPE html>
<html>
<head>


</head>
<body>

	<form action="action_post.php" method="post">
		<fieldset>
			<legend>Example with POST method:</legend>
			First name:<br>
			<input type="text" name="firstname" value="Mickey">
			<br>
			Last name:<br>
			<input type="text" name="lastname" value="Mouse">
			<br><br>
			<input type="submit">
		</fieldset>
	</form>

	<br>

	<form action="action_get.php" method="get">
		<fieldset>
			<legend>Example with GET method:</legend>
			First name:<br>
			<input type="text" name="firstname" value="Mickey">
			<br>
			Last name:<br>
			<input type="text" name="lastname" value="Mouse">
			<br><br>
			<input type="submit">
		</fieldset>
	</form>

</body>
</html>