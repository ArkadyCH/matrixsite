<!DOCTYPE html>
<html>
<head>
    <title>Download</title>
    <?php include ROOT.'/views/matrix/link.php';?>
</head>
<body>
<?php include ROOT.'/views/matrix/header.php';?>

<div class="content">
    <h1>Авторизация</h1>
    <form>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <a href="/sign">Ещё не зарегистрирован ?</a>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
