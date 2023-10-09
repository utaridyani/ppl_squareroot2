<!-- resources/views/api_result.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>API Result</title>
</head>
<body>
    <h1>API Response:</h1>
    <pre>{{ json_encode($response, JSON_PRETTY_PRINT) }}</pre>
</body>
</html>
