<?php
#author: Joseph Parks joseph.parks@colorado.edu
#name: lib.php
#purpose: Securing Story Sharing
#date: 2018-5-1
#version: 0.1

isset($_REQUEST['s']) ? $s=strip_tags($_REQUEST['s']) : $s="";

isset($_REQUEST['postUser']) ? $postUser=strip_tags($_REQUEST['postUser']) : $postUser="";
isset($_REQUEST['postPass']) ? $postPass=$_REQUEST['postPass'] : $postPass="";

isset($_REQUEST['newUser']) ? $newUser=strip_tags($_REQUEST['newUser']) : $newUser="";
isset($_REQUEST['newPass']) ? $newPass=$_REQUEST['newPass'] : $newPass="";
isset($_REQUEST['newEmail']) ? $newEmail=strip_tags($_REQUEST['newEmail']) : $newEmail="";

isset($_REQUEST['oldUser']) ? $oldUser=strip_tags($_REQUEST['oldUser']) : $oldUser="";
isset($_REQUEST['upPass']) ? $upPass=$_REQUEST['upPass'] : $upPass="";

isset($_REQUEST['count']) ? $count=$_REQUEST['count'] : $count="";
isset($_REQUEST['countIP']) ? $countIP=$_REQUEST['countIP'] : $countIP="";
isset($_REQUEST['whiteIP']) ? $whiteIP=$_REQUEST['whiteIP'] : $whiteIP="";
isset($_REQUEST['delwhiteIP']) ? $delwhiteIP=$_REQUEST['delwhiteIP'] : $delwhiteIP="";

isset($_REQUEST['postPeer']) ? $postPeer=strip_tags($_REQUEST['postPeer']) : $postPeer="";
isset($_REQUEST['peer']) ? $peer=strip_tags($_REQUEST['peer']) : $peer="";
isset($_REQUEST['username']) ? $username=strip_tags($_REQUEST['username']) : $username="";
isset($_REQUEST['thisUserid']) ? $thisUserid=strip_tags($_REQUEST['thisUserid']) : $thisUserid="";
isset($_REQUEST['story']) ? $story=strip_tags($_REQUEST['story']) : $story="";
isset($_REQUEST['estory']) ? $estory=strip_tags($_REQUEST['estory']) : $estory="";
isset($_REQUEST['sharedUsername']) ? $sharedUsername=strip_tags($_REQUEST['sharedUsername']) : $sharedUsername="";
isset($_REQUEST['sharedUserid']) ? $sharedUserid=strip_tags($_REQUEST['sharedUserid']) : $sharedUserid="";
isset($_REQUEST['thisUsername']) ? $thisUsername=strip_tags($_REQUEST['thisUsername']) : $thisUsername="";
isset($_REQUEST['delPeer']) ? $delPeer=strip_tags($_REQUEST['delPeer']) : $delPeer="";
isset($_REQUEST['delUser']) ? $delUser=strip_tags($_REQUEST['delUser']) : $delUser="";
isset($_REQUEST['thisUser']) ? $thisUser=strip_tags($_REQUEST['thisUser']) : $thisUser="";


function connect(){
    $mycnf="/etc/collective.conf";
    if (!file_exists($mycnf)) {
    	echo "Error database config file not found: $mycnf";
    	exit;
    }
    
	$mysql_ini_array=parse_ini_file($mycnf);
	$db_host=$mysql_ini_array["host"];
  	$db_user=$mysql_ini_array["user"];
  	$db_pass=$mysql_ini_array["pass"];
  	$db_port=$mysql_ini_array["port"];
  	$db_name=$mysql_ini_array["dbName"];
  	$db=mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
  	if(!$db){
    	print "Error connecting to database: ".mysqli_connect_error();
    	exit;
  	}
 	return $db;
}


function checkInput($input) {
	if($input != null) {
		if(!is_numeric($input)) {
			echo "<b> Error: </b> Invalid syntax.";
			exit;
		}
	}	
}


function authenticate($db,$postUser,$postPass) {
	checkAuth($db,$postUser,$_SERVER['REMOTE_ADDR']);
	
	$query="select userid, email, password, salt from users where username=?";
	
	if($stmt=mysqli_prepare($db,$query)) {
		mysqli_stmt_bind_param($stmt, "s", $postUser);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$userid,$email,$password,$salt);
		while(mysqli_stmt_fetch($stmt)) {
			$userid=$userid;
			$email=$email;
			$password=$password;
			$salt=$salt;
		}
		mysqli_stmt_close($stmt);
		$epass=hash('sha256',$postPass.$salt);
		if($epass == $password) {
			// Regenerate Session ID
			session_regenerate_id();
			$_SESSION['userid']=$userid;
			$_SESSION['email']=$email;
			$_SESSION['authenticated']="yes";
			$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
			
			$_SESSION['HTTP_USER_AGENT']=md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
			$_SESSION['created']=time();
			
			// Record Login
			if($stmt = mysqli_prepare($db, "insert into login set loginid='', ip=?, user=?, date=NOW(), action='pass'")) {
				mysqli_stmt_bind_param($stmt, "ss", $_SERVER['REMOTE_ADDR'],$postUser);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		} else {
			// Record Login
			if($stmt = mysqli_prepare($db, "insert into login set loginid='', ip=?, user=?, date=NOW(), action='fail'")) {
				mysqli_stmt_bind_param($stmt, "ss", $_SERVER['REMOTE_ADDR'],$postUser);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
			header("Location: /collective/login.php");
			exit;
		}
	}
}


function addUser($db,$newUser,$epass,$salt,$newEmail) {
	if($stmt = mysqli_prepare($db, "insert into users set userid='', username=?, password=?, salt=?, email=?")) {
			mysqli_stmt_bind_param($stmt, "ssss", $newUser,$epass,$salt,$newEmail);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
}


function getThisUser($db,$thisUserid) {
	$query="select username from users where userid=?";
	
	if($stmt=mysqli_prepare($db,$query)) {
		mysqli_stmt_bind_param($stmt, "s", $thisUserid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$username);
		while(mysqli_stmt_fetch($stmt)) {
			$username=$username;		
		}
	}
	return $username;
}


function extendedAuth() {
	// Check if user agent is the same
	if(isset($_SESSION['HTTP_USER_AGENT'])) {
		if($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'])) {
			logout();
		}
	} else {
		logout();
	}
	
	// Check Sessions IP, make sure it has not changed
	if(isset($_SESSION['ip'])) {
		if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
			logout();
		}
	} else {
		logout();
	}
	
	// Session timeout
	if(isset($_SESSION['created'])) {
		if(time() - $_SESSION['created'] > 1800) {
			logout();
		}
	} else {
		logout();
	}
	
	// Check HTTP origin
	if("POST" == $_SERVER["REQUEST_METHOD"]) {
		if(isset($_SERVER["HTTP_ORIGIN"])) {
			if($_SERVER["HTTP_ORIGIN"] != "https://100.66.1.18") {
				logout();
			}
		} else {
			logout();
		}
	}
}


function isAdmin() {
	if($_SESSION['userid'] == 1) {
		return True;
	} else {
		return False;
	}	
}


// Found this function at (https://codereview.stackexchange.com/questions/92869/php-salt-generator)
function makeSalt() {
     $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
     $randString = "";
     $randStringLen = 64;

     while(strlen($randString) < $randStringLen) {
         $randChar = substr(str_shuffle($charset), mt_rand(0, strlen($charset)), 1);
         $randString .= $randChar;
     }
     return $randString;
}


function isAuth() {
	if(isset($_SESSION['authenticated'])) {
		return True;
	} else {
		return False;
	}
} 


function checkAuth($db,$postUser,$ip) { 	
	$query="select ip,count(ip) from login where user=? and action='fail' and date > DATE_SUB(NOW(),INTERVAL 1 HOUR)";
	
	if($stmt=mysqli_prepare($db,$query)) {
		mysqli_stmt_bind_param($stmt, "s", $postUser);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$ip,$count);
		while(mysqli_stmt_fetch($stmt)) {
			$ip=$ip;
			$count=$count;
		}
		mysqli_stmt_close($stmt);
	}
	
	if($count >= '5') {
		$query="select count(ip) from whitelist where ip=?";
	
		if($stmt=mysqli_prepare($db,$query)) {
			mysqli_stmt_bind_param($stmt, "s", $ip);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$countIP);
			while(mysqli_stmt_fetch($stmt)) {
			
				$countIP=$countIP;
			}
			mysqli_stmt_close($stmt);
		}
		
		// If IP is not in Whitelist then exit
		if($countIP == 0) {
			//echo " HERE :::  ";
			//error_log("***!!! ERROR !!!***: Tolkien App has failed login from " . $_SERVER['REMOTE_ADDR'], 0);
			exit;
		}
	}	
}


function logout() {
	session_destroy();
	header("Location: /collective/login.php");
	exit;
}


// Encryption/Decryption function
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function encrypt_decrypt($action, $string, $salt) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = $salt;
    $secret_iv = 'This secret iv is global and shared with all users';
    // hash
    $key = hash('sha256', $salt.$secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


function checkIfShared($thisUserid,$peer,$db) {	
	$query="select sharedUsername from sharedWith where userid='$thisUserid'";
	$result=mysqli_query($db, $query);
	while($row=mysqli_fetch_row($result)) {
		$sharedUsername=$row[0];
		
		if($sharedUsername==$peer) {
			return True;
		}
	}
	return False;
} 


function checkThisUser($thisUserid,$testUser,$db) {
	$queryUser="select username from users where userid='$thisUserid'";
	$thisResult=mysqli_query($db, $queryUser);
	while($thisRow=mysqli_fetch_row($thisResult)) {
		$thisUsername=$thisRow[0];
		
		if($thisUsername==$testUser) {
			return True;
		}
	}
	return False;
}


function getThisUsername($thisUserid,$db) {
	$query="select username from users where userid='$thisUserid'";
	$result=mysqli_query($db, $query);
	while($row=mysqli_fetch_row($result)) {
		$thisUsername=$row[0];
	}
	if($thisUsername!=Null) {
		return $thisUsername;
	}
}

?>
