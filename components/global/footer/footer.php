<?php
$site_settings = [
	"ajax" => get_home_url() . "/wp-admin/admin-ajax.php",
];
?>
<script>
	var siteSettings = <?php echo json_encode($site_settings); ?>
</script>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/js/jquery.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/js/lity.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/js/main.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/js/<?php echo $page_settings->type[0]; ?>.min.js?ver=<?php echo $version; ?>"></script>
</body>
</html>