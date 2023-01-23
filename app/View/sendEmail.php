<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>emailServiceTest</title>
</head>
<body>
    <form action='<?php echo urlroot;?>/Elections/sendEmail' method="POST">
        Email: <input type="email" name="email" id="email" placeholder="email"><br>
        Subject: <input type="text" name="subject" ><br>
        Body: <input type="text" name="body"><br>
        <input type="submit" value="send">
    </form>
    <form action="<?php echo urlroot;?>/Elections/findElection" method="POST">
        <br>
        ID: <input type="text" name="electionId">
        <input type="submit" value="FIND"><br>
    </form>

</body>
</html>