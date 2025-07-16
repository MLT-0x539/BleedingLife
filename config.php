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

//dbHost:  The hostname to where your MySQL database is located.
$sqlSettings['dbHost'] = 'localhost';

//dbUsername:  The username for your MySQL database.
$sqlSettings['dbUsername'] = 'bl';

//dbPassword:  The password for your MySQL database.
$sqlSettings['dbPassword'] = 'bl';

//dbName:  The name your MySQL database.
$sqlSettings['dbName'] = 'bl';

//tableVisitorsList:  The table name to track visitors.  This is created in the install process.
$sqlSettings['tableVisitorsList'] = 'visitors_list';

//panel_user: the username used to secure the statistics page
$panel_user = "user";
//panel_pass: the password used to secure the statistics page
$panel_pass = "password";

//enabled_signed: enable the java signed applet.  (this requires user interaction)
$enable_signed = true;

//payload_filename: the filename of your payload.
$payload_filename = 'payload.exe';

//config_url: the url to where your pack is located.  This is very important.  Please make sure it includes the http://
$config_url = 'http://localhost/BleedingLife2Reloaded';

//exploit_delay: this is the delay between exploits in milliseconds.  10 seconds = 10000, 5 seconds = 5000, etc.
$exploit_delay = 5000;

//reuse_iframe:  by default each exploit is created in its own iframe.  set this to true to reuse the same iframe for each exploit
$reuse_iframe = false;

//ajax_stats:  refresh the "Overall Statistics" using ajax.
$ajax_stats = true;

//ajax_delay: this is the delay between refreshing in milliseconds.  10 seconds = 10000, 5 seconds = 5000, etc.
$ajax_delay = 5000;

?>
