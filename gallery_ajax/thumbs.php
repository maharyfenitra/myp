<?php
$album 		= $_GET['album'];
$imagesArr	= array();
$i		= 0;

/* read the descriptions xml file */
if(file_exists('../gallery_thumbs/'.$album.'/desc.xml')) {
    $xml = simplexml_load_file('../gallery_thumbs/'.$album.'/desc.xml');
}
/* read the images from the album and get the
 * description from the XML file:
 */
if(file_exists('../gallery_thumbs/'.$album)) {
    $files = array_slice(scandir('../gallery_thumbs/'.$album), 2);
    if(count($files)) {
        foreach($files as $file) {
            if($file != '.' && $file != '..' &&  $file!='desc.xml') {
                if($xml) {
                    $desc = $xml->xpath('image[name="'.$file.'"]/text');
                    $description = $desc[0];
                    if($description=='')
                        $description = '';
                }
                $imagesArr[] = array('src' => 'gallery_thumbs/'.$album.'/'.$file,
                    'alt'	=> 'gallery_images/'.$album.'/'.$file,
                    'desc'	=> $description);
            }
        }
    }
}
$json 		= $imagesArr; 
$encoded 	= json_encode($json);
echo $encoded;
unset($encoded);
?>
