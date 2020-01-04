
<script src="js/ck/ckeditor.js"></script>
<script src="js/ck/sample.js"></script>
<?php 
require_once("config.php"); 
if( isset($_SESSION['id']))
{ 
	
	if( isset($_GET['addNews']) ) { //log

    	if( $_GET['addNews'] == "ok" ) { //login user
    
    		 $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    		 $reference = htmlspecialchars($_POST['reference'], ENT_QUOTES);
    		 $user_id = "2";
    		 $category_id = htmlspecialchars($_POST['category_id'], ENT_QUOTES);
    		 $description=htmlspecialchars($_POST['description'], ENT_QUOTES);
    	    
    	     $attachment = file_get_contents($_FILES['attachment']['tmp_name']);
	    	 $attachment = base64_encode($attachment);
    	    
    	    //print_r($_POST);
    	    
    	    //die();
    
    			$headers = array(
    				"Accept: application/json",
    				"Content-Type: application/json",
    				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
    			);
    
    			$data = array(
    				"title" => $title,
    				"reference" => $reference,
    				"user_id" => $user_id,
    				"category_id" => $category_id,
    				"attachment" => array("file_data" => $attachment),
    				"description" => $description
    			);
    
    			$ch = curl_init( $baseurl.'addNews' );
    
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    			$return = curl_exec($ch);
    
    			$json_data = json_decode($return, true);
    
    			$curl_error = curl_error($ch);
    			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    			//echo json_encode($data);
    			//print_r(json_encode($data));
    			
    			
    			curl_close($ch);
    
    			if($json_data['code'] == 201){
    				echo "<script>window.location='dashboard.php?p=addNews&action=error'</script>";
    			} 
    			else 
    			{	
    			
    				echo "<script>window.location='dashboard.php?p=addNews&action=success'</script>";
    
    			}
    
    
    	} //login user = end
        
    } //log = end
    
    if( $_GET['update'] == "ok" ) 
    {
             
         
		 
		 $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
		 $news_id = htmlspecialchars($_POST['news_id'], ENT_QUOTES);
		 $reference = htmlspecialchars($_POST['reference'], ENT_QUOTES);
		 $user_id = "2";
		 $category_id = htmlspecialchars($_POST['category_id'], ENT_QUOTES);
		 $description=htmlspecialchars($_POST['description'], ENT_QUOTES);
	    
	     $attachment = file_get_contents(@$_FILES['attachment']['tmp_name']);
    	 $attachment = base64_encode($attachment);
	     
	     
	    
			$headers = array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
			);
            
            if($attachment)
    	     {
    	         $data = array(
    				"title" => $title,
    				"reference" => $reference,
    				"user_id" => $user_id,
    				"category_id" => $category_id,
    				"attachment" => array("file_data" => $attachment),
    				"description" => $description,
    				"news_id" => $news_id
    			);
    	     }
    	     else
    	     {
    	         $data = array(
    				"title" => $title,
    				"reference" => $reference,
    				"user_id" => $user_id,
    				"category_id" => $category_id,
    				"description" => $description,
    				"news_id" => $news_id
    			);
    	     }
    	     
			

			$ch = curl_init( $baseurl.'editNews' );

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$return = curl_exec($ch);

			$json_data = json_decode($return, true);

			$curl_error = curl_error($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			//echo json_encode($data);
			//print_r(json_encode($data));
			
			
			curl_close($ch);

			if($json_data['code'] == 201){
				echo "<script>window.location='dashboard.php?p=all_news&action=error'</script>";
			} 
			else 
			{	
			
				echo "<script>window.location='dashboard.php?p=all_news&action=success'</script>";

			}


	}
    
    
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "news_id" => @$_GET['id']
	);

	$ch = curl_init( $baseurl.'showNewsDetails' );
   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    
    //echo $baseurl.'showNewsDetail' ;
    //var_dump($return);

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	curl_close($ch);

	?>

	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  	<!--<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
		    $('#data1').DataTable();
		} );
	</script>

	
	<h2 class="title">Add News</h2>
	
	<div class="form">
    	<div class="left col100">
    		<div class="form">
    			
    			<?php
    			    if(@$_GET['action']=="editNews")
    			    {
    			        $actionurl="dashboard.php?p=addNews&update=ok";
    			    }
    			    else
    			    {
    			        $actionurl="dashboard.php?p=addNews&addNews=ok";
    			    }
    			?>
    			<form action="<?php echo $actionurl; ?>" id="changepass" enctype="multipart/form-data" method="post" novalidate="novalidate" >
    			       
    			    <input id="news_id" name="news_id" type="hidden" value="<?php echo @$json_data['msg']['News']['id']; ?>">
    				<p style="margin-bottom: 30px;">
    				    <input id="title" name="title" required="" aria-required="true"  type="text" autocomplete="off" value="<?php echo @$json_data['msg']['News']['title']; ?>">
    					<label alt="Title" placeholder="Title"></label>
    				</p>
    				
    				
    				<?php
    				    if(isset($_GET['id']))
    				    {
    				        $imageurl=$img_baseurl.'/'.$json_data['msg']['News']['thumb'];
    				    }
    				    else
    				    {
    				        $imageurl="img/upload.png";
    				    }
    				
    				?>
    				<div class="col100 left twocll">
            			<label for="attachment" class="uploadbtn" style="background-color: #F9F9F9;">
            			    <div style="background-image: url('<?php echo $imageurl; ?>');background-size: 15%;background-position: 50% 5px; height:80px; width:100%;background-repeat: no-repeat;"></div>
            			    <h3>Select Image</h3>
            				<input name="attachment" id="attachment" onchange="return Upload_image()" type="file">
            			</label>
            		</div>
					
    				<p style="margin-bottom: 30px;">
    				    <input id="reference" name="reference" required="" aria-required="true"  type="text" autocomplete="off" value="<?php echo @$json_data['msg']['News']['reference']; ?>">
    					<label alt="Reference" placeholder="Reference"></label>
    				</p>
    				
    				<p style="margin-bottom: 30px;">
    				 <!--   <input id="description" name="description" required="" aria-required="true"  type="text" autocomplete="off">-->
    					<!--<label alt="description" placeholder="description"></label>-->
                        
                        <!--<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>-->
                        
                            
                            <textarea name="description" id="editor"><?php echo @$json_data['msg']['News']['description']; ?></textarea>
                               
                            <script>
                                ClassicEditor
                                    .create( document.querySelector( '#editor' ) )
                                    .catch( error => {
                                        console.error( error );
                                    } );
                            </script>
                        
    				</p>
    				
    				<p class="col100">
    				    <select name="category_id" class="cityies_selection" style="font-weight: 400;font-size: 12px;width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 3px;color: #555;box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);" required>
                            <option value="">Select Category</option>
                            
                            <?php
                                $headers = array(
                        			"Accept: application/json",
                        			"Content-Type: application/json"
                        		);
                        
                        		$data = array(
                        			//"user_id" => $user_id
                        		);
                        
                        		$ch = curl_init( $baseurl.'showCategories' );
                               
                        		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                        		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        
                        		$return = curl_exec($ch);
                        
                        		$json_data1 = json_decode($return, true);
                        	    //var_dump($return);
                        
                        		$curl_error = curl_error($ch);
                        		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        		
                        		foreach( $json_data1['msg'] as $str => $val ) 
                        		{
                        		    ?>
                        		        <option value="<?php echo $val['Category']['id']; ?>" <?php if(@$json_data['msg']['News']['category_id']==$val['Category']['id']){  echo "selected";}else{ echo "hello"; } ?> ><?php echo $val['Category']['name']; ?></option>
                        		    <?php
                        		}
                            ?>
                            
                        </select>
    				</p>
    				
    				<p ><input value="Post News" class="buttonColor" type="submit"></p>
    			
    			</form>
    		</div>
    	</div>
    	<div class="right col40">
    		
    	</div>
    	<div class="clear"></div>
    </div>

	<script>
		
		function addNewChat()
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
		    xmlhttp.open("GET","ajex-events.php?roomname=ok");
		    xmlhttp.send();
		}
	
		
	</script>
	<script>
		initSample();
		
		
	</script>
	


<?php } else {
	
	@header("Location: index.php");
    echo "<script>window.location='index.php'</script>";
    die;
    
} ?>