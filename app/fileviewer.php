<?php
$hide = array(
				'public_html',				
				'index.php',
				'Thumbs',
				'fileviewer.php',
				'.htaccess',
				'.htpasswd',
				'.',
				'aviabletoview'
			);		
$filetypes = array (
				'png' => 'jpg.gif',
				'jpeg' => 'jpg.gif',
				'bmp' => 'jpg.gif',
				'jpg' => 'jpg.gif', 
				'psd' => 'jpg.gif',
				'gif' => 'gif.gif',
				'zip' => 'archive.png',
				'rar' => 'archive.png',
				'gz' => 'archive.png',
				'7z' => 'archive.png',
				'exe' => 'exe.gif',
				'txt' => 'text.png',
				'htm' => 'html.gif',
				'html' => 'html.gif',
				'php' => 'php.gif',				
				'fla' => 'fla.gif',
				'swf' => 'fla.gif',
				'xls' => 'xls.gif',
				'xlsx'=> 'xls.gif',
				'doc' => 'doc.gif',
				'docx'=> 'doc.gif',
				'pdf' => 'pdf.gif',
				'mov' => 'video.gif',
				'avi' => 'video.gif',
				'mp4' => 'video.gif',
				'dirup'=>'dirup.png',
				'dir' => 'folder.png'				
			);
			
if(!function_exists('imagecreatetruecolor')) $showthumbnails = false;

if(!function_exists("scandir")) { 
    function scandir($dir) { 
        $dh  = opendir($dir); 
        while (false !== ($filename = readdir($dh))) 
            $files[] = $filename; 
        return $files; 
    } 
} 

function ch($c){
		if($c == 'b') $c = 'w';
		else if($c == 'w') $c = 'b';
		return $c;
	}
function ViewSize($s) { 
		if($s >= 1073741824) 
			return sprintf('%1.2f', $s / 1073741824 ). ' GB'; 
		elseif($s >= 1048576) 
			return sprintf('%1.2f', $s / 1048576 ) . ' MB'; 
		elseif($s >= 1024) 
			return sprintf('%1.2f', $s / 1024 ) . ' KB'; 
		elseif($s >= 25)
			return $s . ' B'; 
		else
			return $s*8 . ' b';
     }

?>
 <div id="listingcontainer"><a href="/fileview">[home]</a>
    <div id="listingheader">
	<div id="headerfile">File</div>
	<div id="headersize">Size</div>
	<div id="headermodified">Last Modified</div>
	</div>
    <div id="listing">


<?php
	
	$class = 'w';
	$hwd = getcwd()."/storage/public/";
	if(isset($_GET['show']))
		$dir = $hwd.$_GET['show'];
	else
		$dir = $hwd; //standartd dir
	foreach(scandir($dir) as $a){
		if(in_array($a,$hide)) continue;
		if(!in_array('aviabletoview', scandir($dir))){
			noperms();
			break;
		}
		$class = ch($class);
		if($a == ".."){
			if($dir == $hwd) continue;
			$cdate = "--";
			$cfsize = "--";
			$type = $filetypes['dirup'];
			$url = $_GET['show']."/../";
		}else{
			$cdate = date("M d Y h:i:s A", filemtime($dir."/".$a));
			$cfsize = ViewSize(filesize($dir."/".$a));
			$type = is_dir($dir."/".$a) ? $filetypes['dir'] : $filetypes[array_pop(explode(".",$a))];
			$url = $a;
		}
		echo "<div><a href=\"?show=$url\" class=\"$class\" ><img src=\"/styles/filetypes/$type\"/><strong>$a</strong><em>$cfsize</em>$cdate</a></div>	";
	}
?>		

</div>
</div>
</center>
  </div>
</div>
</div>
</body>
</html>
