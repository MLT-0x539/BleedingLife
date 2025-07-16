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

include("ascii85.php");

function str_to_hex($string)
{
    $hex='';
    for ($i=0; $i < strlen($string); $i++)
    {
        $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT);
    }
    return $hex;
}

function pdf_ASCIIHexEncode($string){
	return str_to_hex($string) . ">";
}
function pdf_FlateEncode($string){
	return gzcompress($string);
}
function pdf_ASCII85Encode($string){
	$ascii85 = new ASCII85();
	return $ascii85->encode($string);
}
function RandomNonASCIIString($count){
		$result = "";
		for($i = 0; $i < $count; $i++){
			$result  = $result . chr(rand(128, 255));
		}
		return $result;
}

function ioDef($id){
		return $id . " 0 obj\r\n";
}

function ioRef($id){
		return $id . " 0 R";
}


?>
