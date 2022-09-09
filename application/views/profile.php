
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Update Profile</h2>
					
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col-md-6 col-lg-12 col-xl-6">
							<section class="panel">
								<div class="panel-body">
									<br><br><br>
									<form id="demo-form" action="#" method="post" class="form-horizontal mb-lg col-sm-9" novalidate="novalidate">
										<div class="form-group mt-lg">
											<label class="col-sm-4 control-label">User ID</label>
											<div class="col-sm-8">
												<input id="userid" type="text" name="userid" class="form-control" placeholder="Type user ID..." required value="<?php echo $data['userid']; ?>" />
											</div>
										</div>
										<div class="form-group mt-lg">
											<label class="col-sm-4 control-label">Current Password</label>
											<div class="col-sm-8">
												<input id="password" type="password" name="password_cur" class="form-control" placeholder="Type current password..." required/>
											</div>
										</div>
										<div class="form-group mt-lg">
											<div class="checkbox-custom checkbox-default checkbox-inline mt-sm ml-md mr-md" style="float: right;">
												<input type="checkbox" checked="" id="update_pass">
												<label for="update_pass">Update password</label>
											</div>
										</div>
										<div id="div_new_pass" class="form-group mt-lg">
											<label class="col-sm-4 control-label">New Password</label>
											<div class="col-sm-8">
												<input id="password_new" type="password" name="password_new" class="form-control" placeholder="Type new password..." required/>
											</div>
										</div>
										<div id="div_new_pass_conf" class="form-group mt-lg">
											<label class="col-sm-4 control-label">Confirm New Password</label>
											<div class="col-sm-8">
												<input id="password_new_conf" type="password" name="password_new_conf" class="form-control" placeholder="Confirm new password..." required/>
											</div>
										</div><br>
										<p id="edit_warning" style="color: red; text-align: center;" hidden="hidden">Warning </p>
									</form>
									

								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-md-12 text-right">
											<button id="btn_update" class="btn btn-primary modal-confirm">Update</button>
											<a href="javascript:history.back()" class="btn btn-default modal-dismiss">Cancel</a>
										</div>
									</div>
								</footer>							
							</section>
						</div>
					</div>
				</section>
			</div>
		</section>

		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url(); ?>assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>assets/javascripts/theme.init.js"></script>


		<script type="text/javascript">

(function( $ ) {
	$('#update_pass').attr('checked', false);
	$('#div_new_pass').hide();
	$('#div_new_pass_conf').hide();
	$('#update_pass').change(function() {

        if(this.checked) {
        	$('#div_new_pass').show();
			$('#div_new_pass_conf').show();
        } else {
        	$('#div_new_pass').hide();
			$('#div_new_pass_conf').hide();
        }
    });

    $("#btn_update").click(function() {
        var userid = $("#userid").val().trim();
        if (userid == '') {
            $("#edit_warning").show();
            $("#edit_warning").text("Please input 'User ID' field.");
            $("#userid").val('');
            return;
        }
        var password = $("#password").val().trim();
        if (password == '') {
            $("#edit_warning").show();
            $("#edit_warning").text("Please input 'Current Password' field.");
            $("#password").val('');
            return;
        }
        var pw_update = 0;
        var password_new = '', password_new_conf = '';
        if ($('#update_pass').is(":checked"))
		{
			pw_update = 1;
		  	password_new = $("#password_new").val().trim();
	        if (password_new == '') {
	            $("#edit_warning").show();
	            $("#edit_warning").text("Please input 'New Password' field.");
	            $("#password_new").val('');
	            return;
	        }
	        password_new_conf = $("#password_new_conf").val().trim();
	        if (password_new_conf == '') {
	            $("#edit_warning").show();
	            $("#edit_warning").text("Please input 'Confirm New Password' field.");
	            $("#password_new_conf").val('');
	            return;
	        }
	        if (password_new != password_new_conf) {
	        	$("#edit_warning").show();
	            $("#edit_warning").text("New password doesn't match.");
	            // $("#password_new_conf").val('');
	            return;
	        }
		}
		$("#edit_warning").hide();
        
        var data = {'userid':userid, 'password':password, 'password_new':password_new, 'pw_update':pw_update};
        console.log(data);
        $.ajax({url: "<?php echo base_url(); ?>index.php/admin/edit_profile", data:data, type:'POST', success: function(result){
        	console.log(result);
            if (result == 200) {
                // window.history.go(0);
                location.reload();                    
            } else if (result == 400) {
                $("#edit_warning").show();
                $("#edit_warning").text("Current password is incorrect");
            } else {
                alert('Update Error');
            }
        }});
    });

}).apply( this, [ jQuery ]);

		</script>
	</body>

</html>