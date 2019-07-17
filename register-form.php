<?php include("admin/conf/config.php"); ?>
<?php include("layouts/header.php"); ?>
<main class="container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                     <div class="card-body">
                        <form method="POST" action="register.php" id="registerForm">
                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                 <div class="col-md-6">
                                    <input id="name" type="text" name="name" value="" class="form-control ">
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" name="email"  class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" name="password"  class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="pwConfirm" type="password" name="pwConfirm"  class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="submit-data" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                        <div id="response"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include("layouts/footer.php"); ?>
<script>
    $(document).ready(function () {
        $('#registerForm').validate({
            rules:{
                name:{
                    required: true,
                    minlength: 4
                },
                email:{
                    required: true,
                    email: true
                },
                password:{
                    required: true,
                    minlength: 4,
                },
                pwConfirm: {
                    required: true,
                    minlength: 4,
                    equalTo: "#password"
                }
            },


        submitHandler: function(data) {
            $.ajax({
                url: "register.php",
                type: "POST",
                data: {name:$("#name").val(),email: $("#email").val()},
                success: function(data,status) {
                    console.log(data);
                }
            });
        }
        });

        // $("button#submit-data").click(function(){
        //     $.post("register.php",
        //     {name:$("#name").val()},
        //     function(data,status){
        //         alert(data);
        //     });


        // });


    });
</script>