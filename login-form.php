<?php include("layouts/header.php"); ?>
<main class="container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                     <div class="card-body">

                        <form method="POST" action="login.php">
                             <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                 <div class="col-md-6">
                                    <input id="email" type="email" name="email" value="" required="required" autocomplete="email" autofocus="autofocus" class="form-control ">
                                 </div>
                             </div>

                             <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                 <div class="col-md-6">
                                    <input id="password" type="password" name="password" required="required" autocomplete="current-password" class="form-control ">
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("layouts/footer.php"); ?>