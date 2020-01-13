<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
		 <changefreq>monthly</changefreq>
        <priority>1.0</priority>     
    </url> 
	
	<!-- Sitemap -->
    <?php foreach($data as $item) { ?>
    <url>
        <loc><?php echo base_url()."tutorial/".$item->slug ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
		<?php $originalDate = $item->last_updated;
		$newDate = date("Y-m-d", strtotime($originalDate)); ?>
		 <lastmod><?php echo $newDate; ?></lastmod>
    </url>
    <?php } ?> 
</urlset>