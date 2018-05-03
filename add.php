<?php
session_start();
session_regenerate_id();

#author: Joseph Parks joseph.parks@colorado.edu
#name: add.php
#purpose: Securing Story Sharing
#date: 2018-5-1
#version: 0.1

include_once "/var/www/html/collective/lib.php";
include_once "/var/www/html/collective/header.php";
$db=connect();
checkInput($s);

if($postUser != Null and $postPass != Null) {
	if(!isset($_SESSION['authenticated'])) {
		authenticate($db,$postUser,$postPass);
	}
}

extendedAuth();

echo "
	<a href=\"add.php?s=4\" class=\"btn btn-primary\"> Home </a>
	<a href=\"add.php?s=99\" class=\"btn btn-danger\"> Logout </a>
	<br>
	<br>
	<br>";

switch($s){

	default:
	case "4":	
		if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
		}
		// Get Username of current user
		$thisUsername=getThisUsername($thisUserid,$db);		

		echo "
			<div class=\"panel panel-primary\">
            <div class=\"panel-heading\">
              <h3 class=\"panel-title\">".$thisUsername."'s Home</h3>
            </div>
            <div class=\"panel-body\">
            <br>
            <br>";
            
		if(isAdmin()) {
			echo "<a href=\"add.php?s=90\" class=\"btn btn-default\"> Add/Delete Users </a>";
			echo "<br><br>";
			echo "<a href=\"add.php?s=92\" class=\"btn btn-default\"> Current Users </a>";
			echo "<br><br>";
			echo "<a href=\"add.php?s=95\" class=\"btn btn-default\"> Failed Logins </a>";
			echo "<br><br>";
			echo "<a href=\"add.php?s=96\" class=\"btn btn-default\"> IP Whitelist </a>";
			echo "<br><br>";
		} else {
			echo "<a href=\"add.php?s=11\" class=\"btn btn-default\"> View My Story </a>";
			echo "<br><br>";
			echo "<a href=\"add.php?s=7\" class=\"btn btn-default\"> New Story </a>";
			echo "<br><br>";
			echo "<a href=\"add.php?s=9\" class=\"btn btn-default\"> Delete Story </a>";
			echo "<br><br>";
			echo "<a href=\"add.php?s=5\" class=\"btn btn-default\"> Add/Remove Peer </a>";
			echo "<br><br>";		
			echo "<a href=\"add.php?s=12\" class=\"btn btn-default\"> View Shared </a>";
			echo "<br><br><br>";
			echo "<a href=\"add.php?s=14\" class=\"btn btn-warning\"> Destroy Everything! </a>";
		}
		
		echo "
			<br>
			<br>
			</div>
          	</div>";
	break;
	
	
	// Add peer for this user
	case "5":
		if(!isAdmin()) {
			echo "
				<div class=\"panel panel-success\">
            	<div class=\"panel-heading\">
              	<h3 class=\"panel-title\">Add Peer</h3>
            	</div>
            	<div class=\"panel-body\">
				<form method=\"post\" action=\"add.php\" id=\"addPeerForm\">
					<table>
						<tbody>
							<tr>
								<td colspan=\"2\"> Add Peer To Share Your Story </td>
							</tr>
							<tr>
								<td> Username of Peer: </td>
								<td><input type=\"text\" name=\"postPeer\" value=\"\"></td>
							</tr>
						</tbody>
					</table>
				</form>
				<button type=\"submit\" form=\"addPeerForm\" class=\"btn btn-success\" value=\"6\" name=\"s\" >Add Peer</button>
				<br>
				<br>
				</div>
          		</div>";
			
			echo "<br><br>";
			
			echo "
				<div class=\"panel panel-danger\">
            	<div class=\"panel-heading\">
              	<h3 class=\"panel-title\">Remove Peer</h3>
            	</div>
            	<div class=\"panel-body\">
				<form method=\"post\" action=\"add.php\" id=\"delPeerForm\">
					<table>
						<tbody>
							<tr>
								<td colspan=\"2\"> Remove Peer From Your Story </td>
							</tr>
							<tr>
								<td> Username of Peer: </td>
								<td><input type=\"text\" name=\"delPeer\" value=\"\"></td>
							</tr>
						</tbody>
					</table>
				</form>
				<button type=\"submit\" form=\"delPeerForm\" class=\"btn btn-danger\" value=\"6\" name=\"s\" >Remove Peer</button>
				<br>
				<br>
				</div>
          		</div>";
			
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}
		
	break;
	
	
	// Add peer to the sharedUser DB
	case "6":
		if(!isAdmin()) {
			
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
			
			if($postPeer!=Null) {
				$postPeer=mysqli_real_escape_string($db,$postPeer);
			
				//echo "   postPeer = $postPeer    <br>";
				//echo "   username = $username     <br>";
				if($stmt = mysqli_prepare($db, "select username from users where username=?")) {
					mysqli_stmt_bind_param($stmt, "s", $postPeer);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $peer);
					while(mysqli_stmt_fetch($stmt)) {
						$peer=$peer;
					}
					mysqli_stmt_close($stmt);

					// Check to see if this user is trying to share with themself
					if(!checkThisUser($thisUserid,$peer,$db)) {

						// Check if this user has already shared with the user they are requesting to share with
						if(!checkIfShared($thisUserid,$peer,$db)) {
							// Now add peer to the sharedWith table in DB
							if($stmt = mysqli_prepare($db, "insert into sharedWith set sharedWithid='',userid=?,sharedusername=?")) {
								mysqli_stmt_bind_param($stmt, "ss", $thisUserid,$peer);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_close($stmt);
							}
			
							if($peer != ''){
								echo "
									<div class=\"alert alert-warning\" role=\"alert\">
        								<strong>Warning!</strong> You Shared Your Story With Peer: $peer
      								</div>";
							} else {
								echo "
									<div class=\"alert alert-danger\" role=\"alert\">
       									<strong>Error!</strong> The User You Entered Does Not Exists. Check the spelling.
      								</div>";
							}
						} else {
							echo "
								<div class=\"alert alert-danger\" role=\"alert\">
        							<strong>Error!</strong> You Have Already Shared With This User: $peer
      							</div>";
						}
					
					} else {
						echo "
							<div class=\"alert alert-danger\" role=\"alert\">
        						<strong>Error!</strong> You Are This User: $peer
      						</div>";
					}
				
				} else {
					echo "Error with query.";
				}
				
	
				echo "<br><br>";
			
			} elseif ($delPeer!=Null) {
		
				$delPeer=mysqli_real_escape_string($db,$delPeer);
		
				//echo "   delPeer = $delPeer    <br>";
				//echo "   username = $username     <br>";
				if($stmt = mysqli_prepare($db, "select username from users where username=?")) {
					mysqli_stmt_bind_param($stmt, "s", $delPeer);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_bind_result($stmt, $peer);
					while(mysqli_stmt_fetch($stmt)) {
						$peer=$peer;
					}
					mysqli_stmt_close($stmt);

					// Check to see if this user is trying to share with themself
					if(!checkThisUser($thisUserid,$peer,$db)) {

						// Now delete peer from the sharedWith table in DB
						if($stmt = mysqli_prepare($db, "delete from sharedWith where userid=? and sharedusername=?")) {
							mysqli_stmt_bind_param($stmt, "ss", $thisUserid,$peer);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						}
						if($peer != ''){
							echo "
								<div class=\"alert alert-success\" role=\"alert\">
       								<strong>Done!</strong> You Successfully Removed This Peer From Your Story: $peer
      							</div>";
						} else {
							echo "
								<div class=\"alert alert-danger\" role=\"alert\">
       								<strong>Error!</strong> The User You Entered Does Not Exists. Check the spelling.
      							</div>";
						}
				
					} else {
						echo "
							<div class=\"alert alert-danger\" role=\"alert\">
       							<strong>Error!</strong> Tried To Remove Yourself From Your Own Sharing.
      						</div>";
					}
				
				} 	
				
			} else {
				echo "Error with query.";
			}
	
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}
		
	break;
	
	
	// New story
	case "7":
		if(!isAdmin()) {
		
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
		
			$query="select story from stories where userid=$thisUserid";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$story=$row[0];
			}
			
			// Check to see if a story already exists
			if($story==Null) {
				echo "
					<form method=\"post\" action=\"add.php\" id=\"newStoryForm\">
						<table>
							<tbody>
								<tr>
									<td colspan=\"2\"> Write Story </td>
								</tr>
								<tr>
									<td><textarea rows=\"20\" cols=\"100\" name=\"story\" value=\"\"></textarea></td>
								</tr>
							</tbody>
						</table>
					</form>
					<button type=\"submit\" form=\"newStoryForm\" class=\"btn btn-primary\" value=\"8\" name=\"s\" >Encrypt And Save</button>
					<br>
					<br>";
				
			} else {
				echo "
					<div class=\"alert alert-warning\" role=\"alert\">
       					<strong>Wait!</strong> You already have a story saved, if you want to store a new story then delete your old story first.
      				</div>";
			}
			
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}	
	
	break;
	
	
	// Encrypt story with users salt and add to DB
	case "8":
		if(!isAdmin()) {
	
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
			
			$story=mysqli_real_escape_string($db,$story);
			
			$query="select salt from users where userid=$thisUserid";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$salt=$row[0];
			}

// Encryption 256-bit AES		
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			//$plain_txt = "This is my plain text";
			//echo "Plain Text =" .$story. "\n <br>";
			$estory = encrypt_decrypt('encrypt', $story,$salt);
			//echo "Encrypted Text = " .$estory. "\n <br>";
			$decrypted_txt = encrypt_decrypt('decrypt', $estory,$salt);
			//echo "Decrypted Text =" .$decrypted_txt. "\n <br>";
		
			//if ( $story === $decrypted_txt ) echo "SUCCESS";
			//else echo "FAILED";
			//echo "\n <br>";

//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
		
			$estory=mysqli_real_escape_string($db,$estory);
			if($stmt = mysqli_prepare($db, "insert into stories set storyid='',story=?,userid=?")) {
				mysqli_stmt_bind_param($stmt, "ss", $estory,$thisUserid);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				echo "
					<div class=\"alert alert-success\" role=\"alert\">
        				<strong>Success!</strong> Your Story Is Secure
      				</div>";
			}

		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}
		
	break;
	
	
	// Delete Story
	case "9":
		if(!isAdmin()) {
			echo "
				<div class=\"panel panel-danger\">
            	<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Warning!</h3>
            	</div>
           		<div class=\"panel-body\">
					<p> Are you sure you want to permenantely delete your story? </p>
						<form method=\"post\" action=\"add.php\" id=\"deleteForm\">
						</form>
						<button type=\"submit\" form=\"deleteForm\" class=\"btn btn-primary\" name=\"s\" value=\"10\">Yes, Delete Story</button>
						<br>
						<br>
				</div>
				</div>";
			
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}		
	break;
	
	
	// Delete Users story from DB
	case "10":
		if(!isAdmin()) {
			
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
			
			if($stmt = mysqli_prepare($db, "delete from stories where userid=?")) {
				mysqli_stmt_bind_param($stmt, "s", $thisUserid);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
				echo "
					<div class=\"alert alert-success\" role=\"alert\">
       				 	<strong>Success!</strong> Your Story Has Been Completely Deleted From The Database!
      				</div>";
			}
		
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}

	break;
	
	
	// View my story
	case "11":
		if(!isAdmin()) {
	
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
		
			$query="select salt from users where userid=$thisUserid";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$salt=$row[0];
			}
	
			$query="select story from stories where userid=$thisUserid";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$estory=$row[0];
			}
		
			$decrypted_txt = encrypt_decrypt('decrypt', $estory,$salt);
			//echo "Decrypted Text =" .$decrypted_txt. "\n <br>";
			echo "
				<div class=\"jumbotron\">
        			<h3>My Story</h3>
        			<p>".$decrypted_txt."</p>
      			</div>";

		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";		
		}
	break;
	
	
	// Show what peers have shared their story with this user
	case "12":
		if(!isAdmin()) {
		
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}

			$thisUsername=getThisUsername($thisUserid,$db);
		
			echo "
				<div class=\"panel panel-primary\">
            	<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">These Peers have shared their story with you</h3>
            	</div>
           		<div class=\"panel-body\">
				<center>
				<div>
          			<table class=\"table table-striped\">
            			<thead>
              				<tr>
                				<th> </th>
                				<th>Username</th>
              				</tr>
            			</thead>
            			<tbody>";
		
			$count=0;
			$query="select userid from sharedWith where sharedusername='$thisUsername'";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$sharedUserid=$row[0];
				$count=$count+1;
				$query2="select username from users where userid='$sharedUserid'";
				$result2=mysqli_query($db, $query2);
				while($row2=mysqli_fetch_row($result2)) {
					$sharedUsername=$row2[0];
					echo"
						<tr>
							<td> $count </td>
							<td><a href=add.php?sharedUsername=$sharedUsername&s=13> $sharedUsername </a></td>
						</tr>\n";
				}
			}
  			echo "
  						</tbody>
         			</table>
         		</div>
				</div>
        		</div>";
  		
  			echo "<br><br>";
  		
  			$query="select username from users where userid=$thisUserid";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$thisUsername=$row[0];
			}
		
			echo "
				<div class=\"panel panel-danger\">
            	<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">You Have Shared Your Story With These Peers</h3>
            	</div>
            	<div class=\"panel-body\">
				<center>
				<div>
          			<table class=\"table table-striped\">
            			<thead>
              				<tr>
                				<th> </th>
                				<th>Username</th>
              				</tr>
            			</thead>
            		<tbody>";
		
			$counter=0;
			$query="select sharedUsername from sharedWith where userid='$thisUserid'";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$sharedUsername=$row[0];
				$counter=$counter+1;
				echo"
					<tr>
						<td> $counter </td>
						<td><a href=add.php?s=11> $sharedUsername </a></td>
					</tr>\n";
			}
		
  			echo "
  						</tbody>
         			</table>
         		</div>
         		</div>
        		</div>
        		</div>";
    	
    	} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
        }
  		
	break;
	
	
	// Show the unencrypted story of the user who shared with this user
	case "13":
		if(!isAdmin()) {
	
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
		
			$query="select userid from users where username='$sharedUsername'";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$sharedUserid=$row[0];
			}

			$query="select salt from users where username='$sharedUsername'";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$salt=$row[0];
			}
		
			$query="select story from stories where userid='$sharedUserid'";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$estory=$row[0];
			}
		
			$decrypted_txt = encrypt_decrypt('decrypt', $estory,$salt);
			echo "
				<div class=\"jumbotron\">
        			<h3>".$sharedUsername."'s Story</h3>
        			<p>".$decrypted_txt."</p>
      			</div>";

		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";		
		}

	break;
	
	
	// Form for User to delete their user from the system, and everything with it
	case "14":
		if(!isAdmin()) {
			echo "
				<div class=\"panel panel-danger\">
            	<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Nuke All Your Data</h3>
            	</div>
            	<div class=\"panel-body\">
				<h4> This will eradicate your user from Collective. This permanently deletes your story, your user, and everything about you, and everything anyone ever shared with you. This effectively Nukes all information related to your user from the system. </h4>
				<form method=\"post\" action=\"add.php\" id=\"deleteUserForm\">
				</form>
				<button type=\"submit\" form=\"deleteUserForm\" class=\"btn btn-primary\" name=\"s\" value=\"15\">Yes, Destroy Me</button>
				<br>
				<br>
				</div>
        		</div>";
			
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}
	break;
	
	
	// Actually delete user from all the tables in DB
	case "15":
		if(!isAdmin()) {
			if(isset($_SESSION['userid'])) {
				$thisUserid=$_SESSION['userid'];
			}
			
			$query="select username from users where userid='$thisUserid'";
			$result=mysqli_query($db, $query);
			while($row=mysqli_fetch_row($result)) {
				$delUser=$row[0];
			}
			
			if($delUser!=Null) {
				
				$delUser=mysqli_real_escape_string($db,$delUser);
				
			
					if($stmt = mysqli_prepare($db, "delete from sharedWith where sharedusername=? or userid=?")) {
						mysqli_stmt_bind_param($stmt, "ss", $delUser,$thisUserid);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
					}
					if($stmt = mysqli_prepare($db, "delete from stories where userid=?")) {
						mysqli_stmt_bind_param($stmt, "s", $thisUserid);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
					}
					if($stmt = mysqli_prepare($db, "delete from users where userid=?")) {
						mysqli_stmt_bind_param($stmt, "s", $thisUserid);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
					}

					// Now that everything related to this user has been deleted, log them out
					logout();			
			}
		
		} else {
			echo "Permission Denied: No Access for admin";
			echo "<br>";
		}
	break;
	
	
	// Add users to Collective
	case "90":
		if(isAdmin()) {
			echo "
				<div class=\"panel panel-success\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Add User</h3>
            	</div>
            	<div class=\"panel-body\">
					<form method=\"post\" action=\"add.php\" id=\"addUserForm\">
						<table>
							<tbody>
								<tr>
									<td colspan=\"2\"> Add Users to Collective </td>
								</tr>
								<tr>
									<td> Username: </td>
									<td><input type=\"text\" name=\"newUser\" value=\"\"></td>
								</tr>
								<tr>
									<td> Password: </td>
									<td><input type=\"text\" name=\"newPass\" value=\"\"></td>
								</tr>
								<tr>
									<td> Email: </td>
									<td><input type=\"text\" name=\"newEmail\" value=\"\"></td>
								</tr>
								
							</tbody>
						</table>
					</form>
					<button type=\"submit\" form=\"addUserForm\" class=\"btn btn-success\" value=\"91\" name=\"s\" >Add User</button>
					<br>
					<br>
				</div>
          		</div>";
        		
        	echo "<br><br>";
        		
        	echo "
        		<div class=\"panel panel-danger\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Delete User</h3>
            	</div>
            	<div class=\"panel-body\">
					<form method=\"post\" action=\"add.php\" id=\"delUserForm\">
						<table>
							<tbody>
								<tr>
									<td colspan=\"2\"> Delete User from Collective </td>
								</tr>
								<tr>
									<td> Username: </td>
									<td><input type=\"text\" name=\"delUser\" value=\"\"></td>
								</tr>
							</tbody>
						</table>
					</form>
					<button type=\"submit\" form=\"delUserForm\" class=\"btn btn-danger\" value=\"91\" name=\"s\" >Delete User</button>
					<br>
					<br>
				</div>
          		</div>";
        		
		} else {
			echo "Permission Denied: No Access for user";
			echo "<br>";
		}
	break;
	
	
	// Add/delete users from DB
	case "91":
		if(isAdmin()){
			if($newUser!=Null) {
				$query="select username from users where username='$newUser'";
  				$result=mysqli_query($db, $query);
  				while($row=mysqli_fetch_row($result))  {
					//echo"<tr><td> $row[0] </td></tr>\n";
					$thisUser=$row[0];
				}
				
				if($newUser!=$thisUser) {
				
					$salt=makeSalt();
		
					$newUser=mysqli_real_escape_string($db,$newUser);
					$newEmail=mysqli_real_escape_string($db,$newEmail);
		
					$epass=hash('sha256',$newPass.$salt);
					$epass=mysqli_real_escape_string($db,$epass);
					$salt=mysqli_real_escape_string($db,$salt);

					addUser($db,$newUser,$epass,$salt,$newEmail);
		
					echo "<br>";

					echo "
						<div class=\"alert alert-success\" role=\"alert\">
       						<strong>Success!</strong> New User: $newUser Has Been Added To Collective!
      					</div>";
					echo "<br>";
				
				} else {
					echo "
						<div class=\"alert alert-danger\" role=\"alert\">
       						<strong>Error!</strong> The Username $newUser Already Exists
      					</div>";
				}
			
			} 
			
			// Do not allow admin to delete themself from the web app
			if($delUser!='admin') {
				if($delUser!=Null) {
				
					$delUser=mysqli_real_escape_string($db,$delUser);
				
					$query="select userid from users where username='$delUser'";
  					$result=mysqli_query($db, $query);
  					while($row=mysqli_fetch_row($result))  {
						$sharedUserid=$row[0];
					}
			
					$query="select username from users where username='$delUser'";
  					$result=mysqli_query($db, $query);
  					while($row=mysqli_fetch_row($result))  {
						$sharedUsername=$row[0];
					}
				
					if($sharedUsername==$delUser) {
			
						if($stmt = mysqli_prepare($db, "delete from sharedWith where sharedusername=? or userid=?")) {
							mysqli_stmt_bind_param($stmt, "ss", $delUser,$sharedUserid);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						}
						if($stmt = mysqli_prepare($db, "delete from stories where userid=?")) {
							mysqli_stmt_bind_param($stmt, "s", $sharedUserid);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						}
						if($stmt = mysqli_prepare($db, "delete from users where userid=?")) {
							mysqli_stmt_bind_param($stmt, "s", $sharedUserid);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						}
				
						echo "<br>";
						echo "
							<div class=\"alert alert-success\" role=\"alert\">
       							<strong>Success!</strong> Deleted User: $delUser From Collective!
      						</div>";
						echo "<br>";
				
					} else {
						echo "
							<div class=\"alert alert-danger\" role=\"alert\">
       							<strong>Error!</strong> User: $delUser Does Not Exist!
      						</div>";
					}			
				}
			} else {
				echo "
					<div class=\"alert alert-danger\" role=\"alert\">
       					<strong>Error!</strong> Cannot Delete This User: $delUser!
      				</div>";
			}				
		} else {
			echo "Permission Denied: No Access for user";
			echo "<br>";
		}
	break;
	
	
	// This just displays all users
	case "92":
		if(isAdmin()){
		
			echo "
				<div class=\"panel panel-success\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Current Users</h3>
            	</div>
            	<div class=\"panel-body\">
            	<div>
            		<table class=\"table table-striped\">
            			<thead>
              				<tr>
                				<th> </th>
                				<th>Username</th>
              				</tr>
            			</thead>
            		<tbody>";
            	
			$counterUsers=1;
  			$query="select username from users";
  			$result=mysqli_query($db, $query);
  			while($row=mysqli_fetch_row($result))  {
				echo"<tr>
						<td> $counterUsers </td>
						<td> $row[0] </td>
					</tr>\n";
				$counterUsers=$counterUsers+1;
			}
  			echo "
  						</tbody>
         			</table>
         		</div>
  				<br>
				<br>
				</div>
          		</div>";
			
			
		} else {
			echo "Permission Denied: No Access for user";
			echo "<br>";
		}
	break;
	
	
	// Shows admin and user failed logins
	case "95":
		if(isAdmin()){
		
			echo "
				<div class=\"panel panel-warning\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Failed Admin Logins</h3>
            	</div>
            	<div class=\"panel-body\">
					<table><tr><td><b><u> Failed Admin User Logins In Last 1 Hour </u></b></td></tr>\n
					<tr><td> IP </td><td>  </td><td> count(IP) </td><td> Admin User </td></tr>\n";
  			
  			$query2="select ip,count(ip),user from login where user='admin' and action='fail' and date > DATE_SUB(NOW(),INTERVAL 1 HOUR)";
			$result2=mysqli_query($db, $query2);
			while($row2=mysqli_fetch_row($result2))  {
				echo"<tr><td> $row2[0] </td><td>  </td><td> $row2[1] </td><td> $row2[2] </td></tr>\n";
			}
  			echo "
  				</table>
  				</div>
  				</div>";		
		
			echo "<br><br>";
			
			echo "
				<div class=\"panel panel-warning\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">All Failed Logins</h3>
            	</div>
            	<div class=\"panel-body\">
					<table><tr><td><b><u> Display Log </u></b></td></tr>\n";
  			$query="select * from login where action='fail'";
  			$result=mysqli_query($db, $query);
  			while($row=mysqli_fetch_row($result))  {
				echo"<tr><td> $row[1] </td><td> $row[2] </td><td> $row[3] </td><td> $row[4] </td></tr>\n";
			}
  			echo "
  				</table>
  				</div>
  				</div>";
			
			
		} else {
			echo "Permission Denied: No Access for user";
			echo "<br>";
		}
	break;
	
	
	// Form to add or del ip to/from whitelist
	case "96":
		if(isAdmin()){
			echo "
				<div class=\"panel panel-success\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Add IP To Whitelist</h3>
            	</div>
            	<div class=\"panel-body\">
					<form method=\"post\" action=\"add.php\" id=\"addIpForm\">
						<table>
							<tbody>
								<tr>
									<td colspan=\"2\"> Add IP to Whitelist </td>
								</tr>
								<tr>
									<td> IP: </td>
									<td><input type=\"text\" name=\"whiteIP\" value=\"\"></td>
								</tr>
							</tbody>
						</table>
					</form>
				<button type=\"submit\" form=\"addIpForm\" class=\"btn btn-success\" value=\"97\" name=\"s\" >Add IP</button>
				<br>
				<br>
				</div>
          		</div>";
			
  			
  			echo "<br><br>";
  			
  			echo "
  				<div class=\"panel panel-danger\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Delete IP From Whitelist</h3>
            	</div>
            	<div class=\"panel-body\">
  				<form method=\"post\" action=\"add.php\" id=\"delIpForm\">
					<table>
						<tbody>
							<tr>
								<td colspan=\"2\"> Delete IP from Whitelist </td>
							</tr>
							<tr>
								<td> IP: </td>
								<td><input type=\"text\" name=\"delwhiteIP\" value=\"\"></td>
							</tr>
						</tbody>
					</table>
				</form>
				<button type=\"submit\" form=\"delIpForm\" class=\"btn btn-danger\" value=\"97\" name=\"s\" >Delete IP</button>
				
				<br>
				<br>
				</div>
          		</div>";
        		
        	echo "<br><br>";	
			
			echo "
				<div class=\"panel panel-primary\">
           		<div class=\"panel-heading\">
            		<h3 class=\"panel-title\">Whitelist</h3>
            	</div>
            	<div class=\"panel-body\">
				<table><tr><td><b><u> IP Whitelist </u></b></td></tr>\n";
  				$query="select * from whitelist";
  				$result=mysqli_query($db, $query);
  				while($row=mysqli_fetch_row($result))  {
					echo"<tr><td> $row[1] </td></tr>\n";
				}
  			echo "
  				</table>
  				<br>
				<br>
				</div>
          		</div>";
			
		} else {
			echo "Permission Denied: No Access for user";
			echo "<br>";
		}
	break;
	
	
	// This adds or deletes the whitelist ips from the database
	case "97":
		if(isAdmin()){
			$whiteIP=mysqli_real_escape_string($db,$whiteIP);
			
			if($stmt = mysqli_prepare($db, "insert into whitelist set whitelistid='',ip=?")) {
				mysqli_stmt_bind_param($stmt, "s", $whiteIP);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
			if($whiteIP != ''){
				echo "
					<div class=\"alert alert-success\" role=\"alert\">
       					<strong>Success!</strong> IP $whiteIP Has Been Added To The Whitelist
      				</div>";
			}
			
			echo "<br><br>";

  			$delwhiteIP=mysqli_real_escape_string($db,$delwhiteIP);
			
			if($stmt = mysqli_prepare($db, "delete from whitelist where ip=?")) {
				mysqli_stmt_bind_param($stmt, "s", $delwhiteIP);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
			if($delwhiteIP != '') {
				echo "
					<div class=\"alert alert-warning\" role=\"alert\">
       					<strong>Warning!</strong> IP $delwhiteIP Has Been Removed From The Whitelist
      				</div>";
			}
			
		} else {
			echo "Permission Denied: No Access for user";
			echo "<br>";
		}
	break;
	
	
	case "99":
		session_destroy();
		header("Location: /collective/login.php");
	break;
		
}

echo"</center>";
include_once "/var/www/html/collective/footer.php";
?>
