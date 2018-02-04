<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h1 class="text-center">Login Page</h1>
            <form id="form-login" action="/connexion/login" method="post">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="text" type="text" class="form-control" name="login" placeholder="Login">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>