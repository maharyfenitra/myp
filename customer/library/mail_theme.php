<?php 





$message_html = '
<div marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">

<table cellspacing="0" border="0" style="background: #E2E5F7;" cellpadding="0" width="80%">
	
	<tr>
		<td>
			<table cellspacing="0" bgcolor="#484845" width="100%" cellpadding="0">
				<tr>
					<td height="50" valign="top" style="background-color : #22336C;">
						<table height="50" cellspacing="0" align="center" width="600" cellpadding="0">
							<tr>
								<td valign="middle" class="header-text" align="center" style=" font-family: Arial; font-size: 10px;color: #FFFFFF ;  text-transform: uppercase; padding: 0 20px;">
									 <h2>
                                  							 <p style=" font-family: Arial; text-transform: uppercase; color: #FFFFFF;"> '.$entreprise_name.' </p>
                               		</h2>
					
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" width="100%" cellpadding="0">
				<tr>
					<td valign="top">
						<table cellspacing="0" align="center" width="600" cellpadding="0">
							<tr>
								<td valign="center" class="main-title" style="padding: 20px 15px 0 15px; font-family: Arial; font-weight: bold; text-transform: uppercase;">
                                <h1>
                                  <label align="center">'.$title.' </label>
                                </h1>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table cellspacing="0" align="center" width="600" cellpadding="0">
							<tr>
								<td class="date" valign="top" style="color: #999; text-transform: uppercase; text-align: center; font-size: 11px; font-family: Verdana;">
									<br /><currentdayname /> <currentday /> <currentmonth /> <currentyear /><br /><br />
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	
	
	<tr>
		
		<td valign="top">

			<table cellspacing="0" bgcolor="#7584CE" border="0" align="center" cellpadding="0" width="600">
				<tr>
					<td>
						<!-- content -->
						<table cellspacing="0" border="0" bgcolor="#7584CE" cellpadding="0" width="600">
							<tr>
								<td valign="top" width="350" height="100%" >
									<table cellspacing="0" style="background: #fff;" width="350" height="100%" cellpadding="0">
										
										<tr>
											<td valign="top" width="6">
												
											</td>
										</tr>
										
                                        <repeater>
										<tr>
											<td class="content-copy" valign="top" style="padding: 40px 0 0 20px; color: black; font-size: 13px;  line-height: 30px;" colspan="2">
                                            	
                                    	<label label="Title" repeatertitle="true"> <p class="ex1"  style="font-family: Arial;">'.$hello.' ! 
                                    	</p> </label>
                                    	
                                    	
<multiline label="Description"> <p class="ex1"  style="font-family: Arial;">'.$message.'<br/>
<br/>


               '.db_get_text_($lang, 'all', 'thanks_item').'
               </p> <br/>  </multiline> 







                                         
											</td>
										</tr>                                        
                                        </repeater>


										
										<tr>
											<td valign="top" width="6" height="6">
												
											</td>
										</tr>
													

									</table>
								</td>
								<td valign="top" width="250">
									<table cellspacing="0" bgcolor="#7584CE" width="250" cellpadding="0">
										
										<tr>
											<td valign="top" width="344"></td>
											<td valign="top" width="6" align="right">
												
											</td>
										</tr>
										
										<tr>
											<td valign="top">
												<table cellspacing="0" cellpadding="0">

													<tr>

														<td class="subtitle" style="padding: 0 0 0 45px;" valign="top">
															<br />
														
                                                            
                                                                <table class="issue" cellspacing="0" border="0" cellpadding="0">
                                                                    <tr>
                                                                        <td height="20"></td>
                                                                        <td class="list" style="color: #cc0000; text-transform: uppercase; font-size: 14px; text-decoration: none; font-family: Verdana;"><repeatertitle /></td>
                                                                    </tr>
                                                                </table>
                                                            
														</td>

													</tr>
 <repeater>
													<tr>
														<td class="subtitle" style="padding: 25px 0 0 20px;">
               
               <multiline label="Description"> <p class="ex1"  style="font-family: Arial;">'.$message_2.'
		       		</p> </multiline>                                                            
														</td>
													</tr>
													</repeater>




													<tr>
														<td class="side-share" align="center" style="padding: 30px 0 0 20px;">
															<a style="display: block; width: 210px; height: 20px; padding: 12px 5px; text-align: center; -moz-border-radius: 5px; -webkit-border-radius: 5px;  color: #fff; text-transform: uppercase; text-decoration: none; font-weight: bold; font-family:Arial; background-color: #22336C;" href = "'.$link.'">'.$button.'</a>
															<br /><br /><br />
														</td>
													</tr>

												</table>
												
											</td>
										</tr>
										
										<tr>
											<td valign="top" ></td>
											<td valign="top" >
												
											</td>
										</tr>
										
									</table>
								</td>
							</tr>

						</table>
						<!--  / content -->
					</td>
				</tr>
			</table>
			
		</td>
	
	</tr>
	<tr>
		<td valign="top">
			<table cellspacing="0" width="100%" cellpadding="0">
				<tr>
					<td valign="top">
						<!-- footer -->
						<table cellspacing="0" border="0" align="center" cellpadding="0" width="600">
							<tr>
								<td valign="top">
									<table class="options" cellspacing="0" border="0" width="600" cellpadding="0">
										<tr>
											<td class="unsubscribe" valign="top" style="padding: 20px; text-align: center;" width="600">
											<!--	<p><multiline label="Description">Not Interested anymore?</multiline> <unsubscribe style="color: #cc0000; text-decoration: none;">Unsubscribe</unsubscribe></p> --->
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<!-- / end footer -->
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table class="footer" cellspacing="0" width="100%" cellpadding="0">
							<tr>
								<td class="copyright" align="center" height="80" valign="middle" style="background-color : #22336C;">
                                    <multiline label="Description"></multiline>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>

</div>';
//$message_html="<div>Test</div>";
////$message_html = mb_convert_encoding($message_html, "ASCII", "UTF-8");
//$message_html=html_entity_decode($message_html);





?>
