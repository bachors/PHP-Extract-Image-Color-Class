<style>
.form{width:100%;display:block;text-align:center}.form input{width:300px}pre{padding:5px}.pre{background:#f5f5f5;overflow:auto;float:left}.pre,.output{width:47%;display:inline-block}.output{height:300px;overflow:hidden}.output img{width:auto;max-width:150px;float:right}.output div{height:100%;overflow:auto}td{padding:5px;border:1px solid #ccc}.color{width:50px}
</style>

<script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=desert"></script>

<?php
	include_once('lib/ImageColor.php');
	$image = new ImageColor();
?>

<h2 align="center">PHP Extract Image Color Class</h2>
<pre class="prettyprint">&lt;?php

    include_once('ImageColor.php');
    
    $image = new ImageColor();
	
    // Number of colors. Default null
    $number = 5; 
    
    // internal image
    $color1 = $image-&gt;path('dir/bird.png'); // show all colors
    print_r($color1);
    
    // external image
    $color2 = $image-&gt;url('http://host.com/image/cat.jpg', $number); // show 5 colors
    print_r($color2);
    
?&gt;</pre>

<?php
	$color1 = $image->path('img/test.jpg');
	$color2 = $image->path('img/test2.gif');
	$color3 = $image->path('img/test3.png');
	$color4 = $image->path('img/test4.jpg', 5);
?>
<div class="output">
	<img src="img/test.jpg"/>
	<div>
		<table>
			<tr><td>color</td><td>hex</td><td>rgb</td><td>percentage</td></tr>
			<?php
				foreach($color1['data'] as $c){
					echo '<tr><td class="color" style="background:#' . $c['hex'] . '"></td><td>#' . $c['hex'] . '</td><td>' . implode(',', $c['rgb']) . '</td><td>' . $c['percentage'] . '</td></tr>';
				}
			?>
		</table>
	</div>
</div>

<div class="output">
	<img src="img/test2.gif"/>
	<div>
		<table>
			<tr><td>color</td><td>hex</td><td>rgb</td><td>percentage</td></tr>
			<?php
				foreach($color2['data'] as $c){
					echo '<tr><td class="color" style="background:#' . $c['hex'] . '"></td><td>#' . $c['hex'] . '</td><td>' . implode(',', $c['rgb']) . '</td><td>' . $c['percentage'] . '</td></tr>';
				}
			?>
		</table>
	</div>
</div>

<div class="output">
	<img src="img/test3.png"/>
	<div>
		<table>
			<tr><td>color</td><td>hex</td><td>rgb</td><td>percentage</td></tr>
			<?php
				foreach($color3['data'] as $c){
					echo '<tr><td class="color" style="background:#' . $c['hex'] . '"></td><td>#' . $c['hex'] . '</td><td>' . implode(',', $c['rgb']) . '</td><td>' . $c['percentage'] . '</td></tr>';
				}
			?>
		</table>
	</div>
</div>

<div class="output">
	<img src="img/test4.jpg"/>
	<div>
		<table>
			<tr><td>color</td><td>hex</td><td>rgb</td><td>percentage</td></tr>
			<?php
				foreach($color4['data'] as $c){
					echo '<tr><td class="color" style="background:#' . $c['hex'] . '"></td><td>#' . $c['hex'] . '</td><td>' . implode(',', $c['rgb']) . '</td><td>' . $c['percentage'] . '</td></tr>';
				}
			?>
		</table>
	</div>
</div>

<h1 align="center">DEMO</h1>
<div class="form">
	<form action="" method="POST">
		URL:<br>
		<input type="url" name="url" value="http://designwoop.com/uploads/2015/01/23-alarm-material-ui-design-app.jpg"/><br>
		Number of colors:<br>
		<input type="number" name="num" value="8"/><br>
		<button type="submit">GetColor</button>
	</form>
</div>
<hr>

<?php
	$num   = (!isset($_POST['num']) ? 8 : $_POST['num']);
	$url   = (empty($_POST['url']) ? 'http://designwoop.com/uploads/2015/01/23-alarm-material-ui-design-app.jpg' : $_POST['url']);
	$color = $image->url($url, $num);
	echo '<pre class="pre">';
	print_r($color);
	echo '</pre>';
	if($color['status'] == 'success'){
?>

<div class="output">
	<img src="<?php echo $url; ?>"/>
	<div>
		<table>
			<tr><td>color</td><td>hex</td><td>rgb</td><td>percentage</td></tr>
			<?php
				foreach($color['data'] as $c){
					echo '<tr><td class="color" style="background:#' . $c['hex'] . '"></td><td>#' . $c['hex'] . '</td><td>' . implode(',', $c['rgb']) . '</td><td>' . $c['percentage'] . '</td></tr>';
				}
			?>
		</table>
	</div>
</div>

<?php
	}
?>
