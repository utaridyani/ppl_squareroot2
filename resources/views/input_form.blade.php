<!-- resources/views/input_form.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Simple Input Form</title>
</head>
<body>
    <form method="POST" action="/process">
        <label for="inputText">Enter something:</label>
        <input type="text" id="inputText" name="inputText" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
