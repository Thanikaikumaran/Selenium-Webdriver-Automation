<!DOCTYPE html>
<html lang="en">

<head>
    <title>IMS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <h1>501</h1>
    <h2>Oops! Database Error!</h2>
    <p>Sorry There is database issue.Please contact the db connectivity.</p>
    <a href="#">Back to homepage</a>
    <div style="display: none;"><?php //echo $exception->getMessage(); 
                                ?></div>
</body>

</html>