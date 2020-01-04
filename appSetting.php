<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{ 
	
	if( isset($_GET['action']) ) { //log

    	if( $_GET['action'] == "add_section" ) { //login user
    
    		 $section_name = htmlspecialchars($_POST['section_name'], ENT_QUOTES);
    	     $indexing=htmlspecialchars($_POST['indexing'], ENT_QUOTES);
    	    
    	    if($section_name!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    			    "user_id" => @$_SESSION['id'],
    			    "name" => $section_name,
    				"s_order" => $indexing
    			);
    
    			$ch = curl_init( $baseurl.'addSection' );
    
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
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=error'</script>";
    		} 
    
    	} //login user = end
        else
        if( $_GET['action'] == "deleteSection" ) { //login user
    
    		 $section_id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    	    
    	    if($section_id!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    			    "user_id" => @$_SESSION['id'],
    			    "section_id" => $section_id
    			);
    
    			$ch = curl_init( $baseurl.'deleteSection' );
    
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
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=error'</script>";
    		} 
    
    	}
        else
        if( $_GET['action'] == "editSection" ) { //login user
    
    		 $section_id = htmlspecialchars($_POST['id'], ENT_QUOTES);
    		 $name = htmlspecialchars($_POST['section_name'], ENT_QUOTES);
    		 $s_order = htmlspecialchars($_POST['indexing'], ENT_QUOTES);
    	    
    	    if($section_id!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    			    "user_id" => @$_SESSION['id'],
    			    "section_id" => $section_id,
    			    "name" => $name,
    			    "s_order" => $s_order
    			);
                
                
    			$ch = curl_init( $baseurl.'editSection' );
    
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
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=appSetting&page=sections&action=error'</script>";
    		} 
    
    	}
    	else
    	if( $_GET['action'] == "deleteSlider" ) { //login user
    
    		 $news_id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    		 
    	    if($news_id!="") { 
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    			    "user_id" => @$_SESSION['id'],
    			    "slider_news_id" => $news_id
    			);
    
    			$ch = curl_init( $baseurl.'deleteSliderNews' );
    
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
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sliderNews&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=appSetting&page=sliderNews&action=success'</script>";
    
    			}
    
    		} 
    		else 
    		{
    			echo "<script>window.location='dashboard.php?p=appSetting&page=sliderNews&action=error'</script>";
    		} 
    
    	}
    	
    
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

	
	<h2 class="title">App Setting</h2>
	
    <br>
	<div class="left">
        <a href="?p=appSetting&page=sliderNews" class="links_sublinks  <?php if(@$_GET['page']=="sliderNews"){ echo "links_sublinks_active";} ?> ">
    		<span>Slider News</span>
    	</a>
        
        <a href="?p=appSetting&page=sections" class="links_sublinks  <?php if(@$_GET['page']=="sections"){ echo "links_sublinks_active";} ?>  " style="margin-left: 22px;">
            <span>Sections</span>
            
        </a>
    
    </div>
    
    <?php
        if(@$_GET['page']=="sections")
        {
            ?>
                <div class="right">
            	    <a href="#" onclick="addNewSeciton();">
                        <button class="buttonColor" style="padding:  8px 8px; border:  0px; border-radius:  3px;">Add Section</button>
                    </a>
                </div>
            <?php
        }
    ?>
    
    <div class="clear"></div>
    <br><br><br>

	<?php 
		
		//slidernews
		if(@$_GET['page']=="sliderNews")
		{
    		    $headers = array(
    			"Accept: application/json",
    			"Content-Type: application/json"
        		);
        
        		$data = array(
        			//"user_id" => $user_id
        		);
        
        		$ch = curl_init( $baseurl.'showSliderNews' );
               
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        		$return = curl_exec($ch);
        
        		$json_data = json_decode($return, true);
        	    //var_dump($return);
        
        		$curl_error = curl_error($ch);
        		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                //echo count($json_data['msg']);
                ///print_r($json_data);
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
        			if( $rows == "0" ) {
        				?>
        				<div class="textcenter nothingelse">
        					<img src="img/noorder.png" alt="" />
        					<h3>No Record Found</h3>
        				</div>
        				<?php
        				die();
        			}
        			echo "<table id='data1' class='display' style='width:100%''>
        			<thead>
        	            <tr>
        	                <th>ID</th>
        	                <th>Title</th>
        	                <th>Auther</th>
        	                <th>Category</th>
        	                <th>Created</th>
        	                <th>Action</th>
        	            </tr>
        	        </thead>
        			<tbody id='myTable_row'>";
        			
        			foreach( $json_data['msg'] as $str => $val ) {
        				//var_dump($val);
        				?>
        				<tr style=" text-align: center;">
        					<td>
        						<?php 
        							echo $val['SliderNews']['id']; 
        						?>
        					</td>
        					<td style="line-height: 20px;">
        						<?php 
        							echo $val['News']['title']; 
        						?>	
        					</td>
        					<td>
        						<?php 
        							echo $val['User']['first_name']." ".$val['User']['last_name'];
        						?>	
        					</td>
        					<td>
        						<?php echo $val['News']['Category']['name'];  ?>
        					</td>
        					
        					
        					<td>
        						<?php 
        							echo $val['News']['created']; 
        						?>
        					</td>
        					
        					<td>
        						<i onclick="myFunction('dropdown_<?php echo $val['SliderNews']['id']; ?>')" class="fas fa-ellipsis-h" style="cursor: pointer;font-size: 18px;"></i>
        						<div id="dropdown_<?php echo $val['SliderNews']['id']; ?>" class="w3-dropdown-content w3-bar-block w3-border">
                                  
                                  <a href="?p=appSetting&page=sliderNews&action=deleteSlider&id=<?php echo $val['SliderNews']['id']; ?>" class="w3-bar-item w3-button">
                                    <i class="fas fa-trash"></i>&nbsp;
                                    Delete
                                  </a>
                                  
                                </div>
        					</td>
        					
        					
        					
        					
        				</tr>
        				<?php
        			}
        			echo "</tbody>
        			<tfoot>
        	            <tr>
        	                <th>ID</th>
        	                <th>Title</th>
        	                <th>Auther</th>
        	                <th>Category</th>
        	                <th>Created</th>
        	                <th>Action</th>
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
        
        		$ch = curl_init( $baseurl.'showSections' );
               
        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        		$return = curl_exec($ch);
        
        		$json_data = json_decode($return, true);
        	    //var_dump($return);
        
        		$curl_error = curl_error($ch);
        		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                //echo count($json_data['msg']);
                ///print_r($json_data);
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
        	                <th>Index</th>
        	                <th>Created</th>
        	                <th>Action</th>
        	            </tr>
        	        </thead>
        			<tbody id='myTable_row'>";
        			
        			foreach( $json_data['msg'] as $str => $val ) {
        				//var_dump($val);
        				?>
        				<tr style=" text-align: center;">
        					<td>
        						<?php 
        							echo $val['Section']['id']; 
        						?>
        					</td>
        					<td style="line-height: 20px;">
        						<?php 
        							echo $val['Section']['name']; 
        						?>	
        					</td>
        					<td>
        						<?php 
        							echo $val['Section']['s_order']; 
        						?>		
        					</td>
        				    
        					<td>
        						<?php 
        							echo $val['Section']['created']; 
        						?>
        					</td>
        					
        					<td>
        						<i onclick="myFunction('dropdown_<?php echo $val['Section']['id']; ?>')" class="fas fa-ellipsis-h" style="cursor: pointer;font-size: 18px;"></i>
        						<div id="dropdown_<?php echo $val['Section']['id']; ?>" class="w3-dropdown-content w3-bar-block w3-border">
                                  <span onclick="editSeciton('<?php echo $val['Section']['id']; ?>');" class="w3-bar-item w3-button">
                                    <i class="fas fa-edit"></i>&nbsp;
                                    Edit
                                  </span>
                                  
                                  <a href="?p=appSetting&page=sections&action=deleteSection&id=<?php echo $val['Section']['id']; ?>" class="w3-bar-item w3-button">
                                    <i class="fas fa-trash"></i>&nbsp;
                                    Delete
                                  </a>
                                  
                                </div>
        					</td>
        					
        				</tr>
        				<?php
        			}
        			echo "</tbody>
        			<tfoot>
        	            <tr>
        	                <th>ID</th>
        	                <th>Section Name</th>
        	                <th>Index</th>
        	                <th>Created</th>
        	                <th>Action</th>
        	            </tr>
        	        </tfoot>
        	        </table> <nav><ul class='pagination pagination-sm' id='myPager'></ul></nav>";
        			///
        		}
        
        		curl_close($ch);
        		
        		
		}
		
		
	?>

	<script>
		function myFunction(data) 
		{
          var x = document.getElementById(data);
          if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
          } else { 
            x.className = x.className.replace(" w3-show", "");
          }
        }
        
        
		function addNewSeciton()
		{	
			//alert(data1);
			document.getElementById("PopupParent").style.display="block";
		    document.getElementById("contentReceived").innerHTML="<div style='margin-top:150px;' align='center'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById('contentReceived').innerHTML=xmlhttp.responseText;
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?addSection=ok");
		    xmlhttp.send();
		}
		
		function editSeciton(data)
		{	
			//alert(data1);
			document.getElementById("PopupParent").style.display="block";
		    document.getElementById("contentReceived").innerHTML="<div style='margin-top:150px;' align='center'><img src='img/loader.gif' width='150px'></div>";
		    var xmlhttp;
		    if(window.XMLHttpRequest)
		      {// code for IE7+, Firefox, Chrome, Opera, Safari
		        xmlhttp=new XMLHttpRequest();
		      }
		    else
		      {// code for IE6, IE5
		        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		      }
		      
		      xmlhttp.onreadystatechange=function()
		      {
		        if(xmlhttp.readyState==4 && xmlhttp.status==200)
		        {
		           // alert(xmlhttp.responseText);
		           document.getElementById('contentReceived').innerHTML=xmlhttp.responseText;
		        }
		      }
		    xmlhttp.open("GET","ajex-events.php?editSeciton=ok&id="+data);
		    xmlhttp.send();
		}
	
		
	</script>



<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>