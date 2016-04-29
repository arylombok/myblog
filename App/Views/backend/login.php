<?php include 'back-layouts/header.php'; ?>
<script>
    $(document).ready(function (){
        $("#fmSubmit").on('submit',function (e){
            var username =$("#uName").val();
            var password =$("#pass").val();
            $.ajax({type: "POST",
                url : "/cekLogin",
                data: "username="+username+"&password="+password,
                dataType:"html",
                beforeSend:function(){
                    $("#loading").html("authenticating...");
                },
                success:function(html){ 
                    $("#loading").html("");
                    if (html == 'TRUE'){
                        window.location.href="/admin";
                    }else{
                        $(".err_msg").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Wrong Password or Username !</div>").delay(2000).fadeTo("slow",0,function(){
                                $(this).html('').css('opacity','');
                            });
                        }
                    },
                error:function(xhr, Status, err) {
                        $("Terjadi error : "+Status);
                      }
                });
            e.preventDefault();
        })
    });
</script>

  <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default box-shadow--2dp">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-user"> </span> Login Admin</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="fmSubmit">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" id="uName" placeholder="E-mail" name="email" type="email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pass" placeholder="Password" name="password" type="password" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" >Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div id="loading" class="text-center"></div>
                <div class="err_msg"></div>
            </div>
        </div>
    </div>
<?php include 'back-layouts/footer.php'; ?>