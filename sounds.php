<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{ 
	
	if( isset($_GET['insertChatRooom']) ) { //log

    	if( $_GET['insertChatRooom'] == "ok" ) { //login user
    
    		 $roomname = htmlspecialchars($_POST['roomname'], ENT_QUOTES);
    	    //$returnlink=htmlspecialchars($_POST['returnlink'], ENT_QUOTES);
    	    
    	    if($roomname!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    				"name" => $roomname
    			);
    
    			$ch = curl_init( $baseurl.'addChatRoom' );
    
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    			$return = curl_exec($ch);
    
    			$json_data = json_decode($return, true);
    
    			$curl_error = curl_error($ch);
    			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    			//echo $json_data['code'];
    			//print_r($json_data);
    			//die();
    			
    			curl_close($ch);
    
    			if($json_data['code'] == 201){
    				echo "<script>window.location='dashboard.php?p=chatroom&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=chatroom&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=chatroom&action=error'</script>";
    		} 
    
    	} //login user = end
    
    
    	
    
    } //log = end
	?>

	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  	<!--<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#data1').DataTable();
		} );
	</script>

	
	<h2 class="title">All Sounds</h2>
	
	<br>
	<div class="left">
        <a href="?p=sounds&page=sound" class="links_sublinks  <?php if(@$_GET['page']=="sound"){ echo "links_sublinks_active";} ?> ">
    		<span>All Sound</span>
    	</a>
        
        <a href="?p=sounds&page=sections" class="links_sublinks  <?php if(@$_GET['page']=="sections"){ echo "links_sublinks_active";} ?>  " style="margin-left: 22px;">
            <span>All Sections</span>
            
        </a>
    
    </div>
    
    <?php
        if(@$_GET['page']=="sounds")
        {
            ?>
                <div class="right" style="padding: 10px 0;">
                    <a href="uploadSound/" target="_blank">
            			<button style="background:  #C82D32; color:  white; padding:  8px 8px; border:  0px; border-radius:  3px;">Add Sound File</button>
                    </a>
                </div>
            <?php
        }
    ?>
    
    <div class="clear"></div>
    <br>
    <br>
    <br>
    
	
	
	<?php 
		
		
		if(@$_GET['page']=="sound")
    	{
    	 
    	        $headers = array(
    			"Accept: application/json",
    			"Content-Type: application/json"
        		);
        
        		$data = array(
        			//"user_id" => $user_id
        		);
        
        		$ch = curl_init( $baseurl.'admin_all_sounds' );
               
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        		$return = curl_exec($ch);
        
        		$json_data = json_decode($return, true);
        	   // var_dump($return);
        
        		$curl_error = curl_error($ch);
        		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                //echo count($json_data['msg']);
                //print_r($json_data);
        		//echo $json_data['code'];
        		//die;
        
        		if($json_data['code'] != "200"){
        			//echo "<div class='alert alert-danger'>Error in fetching order history, try again later..</div>";
        			?>
        			<div class="textcenter nothingelse">
        				<img src="img/noorder.png" alt="" />
        				<h3>No Record Found2</h3>
        			</div>
        			<?php
        
        		} else {
        			?>
        			
        			<?php 
        			
        			$rows = count($json_data['msg']);
        			if( $rows == 0 ) {
        				?>
        				<div class="textcenter nothingelse">
        					<img src="img/noorder.png" alt="" />
        					<h3>No Record Found1</h3>
        				</div>
        				<?php
        			}
        			echo "<table id='data1' class='display' style='width:100%''>
        			<thead>
        	            <tr>
        	                <th>ID</th>
        	                <th>Sound Preview</th>
        	                <th>Sound Name</th>
        	                <th>Description</th>
        	                <td>Section</th>
        	                <th>Created</th>
        	            </tr>
        	        </thead>
        			<tbody id='myTable_row'>";
        			
        			foreach( $json_data['msg'] as $str => $val ) {
        				//var_dump($val);
        				?>
        				<tr style=" text-align: center;">
        					<td>
        						<?php 
        							echo $val['id']; 
        						?>
        					</td>
        					<td id='preview_play_<?php echo $val['id']; ?>' >
        					    <span onclick="playsound('<?php echo $val['id']; ?>')"><img src="img/play.png" style="width: 30px;"></span>
        					</td>
        					<td style="line-height: 20px;">
        						<?php 
        							echo $val['sound_name'];
        						?>		
        					</td>
        					<td>
        						<?php echo $val['description'];  ?>
        					</td>
        					
        					<td>
        						<?php echo $val['section'];  ?>
        					</td>
        					
        				    <td>
        						<?php 
        							echo $val['created']; 
        						?>
        					</td>
        					
        					
        					
        					
        				</tr>
        				<?php
        			}
        			echo "</tbody>
        			<tfoot>
        	            <tr>
        	                <th>ID</th>
        	                <th>thum</th>
        	                <th>Sound Name</th>
        	                <th>Description</th>
        	                <td>Section</th>
        	                <th>Created</th>
        	            </tr>
        	        </tfoot>
        	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
        			///
        		}
        
        		curl_close($ch);
    	    
    	}
    	else
    	if(@$_GET['page']=="sections")
    	{
    	         $headers = array(
    			"Accept: application/json",
    			"Content-Type: application/json"
        		);
        
        		$data = array(
        			//"user_id" => $user_id
        		);
        
        		$ch = curl_init( $baseurl.'admin_getSoundSection' );
               
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        		$return = curl_exec($ch);
        
        		$json_data = json_decode($return, true);
        	   // var_dump($return);
        
        		$curl_error = curl_error($ch);
        		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                //echo count($json_data['msg']);
                //print_r($json_data);
        		//echo $json_data['code'];
        		//die;
        
        		if($json_data['code'] != "200"){
        			//echo "<div class='alert alert-danger'>Error in fetching order history, try again later..</div>";
        			?>
        			<div class="textcenter nothingelse">
        				<img src="img/noorder.png" alt="" />
        				<h3>No Record Found2</h3>
        			</div>
        			<?php
        
        		} else {
        			?>
        			
        			<?php 
        			
        			$rows = count($json_data['msg']);
        			if( $rows == 0 ) {
        				?>
        				<div class="textcenter nothingelse">
        					<img src="img/noorder.png" alt="" />
        					<h3>No Record Found1</h3>
        				</div>
        				<?php
        			}
        			echo "<table id='data1' class='display' style='width:100%''>
        			<thead>
        	            <tr>
        	                <th>ID</th>
        	                <th>Section Name</th>
        	                <th>Created</th>
        	            </tr>
        	        </thead>
        			<tbody id='myTable_row'>";
        			
        			foreach( $json_data['msg'] as $str => $val ) {
        				//var_dump($val);
        				?>
        				<tr style=" text-align: center;">
        					<td>
        						<?php 
        							echo $val['id']; 
        						?>
        					</td>
        					
        					<td>
        						<?php echo $val['section_name'];  ?>
        					</td>
        					
        				    <td>
        						<?php 
        							echo $val['created']; 
        						?>
        					</td>
        					
        					
        					
        					
        				</tr>
        				<?php
        			}
        			echo "</tbody>
        			<tfoot>
        	            <tr>
        	                <th>ID</th>
        	                <th>Section Name</th>
        	                <th>Created</th>
        	            </tr>
        	        </tfoot>
        	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
        			///
        		}
        
        		curl_close($ch);
    	}
    	
    	
		
	?>

	<script>
		
		function playsound(data)
		{	
			document.getElementById('preview_play_'+data).innerHTML='<audio controls="controls" style="border-radius: 20px;height: 30px;"><source src="<?php echo $sound_baseurl_play; ?>'+data+'.aac" type="audio/mp4" /></audio>';
		}
	
		
	</script>



<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>