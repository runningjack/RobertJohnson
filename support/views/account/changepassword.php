<div class="wrapper">

    <div class="container">
        <div class="row no-print">
            <div class="col-xs-12">

                <a href="<?php echo $uri->link("account/index") ?>" class="btn btn-success pull-right"><i class="fa fa-backward"></i> Back To Profile</a>

            </div>
        </div>



        <div  id="changepass">

            <form action="<?php echo $uri->link("account/doUpdate") ?>" method="post" name="frmEmp" id="changePassword">
                <fieldset>
                    <div id="transalert"></div>
                    <legend>Change Password</legend>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="right-label">
                                <label>Old Password <span class="red">*</span></label>
                            </div>

                            <input class="form-control" required="required" rel="catchable" name="opword" id="opword" type="password" />
                            <div id="tm"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="right-label">
                                <label>New password <span class="red">*</span></label>
                            </div>

                            <input class="form-control" required="required" rel="catchable" name="pword" id="pword" type="password" value="" />
                            <div id="tm"></div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="right-label">
                                <label>Re-enter New Password<span class="red">*</span></label>
                            </div>

                            <input  class="form-control" name="pword2" id="pword2" type="password" rel="catchable" value="" />
                            <div id="costp"></div>
                        </div>
                    </div>

                    <div class="row">

                        <input name="task" id="task" value="" type="hidden" />
                        <input name="pgid" id="pgid" value="" type="hidden" />

                        <a href="#" class="btn btn-primary" name="pwsave" rel="catchable"  id="changepw" > Save</a>
                    </div>
                </fieldset>
            </form>


        </div>
        <script>
            $(document).ready(function(){
                $('#changepw').click(function(){
                    var srt = $("#changePassword").serialize();
                    // alert is working perfect
                    //$("#transalert").html(srt);
                    // alert(srt);
                    $.ajax({
                        type: 'POST',
                        url: '?url=account/doUpdate',
                        data: srt,
                        success: function(d) {
                            $("#transalert").html(d);
                        }
                    });
                    return false;
                });
            });

        </script>


    </div><!--container-->
</div>