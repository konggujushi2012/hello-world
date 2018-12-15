<?php
function get_images(&$all_imgs)
{
	echo "get_images\n";
	$text = '<img class="alignnone size-medium wp-image-13" src="http://localhost/wordpress/wp-content/uploads/2018/11/text02-300x200.jpg" alt="" width="300" height="200" /> 我是中国人
	<img class="alignnone size-medium wp-image-13" src="http://localhost/wordpress/wp-content/uploads/2018/11/text02-300x200.jpg" alt="" width="300" height="200" />';

	$output = preg_match_all('/<img\s.*src=[\'"]([^\'"]*)[\'"].+\/>/i', $text, $matches);
	
	print_r($matches);

	$all_imgs = $matches;

}
	
?>

<?php get_images($all_imgs); ?>
<?php foreach($all_imgs[1] as $value){ ?>
	<p><?php echo $value; ?></p>
<?php } ?>