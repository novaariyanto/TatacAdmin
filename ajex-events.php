<?php
@require_once("config.php");


if(@$_GET['action']=="addCategory") 
{   
    
    
    ?>
        
        <h2 style="font-weight: 300;" align="center">Add Category</h2>
        
        <br><br>
       
       <form action="dashboard.php?p=allCategory&action=category_name"  enctype="multipart/form-data" method="post" novalidate="novalidate">
        
        <p style="margin-bottom: 30px;">
          <input name="category_name" required="" type="text">
          <label alt="Category Name" placeholder="Category Name"></label>
        </p>
        
        <div class="col100 left twocll">
			<label for="attachment" class="uploadbtn" style="background-color: #F9F9F9;">
			    <div style="background-image: url('img/upload.png');background-size: 15%;background-position: 50% 5px; height:80px; width:100%;background-repeat: no-repeat;"></div>
			    <h3>Select Image</h3>
				<input name="attachment" id="attachment" onchange="return Upload_image()" type="file">
			</label>
		</div>
		
        <p style="width: 100%;" class="right">
          <input value="Submit" class="buttoncolor" style="border: 0px;" type="submit">
        </p>
      </form>
       
           
    <?php

}
else
if(@$_GET['action']=="editCategory") 
{   
    
    $id = @$_GET['id'];
    
    $headers = array(
		"Accept: application/json",
		"Content-Type: application/json"
	);

	$data = array(
	    "cat_id" => $id
	);

	$ch = curl_init( $baseurl.'showCategoryDetails' );
   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$return = curl_exec($ch);

	$json_data = json_decode($return, true);
    //var_dump($return);

	$curl_error = curl_error($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	if(isset($_GET['id']))
    {
        $imageurl=$img_baseurl.'/'.$json_data['msg']['Category']['thumb'];
    }
    else
    {
        $imageurl="img/upload.png";
    }
    
    ?>
        
        <h2 style="font-weight: 300;" align="center">Edit Category</h2>
        
        <br><br>
       
       <form action="dashboard.php?p=allCategory&action=edit_category"  enctype="multipart/form-data" method="post" novalidate="novalidate">
        <input type="hidden" id='cat_id' name="cat_id" value="<?php echo $id; ?>">
        <p style="margin-bottom: 30px;">
          <input name="category_name" required="" type="text" value="<?php echo $json_data['msg']['Category']['name']; ?>">
          <label alt="Category Name" placeholder="Category Name"></label>
        </p>
        
        <div class="col100 left twocll">
			<label for="attachment" class="uploadbtn" style="background-color: #F9F9F9;">
			    <div style="background-image: url('<?php echo $imageurl; ?>');background-size: 23%;background-position: 50% 5px; height:80px; width:100%;background-repeat: no-repeat;"></div>
			    <h3>Select Image</h3>
				<input name="attachment" id="attachment" onchange="return Upload_image()" type="file">
			</label>
		</div>
		
        <p style="width: 100%;" class="right">
          <input value="Send Now" class="buttoncolor" style="border: 0px;" type="submit">
        </p>
      </form>
       
           
    <?php

}
else
if(@$_GET['addSection']=="ok") 
{
    
    ?>
        
        <h2 style="font-weight: 300;" align="center">Add Section</h2>
        
        <br><br>
       
       <form action="dashboard.php?p=appSetting&action=add_section" method="post">
        <p style="width: 100%;" class="left">
          <input name="section_name" required="" type="text">
          <label alt="Section Name" placeholder="Section Name"></label>
        </p>
        
        <p style="width: 100%;" class="left">
          <input name="indexing" required="" type="text">
          <label alt="indexing" placeholder="indexing"></label>
        </p>
        
        <p style="width: 100%;" class="right">
          <input value="Submit Now" class="buttoncolor" style="border: 0px;" type="submit">
        </p>
      </form>
       
           
    <?php

}
else
if(@$_GET['editSeciton']=="ok") 
{
    $id=$_GET['id'];
    
    $headers = array(
    	"Accept: application/json",
    	"Content-Type: application/json"
    );
    
    $data = array(
    	"section_id" => $id
    );
    
    $ch = curl_init( $baseurl.'showSectionDetails' );
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $return = curl_exec($ch);
    
    $json_data = json_decode($return, true);
    //var_dump($return);
    
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
   
    ?>
        
        <h2 style="font-weight: 300;" align="center">Edit Section</h2>
        
        <br><br>
       
       <form action="dashboard.php?p=appSetting&action=editSection" method="post">
        <input name="id" type="hidden" value="<?php echo $id; ?>">   
        <p style="width: 100%;" class="left">
          <input name="section_name" required="" type="text" value="<?php echo $json_data['msg']['Section']['name']; ?>">
          <label alt="Section Name" placeholder="Section Name"></label>
        </p>
        
        <p style="width: 100%;" class="left">
          <input name="indexing" required="" type="text" value="<?php echo $json_data['msg']['Section']['s_order']; ?>">
          <label alt="indexing" placeholder="indexing"></label>
        </p>
        
        <p style="width: 100%;" class="right">
          <input value="Submit Now" class="buttoncolor" style="border: 0px;" type="submit">
        </p>
      </form>
       
           
    <?php

}
else
if(@$_GET['addIntoSection']=="ok") 
{
    
    ?>
        
        <h2 style="font-weight: 300;" align="center">Show in Section </h2>
        
        <br><br>
       
       <form action="dashboard.php?p=all_news&action=addIntoSection" method="post">
        <input name="id" required="" value="<?php echo @$_GET['id']; ?>" type="hidden">
        
        <p style="width: 100%;" class="left">
            <select name="section_id" class="cityies_selection" style="font-weight: 400;font-size: 12px;width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 3px;color: #555;box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);" required>
                <option value="">Select Section</option>
                
                <?php
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
            		
            		foreach( $json_data['msg'] as $str => $val ) 
            		{
            		    ?>
            		        <option value="<?php echo $val['Section']['id']; ?>"><?php echo $val['Section']['name']; ?></option>
            		    <?php
            		}
                ?>
                
            </select>
        </p>
        
        <p style="width: 100%;" class="right">
          <input value="Submit Now" class="buttoncolor" style="border: 0px;" type="submit">
        </p>
      </form>
       
           
    <?php

}


?>