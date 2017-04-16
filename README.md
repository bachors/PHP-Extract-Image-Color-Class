# PHP-Extract-Image-Color-Class
PHP Extract Image Color Class a library to extract the color from internal or external image.

<h3><a href="http://ibacor.com/download/demo/extractImageColor/">LIVE DEMO</a></h3>

<h3>USAGE:</h3>
<pre>
&lt;?php

    include_once('lib/ImageColor.php');
    
    $image = new ImageColor();
	
    // Number of colors. Default null
    $number = 5; 
    
    // internal image
    $color1 = $image-&gt;path('img/test.jpg'); // show all colors
    print_r($color1);
    
    // external image
    $color2 = $image-&gt;url('http://host.com/image/cat.jpg', $number); // show 5 colors
    print_r($color2);

?&gt;
</pre>

<h3>RESULT:</h3>
<pre>
Array
(
    [status] => success
    [data] => Array
        (
            [0] => Array
                (
                    [hex] => 5cffbe
                    [rgb] => Array
                        (
                            [0] => 92
                            [1] => 255
                            [2] => 190
                        )

                    [percentage] => 59.893621672784
                )

            [1] => Array
                (
                    [hex] => 00bcd5
                    [rgb] => Array
                        (
                            [0] => 0
                            [1] => 188
                            [2] => 213
                        )

                    [percentage] => 10.686443707707
                )

            [2] => Array
                (
                    [hex] => ffee4e
                    [rgb] => Array
                        (
                            [0] => 255
                            [1] => 238
                            [2] => 78
                        )

                    [percentage] => 10.623686667473
                )

            [3] => Array
                (
                    [hex] => 0096a5
                    [rgb] => Array
                        (
                            [0] => 0
                            [1] => 150
                            [2] => 165
                        )

                    [percentage] => 1.660489556354
                )

            [4] => Array
                (
                    [hex] => ffffff
                    [rgb] => Array
                        (
                            [0] => 255
                            [1] => 255
                            [2] => 255
                        )

                    [percentage] => 1.5794712462159
                )

            [5] => Array
                (
                    [hex] => ffee4c
                    [rgb] => Array
                        (
                            [0] => 255
                            [1] => 238
                            [2] => 76
                        )

                    [percentage] => 0.5421796754638
                )

            [6] => Array
                (
                    [hex] => ff5152
                    [rgb] => Array
                        (
                            [0] => 255
                            [1] => 81
                            [2] => 82
                        )

                    [percentage] => 0.50359952777899
                )

            [7] => Array
                (
                    [hex] => 5d5d5d
                    [rgb] => Array
                        (
                            [0] => 93
                            [1] => 93
                            [2] => 93
                        )

                    [percentage] => 0.3958323152461
                )

        )

)
</pre>
