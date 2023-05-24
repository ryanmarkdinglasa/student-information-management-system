									<div class="modal fade" id="studentmodal" tabindex="">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button class="close" data-dismiss="modal" type=
														"button">×</button>
														<h4 class="modal-title" id="myModalLabel">Profile Image.</h4>
													</div>
													<form action="controller.php?action=photos" enctype="multipart/form-data" method=
													"post">
														<div class="modal-body">
															<div class="form-group">
																<div class="rows"> 
																	<div class="">
																		<div class="rows">
																			<div class="">
																				<input type="hidden" name="idno" id="idno" value="<?php echo ''.$_SESSION['staffId']?>">
																				  <input name="MAX_FILE_SIZE" type=
																				"hidden" value="1000000"> <input id=
																				"photo" name="photo" type=
																				"file">
																			</div>

																			<div class=""></div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button class="btn btn-default" data-dismiss="modal" type=
															"button">Close</button> <button class="btn btn-primary"
															name="savephoto" type="submit">Upload Photo</button>
														</div>
													</form>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->