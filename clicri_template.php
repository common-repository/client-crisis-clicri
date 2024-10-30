<?php
/**
 * CliCri Template
 * File: clicri_template.php
 *
 */

wp_head();

?>

<style type="text/css">
	
body {
	background: #000;
	color: #bbbbbb;
	font-family: sans-serif;
	line-height: 1.5;
}

div.clicri_container {
	width: 80%;
	margin: auto;
}

p {
	display: block;
}

img {
	width: auto;
	height: auto;
	max-width: 100%;
}

img.alignleft {
	float: left;
	padding: 0px 20px 20px 0px;
}

img.alignright {
	float: right;
	padding: 0px 0px 20px 20px;
}

img.aligncenter {
	display: block;
	margin: auto;
	padding: 20px;
}

img.alignnone {
	display: block;
	margin: auto;
	padding: 20px;
}

</style>

<div class="clicri_container">
	
	<h1><?php echo do_shortcode('[clipri-header]'); ?></h1>
	
	<?php echo wpautop(do_shortcode('[clipri-body]')); ?>
	
</div>