<?php
	$files = glob("images/*.png");
	foreach($files as $png){
		echo " { // {$png}\n";
		$im = ImageCreateFromPng($png); 

		$imgw = imagesx($im);
		$imgh = imagesy($im);
	
		// reduce to 8x8
		$bw_image = imagecreatetruecolor(8, 8);
		imagecopyresampled($bw_image, $im, 0, 0, 0, 0, 8, 8, $imgw, $imgh);
	
		$dest_imgw = imagesx($bw_image);
		$dest_imgh = imagesy($bw_image);

		for ($i=0; $i<$dest_imgh; $i++)
		{
			echo "  B";
        	for ($j=0; $j<$dest_imgw; $j++)
        	{
            	// get the rgb value for current pixel
            	$rgb = ImageColorAt($bw_image, $j, $i); 
                		
            	// extract each value for r, g, b
            	$rr = ($rgb >> 16) & 0xFF;
            	$gg = ($rgb >> 8) & 0xFF;
            	$bb = $rgb & 0xFF;
                		
            	// get the Value from the RGB value
            	$g = round(($rr + $gg + $bb) / 3);
                		
            	// grayscale values have r=g=b=g
            	// $val = imagecolorallocate($im, $g, $g, $g);
                		
            	// set the gray value
           		// imagesetpixel ($im, $i, $j, $val);
				
				echo $g>20?1:0;
				// if($j<$dest_imgw-1) echo ", ";
        	}
			// echo "},\n";
			if($i<$dest_imgh-1) echo ",";
			// echo "\n";
		}
		echo "}, \n";
	}
?>
