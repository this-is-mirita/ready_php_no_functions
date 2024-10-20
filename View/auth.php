<?php //print_r(__DIR__); ?>
<!--шапка-->
<?php require_once(__DIR__ . "/header.php")?>
<!--шапка-->
<div class="container d-flex  bg-light justify-content-center align-items-center mb-5" style="height: 50vh" >
    <div class="card shadow-lg" style="width: 100%; max-width: 700px;">
        <div class="card-body">
            <h2 class="card-title text-center">auth</h2>
            <p class="card-text text-center"><b>login & password</b></p>

            <form method="post" action="../controllers/auth.php">
                <div class="form-row row">
                    <div class="form-group col-md-6">
                        <label for="login">Login</label>
                        <input type="text" class="form-control mt-3" id="login" name="login" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control mt-3" id="password" name="password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark btn-block mt-3 px-5">auth</button>
            </form>
        </div>
    </div>
</div>
<!--футер-->
<?php require_once(__DIR__ . "/footer.php")?>
<!--футер-->