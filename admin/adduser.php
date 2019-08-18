
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
   if(session::get('Role') !='1'){
     echo "<script>window.location = 'index.php';</script>";
	 //header("Location:index.php");
 }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
 <?php 
 
if($_SERVER['REQUEST_METHOD'] == 'POST'){	

		$username = $fm ->validation($_POST['username']);
		$password = $fm ->validation(md5($_POST['password']));
		$email = $fm ->validation($_POST['email']);
		$role = $fm ->validation($_POST['role']);
		
	$username = mysqli_real_escape_string($db->link,$username);
	$password = mysqli_real_escape_string($db->link,$password);
	$email = mysqli_real_escape_string($db->link,$email);
	$role = mysqli_real_escape_string($db->link,$role);
	
    if(empty($username) || empty($password) || empty($email) || empty($role)){
		echo "<span class='error'>Field must not be Empty </span>";
	}else{
	
	 $mailquery ="Select * from  tbl_user where email='$email' limit 1";
   $mailcheck = $db->select($mailquery);
   if ( $mailcheck  !=false){
	   echo "<span class='error'>Email Already Exist!</span>";
   }else{
		$query = "INSERT INTO tbl_user (username,password,email,role) VALUES ('$username','$password ','$email','$role')"; 
		$catinsert = $db->insert($query);
		if($catinsert){
			echo "<span class='success'>User Created Succesfully.</span>";
		}else {
			echo "<span class='error'>User Not Created Succesfully.</span>";
		}
	}
}
}
?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
				   <td>
					<label>Username </label>
			       </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter Username ..." class="medium" />
                              </td>
                        </tr>
					 
						   <tr>
						<td>
						<label>Password</label>
						</td>
                            <td>
                                <input type="password" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
						  <tr>
						<td>
						<label>Email</label>
						</td>
                            <td>
                                <input type="email" name="email" placeholder="Enter Valid Email..." class="medium" />
                            </td>
                        </tr>
						 <tr>
						<td>
						<label>User Role</label>
						   </td>
                            <td>
                            <select id="select" name="role">
                             <option>Select User Role </option>
							 <option value="1">Admin</option>
							 <option value="2">Author</option>
							 <option value="3">Editor</option>
							</select>
                            </td>
                        </tr>
							<tr>
					<td> </td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
           <?php include 'inc/footer.php';?>