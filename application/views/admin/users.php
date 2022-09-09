
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Users</h2>
					
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col-md-6 col-lg-12 col-xl-6">
							<section class="panel">
								<div class="panel-body">
									<table class="table table-bordered table-striped mb-none" id="datatable-default">
										<thead>
											<tr>
												<th>No</th>
												<th>Name</th>
												<th>UserID</th>
												<th>Earning(Total)</th>
												<th>Earning(Month)</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php for ($i=0; $i < count($data); $i++) { ?>
											<tr class="gradeX">
												<td><?php echo $i+1; ?></td>
												<td><?php echo $data[$i]['name']; ?></td>
												<td><?php echo $data[$i]['userid']; ?></td>
												<td><?php echo $data[$i]['earning_total']; ?></td>
												<td><?php echo $data[$i]['earning_month']; ?></td>
												<td class="center">
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
																		<a class="btn btn-primary" href="<?php echo base_url().'index.php/admin/delete_item/tbl_user/'.$data[$i]['id']; ?>" >Confirm</a>
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
		<!-- Examples -->
		<script src="<?php echo base_url(); ?>/assets/backend/javascripts/ui-elements/examples.modals.js"></script>

	</body>

</html>