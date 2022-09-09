
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Payments</h2>
					
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col-md-6 col-lg-12 col-xl-6">
							<section class="panel">
								<div class="panel-body">
									<a class="modal-with-form m_add" href="#add_modal"><i class="fa fa-plus" aria-hidden="true"></i>&nbspAdd New Payment</a>
									<br/>
									<br/>
									<table class="table table-bordered table-striped mb-none" id="datatable-default">
										<thead>
											<tr>
												<th>No</th>
												<th>Email</th>
												<th>Site</th>
												<th>Created</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php for ($i=0; $i < count($data); $i++) { ?>
											<tr class="gradeX">
												<td><?php echo $i+1; ?></td>
												<td><?php echo $data[$i]['email'];?></td>
												<td><?php echo $data[$i]['site'];?></td>
												<td><?php echo $data[$i]['date'];?></td>
												<td class="center">
	                                                <input type="hidden" class="m_hide" value="<?php echo $i; ?>">
													<a class="modal-with-form m_edit" href="#edit_modal" style="color: blue;">EDIT</a> &nbsp|&nbsp
													<a class="modal-basic" href="#modalBasic_<?php echo $i;?>" style="color: red;">DELETE</a>

													<div id="modalBasic_<?php echo $i;?>" class="modal-block mfp-hide">
														<section class="panel">
															<header class="panel-heading">
																<h2 class="panel-title">Warning</h2>
															</header>
															<div class="panel-body">
																		<p>Are you sure to delete this item?</p>
															</div>
															<footer class="panel-footer">
																<div class="row">
																	<div class="col-md-12 text-right">
																		<a class="btn btn-primary" href="<?php echo base_url().'index.php/admin/delete_item/tbl_payment/'.$data[$i]['id']; ?>" >Confirm</a>
																		<a class="btn btn-default modal-dismiss">Cancel</a>
																	</div>
																</div>
															</footer>
														</section>
													</div>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</section>
						</div>
					</div>
				</section>
			</div>
		</section>

									<!-- Modal Form -->
									<div id="add_modal" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Add New Payment</h2>
											</header>
											<div class="panel-body">
												<form id="demo-form" action="#" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
													<div class="form-group">
														<label class="col-sm-3 control-label">Email</label>
														<div class="col-sm-9">
															<input id="add_email" type="email" name="add_email" class="form-control" placeholder="Type email..." required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Site Name</label>
														<div class="col-sm-9">
															<input id="add_site" type="text" name="add_site" class="form-control" placeholder="Type site name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Created on</label>
														<div class="col-sm-5">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</span>
																<input id="add_date" type="text" name="add_date" data-plugin-datepicker class="form-control">
															</div>												
														</div>
													</div>
												</form>
												<p id="add_warning" style="color: red; text-align: center;" hidden="hidden">Warning </p>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button id="add_button" class="btn btn-primary">Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
									<!-- Modal Form -->
									<div id="edit_modal" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Edit Payment</h2>
											</header>
											<div class="panel-body">
												<form id="demo-form" action="#" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
									                <input id="edit_id" name="edit_id" type="hidden">
													<div class="form-group">
														<label class="col-sm-3 control-label">Email</label>
														<div class="col-sm-9">
															<input id="edit_email" type="email" name="edit_email" class="form-control" placeholder="Type email..." required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Site Name</label>
														<div class="col-sm-9">
															<input id="edit_site" type="text" name="edit_site" class="form-control" placeholder="Type site name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Created on</label>
														<div class="col-sm-5">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-calendar"></i>
																</span>
																<input id="edit_date" type="text" name="edit_date" data-plugin-datepicker class="form-control">
															</div>												
														</div>
													</div>
												</form>
												<p id="edit_warning" style="color: red; text-align: center;" hidden="hidden">Warning </p>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button id="edit_button" class="btn btn-primary">Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
		<!-- Specific Page Vendor -->
		<script src="<?php echo base_url(); ?>/assets/backend/vendor/select2/select2.js"></script>
		<script src="<?php echo base_url(); ?>/assets/backend/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>/assets/backend/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/backend/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/tables/examples.datatables.default.js"></script>
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/tables/examples.datatables.tabletools.js"></script>
		<script src="<?php echo base_url(); ?>/assets/backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

		<!-- Examples -->
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/ui-elements/examples.modals.js"></script>

		<script type="text/javascript">

(function( $ ) {
	$('#add_date').datepicker({
		autoclose:true,
		format: 'yyyy-mm-dd',
		language: 'en',
		minViewMode:0,
	});

	$('#edit_date').datepicker({
		autoclose:true,
		format: 'yyyy-mm-dd',
		language: 'en',
		minViewMode:0,
	});
        var data = [];
        <?php for ($i = 0; $i < count($data); $i++) {?>
            data[<?php echo $i; ?>] = [];
            data[<?php echo $i; ?>]['id'] = "<?php echo $data[$i]['id']; ?>";
            data[<?php echo $i; ?>]['email'] = "<?php echo $data[$i]['email']; ?>";
            data[<?php echo $i; ?>]['site'] = "<?php echo $data[$i]['site']; ?>";
            data[<?php echo $i; ?>]['date'] = "<?php echo $data[$i]['date']; ?>";
        <?php } ?>
        $("a.m_edit").click(function() {
            var i = $(this).parent().find(".m_hide").val();
            $("#edit_id").val(data[i]['id']);
            $("#edit_email").val(data[i]['email']);
            $("#edit_site").val(data[i]['site']);
            $("#edit_date").val(data[i]['date']);
            $("#edit_warning").hide();
        });
        $("a.m_add").click(function() {
            $("#add_email").val("");
            $("#add_site").val('');
            $("#add_date").val('');
            $("#add_warning").hide();
        });
        $("#add_button").click(function() {
            var email = $("#add_email").val().trim();
            if (email == '') {
                $("#add_warning").show();
                $("#add_warning").text("Please input 'Email' field.");
                $("#add_email").val('');
                return;
            }
            var site = $("#add_site").val().trim();
            if (site == '') {
                $("#add_warning").show();
                $("#add_warning").text("Please input 'Site name' field.");
                $("#add_site").val('');
                return;
            }
            var date = $("#add_date").val().trim();
            if (date == '') {
                $("#add_warning").show();
                $("#add_warning").text("Please input 'Created on' field.");
                $("#add_date").val('');
                return;
            }

            $("#add_warning").hide();
            var data = {'email':email, 'site':site, 'date':date};
            $.ajax({url: "<?php echo base_url(); ?>index.php/admin/add_payment", data:data, type:'POST', success: function(result){
                if (result == 200) {
                    // window.history.go(0);
                    location.reload();                    
                } else if (result == 400) {
	                $("#add_warning").show();
	                $("#add_warning").text("Email already exists. Please type another email.");
                } else {
                    alert('Add Error');
                }
            }});
        });

        $("#edit_button").click(function() {
            var id = $("#edit_id").val().trim();
            var email = $("#edit_email").val().trim();
            if (email == '') {
                $("#edit_warning").show();
                $("#edit_warning").text("Please input 'Email' field.");
                $("#edit_email").val('');
                return;
            }
            var site = $("#edit_site").val().trim();
            if (site == '') {
                $("#edit_warning").show();
                $("#edit_warning").text("Please input 'Site name' field.");
                $("#edit_site").val('');
                return;
            }
            var date = $("#edit_date").val().trim();
            if (date == '') {
                $("#edit_warning").show();
                $("#edit_warning").text("Please input 'Created on' field.");
                $("#edit_date").val('');
                return;
            }

            $("#edit_warning").hide();
            var data = {'id':id, 'email':email, 'site':site, 'date':date};
            $.ajax({url: "<?php echo base_url(); ?>index.php/admin/edit_payment", data:data, type:'POST', success: function(result){
                if (result == 200) {
                    // window.history.go(0);
                    location.reload();                    
                } else if (result == 400) {
	                $("#edit_warning").show();
	                $("#edit_warning").text("Email already exists. Please type another email.");
                } else {
                    alert('Add Error');
                }
            }});
        });

}).apply( this, [ jQuery ]);

		</script>
	</body>

</html>