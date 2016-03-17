<body style="background-color:#bfbfbf">
<form action="register.php" method="post">
    <h1>Please, fill in the requirements</h1>
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" focus class="btn btn-danger" name="name" placeholder="Name" type="text"/>
        </div>
        <div class="form-group">
            <input autocomplete="off" focus class="btn btn-danger" name="last-name" placeholder="Last name" type="text"/>
        </div>
        <div class="form-group">
            <input autocomplete="off" focus class="btn btn-danger" name="username" placeholder="Username" type="text"/>
        </div>
        <div class="form-group">
            <input class="btn btn-danger" name="password" placeholder="Password" type="password"/>
        </div>
        <div class="form-group">
            <input class ="btn btn-danger" name ="confirm" placeholder="Confirmation" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Register
            </button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">log in</a>
</div>
