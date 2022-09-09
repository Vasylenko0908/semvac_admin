
				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Articles</h2>
					
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col-md-12">
							<section class="panel">
								<div class="panel-body" >
									
									<a class="modal-with-form m_add" href="#add_modal"><i class="fa fa-plus" aria-hidden="true"></i>&nbspAdd New Article</a>
									<br/>
									<br/>
									<table class="table table-bordered mb-none" id="datatable-default">
										<thead>
											<tr>
												<th>No</th>
												<th>Image</th>
												<th>Contents</th>
												<th>Favors</th>
												<th>Opens</th>
												<th>Shares</th>
												
											</tr>
										</thead>
										<tbody>
											<?php for ($i=0; $i < count($data); $i++) { ?>
											<tr class="gradeX">
												<td><?php echo $i+1; ?></td>
												<td>
													<div class="owl-carousel owl-theme" data-plugin-carousel data-plugin-options='{ "dots": true, "autoplay": true, "autoplayTimeout": 3000, "loop": true, "margin": 10, "nav": false, "items": 1 }' style="width: 200px; height: 160px;background: #181818;">
														<?php 
														for ($j=0; $j < count($data[$i]['img_arr']); $j++) {?> 
															<div class="item"><img class="img-thumbnail" src="<?php echo base_url();?>uploads/<?php echo $data[$i]['img_arr'][$j];?>" alt=""></div>	
														<?php }
														?>
													 </div>
												</td>
												<td>
													<h4><?php echo $data[$i]['title'];?></h4>
													<p>
														<?php 
														$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
														$string = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', nl2br($data[$i]['description']));
														
														echo $string;
														?>
															
													</p>
													<br><br>
													<input type="hidden" class="m_hide" value="<?php echo $i; ?>">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<a class="modal-basic m_add" href="#modalDelete_<?php echo $i;?>" style="color: red;">DELETE</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<a class="modal-basic m_edit" href="#modalEdit" style="color: green;">EDIT</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<a class="modal-basic m_notification" href="#modalNotification" style="color: yellow;">NOTIFICATION</a> 

													<b style="width: fit-content; float: right;"><?php echo $data[$i]['date'];?></b>
													<div id="modalDelete_<?php echo $i;?>" class="modal-block mfp-hide">
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
																		<a class="btn btn-primary" href="<?php echo base_url().'index.php/admin/delete_item/tbl_article/'.$data[$i]['id']; ?>" >Confirm</a>
																		<a class="btn btn-default modal-dismiss">Cancel</a>
																	</div>
																</div>
															</footer>
														</section>
													</div>

													
												</td>
												<td><?php echo $data[$i]['favors'];?></td>
												<td><?php echo $data[$i]['opens'];?></td>
												<td><?php echo $data[$i]['shares'];?></td>
												
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
												<h2 class="panel-title">Add New Article</h2>
											</header>
											<div class="panel-body">
												<form action="#" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
													<div class="form-group">
														<label class="col-sm-3 control-label">Image(s)</label>
														<div class="row">
															<div class="col-sm-5">
																<div id="new_gallery" class="owl-carousel owl-theme gallery" data-plugin-carousel data-plugin-options='{ "dots": true, "autoplay": true, "autoplayTimeout": 3000, "loop": true, "margin": 10, "nav": false, "items": 1, "autoHeight": true }' style="width: 200px; height: 160px; background: #181818;">
																	
																 </div>
																<br><br>
																<input type="file" multiple id="fileInput" name="fileInput" />
	                                        					<input type="hidden" id="photo" name="photo" value="" required/>
															</div>
															<div class="col-sm-2"><input id="btn_clear" class="btn btn-primary" type="button" value="Clear"/></div>
														</div>

													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Title</label>
														<div class="col-sm-9">
															<input id="add_title" type="text" name="title" class="form-control" placeholder="Type title..." required/>
														</div>
													</div>
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Description</label>
														<div class="col-sm-9">
															<textarea id="add_description" name="description" class="form-control" rows="3" data-plugin-maxlength="1024" placeholder="Type description..." required></textarea>
														</div>
													</div>
													
												</form>
												<p id="add_warning" style="color: yellow; text-align: center;" hidden="hidden">Warning </p>
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

									<div id="modalEdit" class="modal-block mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Edit Description</h2>
											</header>
											<div class="panel-body">
												<form action="#" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
													<input id="article_edit_id" name="edit_id" type="hidden">
													<div class="form-group mt-lg">
														<label class="col-sm-2 control-label">Description</label>
														<div class="col-sm-9">
															<textarea id="edit_description" name="description" class="form-control" rows="3" data-plugin-maxlength="1024" placeholder="Type description..." required></textarea>
														</div>
													</div>
													
												</form>
												<p id="edit_warning" style="color: yellow; text-align: center;" hidden="hidden">Warning </p>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button id="edit_button" class="btn btn-primary">Update</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div>

									<div id="modalNotification" class="modal-block mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Send Notification</h2>
											</header>
											<div class="panel-body">
												<form action="#" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
													<input id="article_notification_id" name="edit_id" type="hidden">
													<div class="form-group mt-lg">
														<label class="col-sm-2 control-label">Text</label>
														<div class="col-sm-9">
															<textarea id="notification_text" name="description" class="form-control" rows="3" data-plugin-maxlength="1024" placeholder="Type notification text..." required></textarea>
														</div>
													</div>
													
												</form>
												<p id="notification_warning" style="color: yellow; text-align: center;" hidden="hidden">Warning </p>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button id="notification_button" class="btn btn-primary">Send</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
		<!-- Specific Page Vendor -->
		<script src="<?php echo base_url(); ?>assets/vendor/select2/select2.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url(); ?>assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="<?php echo base_url(); ?>assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="<?php echo base_url(); ?>assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="<?php echo base_url(); ?>assets/javascripts/tables/examples.datatables.tabletools.js"></script>
		<script src="<?php echo base_url(); ?>assets/javascripts/ui-elements/examples.modals.js"></script>
		<style>
			
			.owl-carousel .owl-item img {
			    display: block;
			    height: 120px;
			    width: auto;
			    min-width: 100%;
			    object-fit: contain;
			}
			.panel-footer {
				background: #282828;
			}
			.panel-heading {
				background: #313131;
			}
			.panel-body {
				background: #181818;
				color: #cdcdcd;
			}
			.panel-title {
				color: #ffffff;
			}
		</style>
	</body>
	<script type="text/javascript">
		$(function() {
			var data = [];
	        <?php for ($i = 0; $i < count($data); $i++) {?>
	            data[<?php echo $i; ?>] = [];
	            data[<?php echo $i; ?>]['id'] = "<?php echo $data[$i]['id']; ?>";
	            data[<?php echo $i; ?>]['title'] = "<?php echo $data[$i]['title']; ?>";
	            data[<?php echo $i; ?>]['description'] = <?php echo json_encode($data[$i]['description']); ?>;
	        <?php } ?>
	        var fileList = [];
		    // Multiple images preview in browser
		    var imagesPreview = function(input, placeToInsertImagePreview) {

		        if (input.files) {
		        	// console.log(input.files)
		        	if (input.files.length){
		        		for(var i = 0; i < input.files.length; i ++)
		        			fileList.push(input.files[i])
		        	}
		        	else
						fileList.push(input.files);

		            var filesAmount = input.files.length;
		            for (i = 0; i < filesAmount; i++) {
		                var reader = new FileReader();
		                reader.onload = function(event) {
		                	var url = event.target.result;
		                    $('#new_gallery').trigger('add.owl.carousel', ['<div class="item"><img class="img-thumbnail" src="'+event.target.result+'" alt="" ></div>'])
        					.trigger('refresh.owl.carousel');		                    
		                }
		                reader.readAsDataURL(input.files[i]);
		            }
		        }
		    };

		    $('#fileInput').on('change', function() {
		        imagesPreview(this, 'div.gallery');
		    });
		    $('#btn_clear').on('click', function() {
		        for (var i=1; i<=fileList.length; i++) {
				   $("#new_gallery").trigger('remove.owl.carousel', [i]).trigger('refresh.owl.carousel');
				}
				fileList = [];
		    });

		    $("a.m_add").click(function() {
	            $("#add_title").val('');
	            $("#add_description").val('');
	            $("#add_warning").hide();
	            for (var i=1; i<=fileList.length; i++) {
				   $("#new_gallery").trigger('remove.owl.carousel', [i]).trigger('refresh.owl.carousel');
				}
				fileList = [];
	        });

		    $("a.m_notification").click(function() {
	            var i = $(this).parent().find(".m_hide").val();
	            $("#article_notification_id").val(data[i]['id']);
	            $("#notification_text").val('');
	            $("#notification_warning").hide();
	        });

	        $("a.m_edit").click(function() {
	            var i = $(this).parent().find(".m_hide").val();
	            // console.log(data[i]);
	            $("#article_edit_id").val(data[i]['id']);
	            $("#edit_description").val(data[i]['description']);
	            $("#edit_warning").hide();
	        });
            $("#notification_button").prop('disabled', false);

		    $("#notification_button").click(function() {
		    	var id = $("#article_notification_id").val().trim();
	            var text = $("#notification_text").val().trim();
	            if (text == '') {
	                $("#notification_warning").show();
	                $("#notification_warning").text("Please input 'Text' field.");
	                $("#notification_text").val('');
	                return;
	            }
	            $("#notification_button").prop('disabled', true);
	            $("#notification_warning").show();
                $("#notification_warning").text("Wait a sec..");
	            var data = {'id':id, 'text':text};
	            $.ajax({url: "<?php echo base_url(); ?>index.php/admin/send_text_notification", data:data, type:'POST', 
    				success: function(result){
	            	console.log(result);
	            	// alert(result);
		            $("#notification_button").prop('disabled', false);
	                if (result == 200) {
						// new PNotify({
						// 			title: 'Regular Notice',
						// 			text: 'Check me out! I\'m a notice.',
						// 			type: 'success'
						// 		});
	                    // window.history.go(0);
			            $("#notification_warning").hide();
		                $("#notification_warning").text("");
	                    location.reload();
	                } else {
		                $("#notification_warning").show();
		                $("#notification_warning").text("Send Error!");
	                }
	            }});
	        });

            $("#add_button").prop('disabled', false);
		    $("#add_button").click(function() {
		    	if (fileList.length == 0) {
	                $("#add_warning").show();
	                $("#add_warning").text("Please input 'Image' field.");
	                return;
		    	}
	            var title = $("#add_title").val().trim();
	            if (title == '') {
	                $("#add_warning").show();
	                $("#add_warning").text("Please input 'Title' field.");
	                $("#add_title").val('');
	                return;
	            }
	            var description = $("#add_description").val().trim();
	            if (description == '') {
	                $("#add_warning").show();
	                $("#add_warning").text("Please input 'Description' field.");
	                $("#add_description").val('');
	                return;
	            }

				$("#add_button").prop('disabled', true);
	            $("#add_warning").hide();
	            var fd = new FormData(); 
	            for (var i = 0; i < fileList.length; i++) {
			       fd.append("files[]", fileList[i]);
			    }
			    fd.append('title', title);
			    fd.append('description', description);
			    console.log("length", fileList.length);
	            // var data = {'images':fd, 'title':title, 'description':description};
	            $.ajax({url: "<?php echo base_url(); ?>index.php/admin/add_article", data:fd, type:'POST', 
    				contentType: false, processData: false, success: function(result){
	            	// console.log(result);
	            	$("#add_button").prop('disabled', false);
	                if (result == 200) {

	                    // window.history.go(0);
	                    location.reload();
	                } else {
		                $("#add_warning").show();
		                $("#add_warning").text("Submit Error!");
	                }
	            }});
	        });
	        $("#edit_button").prop('disabled', false);
	        $("#edit_button").click(function() {
	            var id = $("#article_edit_id").val().trim();
	            var description = $("#edit_description").val().trim();
	            if (description == '') {
	                $("#edit_warning").show();
	                $("#edit_warning").text("Please input 'Description' field.");
	                $("#edit_description").val('');
	                return;
	            }
	            $("#edit_button").prop('disabled', true);
	            $("#edit_warning").hide();
	            var data = {'id':id, 'description':description};
	            $.ajax({url: "<?php echo base_url(); ?>index.php/admin/edit_article", data:data, type:'POST', 
    				success: function(result){
	            	// console.log(result);
    		        $("#edit_button").prop('disabled', true);

	                if (result == 200) {

	                    // window.history.go(0);
	                    location.reload();
	                } else {
		                $("#edit_warning").show();
		                $("#edit_warning").text("Edit Error!");
	                }
	            }});
	        });
		});
	</script>
</html>