<?php

/************************************************************
 * #### ImageColor.php v0.0.1 ####
 * Coded by Ican Bachors 2017.
 * https://github.com/bachors/PHP-Extract-Image-Color-Class
 * Updates will be posted to this site.
 ************************************************************/

class ImageColor
{

	function __construct()
    {
		$this->max_filesize = 800000; // Maximum filesize of image in bytes. Make sure you keep this below the memory_limit specified in php.ini
	}
	
	public function url($url, $num = null)
	{
		$headers = get_headers($url, 1);
		
		if(strstr($headers[0], '200') !== false) // Checking if the request went OK
		{
			if($headers['Content-Length'] < $this->max_filesize) // Check that the file isn't too big
			{
				if($this->is_image($headers['Content-Type']) !== false) // Makes sure that a content type was specified
				{
					switch($headers['Content-Type'])
					{
						case image_type_to_mime_type(IMAGETYPE_GIF):
							$image = imagecreatefromgif($url);
							break;
						case image_type_to_mime_type(IMAGETYPE_JPEG):
							$image = imagecreatefromjpeg($url);
							break;
						case image_type_to_mime_type(IMAGETYPE_PNG):
							$image = imagecreatefrompng($url);
							break;
						case image_type_to_mime_type(IMAGETYPE_WBMP):
							$image = imagecreatefromwbmp($url);
							break;
						case image_type_to_mime_type(IMAGETYPE_XBM):
							$image = imagecreatefromxbm($url);
							break;
						default:
							die("mime_type not found");
							break;
					}
					
					return $this->extracting($image, $num);
				}
				else
				{
					return $this->error('mime_type (' . $headers['Content-Type'] . '), doesn\'t work');
				}
			}
			else
			{
				return $this->error('Max filesize is ' . round($this->max_filesize / 1024) . 'KB');
			}
		}
		else
		{
			return $this->error('URL ' . $url . ' can not be accessed');
		}
	}
	
	public function path($image, $num = null)
	{
		if (is_readable($image))
		{
			$size = GetImageSize($image);
			if ($size[2] == 1)
			$img = imagecreatefromgif($image);
			if ($size[2] == 2)
			$img = imagecreatefromjpeg($image);
			if ($size[2] == 3)
			$img = imagecreatefrompng($image);
			return $this->extracting($img, $num);
		}
		else
		{
			return $this->error($image . ' does not exist or is unreadable');
		}
	}
	
	public function error($message)
	{
		return array(
			'status'  => 'error',
			'message' => $message
		);
	}
	
	// Check supported file format or not
	private function is_image($content_type)
	{
		switch($content_type)
		{
			case image_type_to_mime_type(IMAGETYPE_GIF):
			case image_type_to_mime_type(IMAGETYPE_JPEG):
			case image_type_to_mime_type(IMAGETYPE_PNG):
			case image_type_to_mime_type(IMAGETYPE_WBMP):
			case image_type_to_mime_type(IMAGETYPE_XBM):
				return true;
				break;
			default:
				return false;
				break;
		}
	}
	
	// Extract image color to rgb & hex
	private function extracting($image, $num)
	{
		$colors = array();
		$result = array();
		
		$result['status'] = 'success';
		
		$width 	= imagesx($image); // width
		$height = imagesy($image); // height
		
		$pixel_color = imagecolorat($image, 1, 1);
		$rgb         = imagecolorsforindex($image, $pixel_color);
		array_push($colors, $rgb['red'].'_'.$rgb['green'].'_'.$rgb['blue']);
		
		// Start looping through pixels working out how bright/colorful they are.
		for($y = 0; $y < $height; $y++)
		{
			for($x = 0; $x < $width; $x++)
			{
				$pixel_color = imagecolorat($image, $x, $y); // Get pixel color at x,y
				$rgb = imagecolorsforindex($image, $pixel_color); // Make the color into an array we can use
				
				$char = $rgb['red'].'_'.$rgb['green'].'_'.$rgb['blue'];
				if(!empty($char)){
					array_push($colors, $char);
				}
			}
		}
		
		imagedestroy($image); // Remove the image from the memory
		
		$count  = count($colors);
		$color 	= array_count_values($colors);
		arsort($color);
		$num  	= ($num != null && !empty($num) ? $num : $color);
		$i 		= 0;
		foreach($color as $key => $val){
			if($i < $num){
				$percentage = ($val / $count) * 100;
				$rgb  = explode('_', $key);
				$hex  = str_pad(dechex($rgb[0]), 2, '0', STR_PAD_LEFT);
				$hex .= str_pad(dechex($rgb[1]), 2, '0', STR_PAD_LEFT);
				$hex .= str_pad(dechex($rgb[2]), 2, '0', STR_PAD_LEFT);
				$result['data'][] = array(
					'hex' => $hex,
					'rgb' => $rgb,
					'percentage' => $percentage
				);
				$i++;
			}
		}
		
		return $result;
	}
	
}

?>
