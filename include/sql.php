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

  function mqesc($mixed)
  {
    if(is_array($buf))
    {
      reset($mixed);

      while(list($key,$value) = each($mixed))
        $mixed[$key] = mysql_real_escape_string($value);
    }
    else
      $mixed = mysql_real_escape_string($mixed);
    return $mixed;
  }

  class CSQL {
    var $sqlSettings;
    var $theQuery;
    var $link;

    function CSQL(&$settings) {
      $this->sqlSettings  =& $GLOBALS['sqlSettings'];
      $opened = false;
    }

    function open() {
      if(!function_exists("mysql_connect")) return false;

      $this->link = mysql_connect($this->sqlSettings['dbHost'], $this->sqlSettings['dbUsername'], $this->sqlSettings['dbPassword']) or die("Error: Cannot connect to the database.");

      mysql_select_db($this->sqlSettings['dbName']) or die("Error: Cannot connect to " . $this->sqlSettings['dbName'] . ".");

      $opened = true;

      return $opened;
    }

    function close() {
      if(!function_exists("mysql_close")) return false;

      mysql_close($this->link);

      $opened = false;

      return $opened;
    }
  }

  class CQuery {
    function query($query) {
      $this->theQuery = $query;

      if(!function_exists("mysql_query")) return false;
      return mysql_query($query);
    }

    function fetcharray($result) {
      if(!function_exists("mysql_fetch_array")) return false;
      return mysql_fetch_array($result);
    }

    function fetchrow($result) {
      if(!function_exists("mysql_fetch_row")) return false;
      return mysql_fetch_row($result);
    }

    function fetchassoc($result) {
      if(!function_exists("mysql_fetch_assoc")) return false;
      return mysql_fetch_assoc($result);
    }

    function numrows($result) {
      if(!function_exists("mysql_num_rows")) return false;
      return mysql_num_rows($result);
    }

    function freeresult($result) {
      if(!function_exists("mysql_free_result")) return false;
      return mysql_free_result($result);
    }
  }
?>
