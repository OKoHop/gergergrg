<?php
    echo '<?xml version="1.0" encoding="UTF-8"?>';

    $currentKeywordsFile = $this->getSettings()['keywordsFolder'].HTTP_HOST.'.txt';
    $keywordsPerMap = $this->getSettings()['keywordsPerMap'];

    $totalSitePages = fileLinesCount($currentKeywordsFile);

    $totalSitemapPages = ceil($totalSitePages/$keywordsPerMap);
?>
<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84">
	<?php for ($i=0; $i < $totalSitemapPages; $i++): ?>
	<sitemap>
		<loc><?php echo $this->getBaseUrl().'/sitemap-'.$i.'.xml'; ?></loc>
		<lastmod><?php echo date('c', filemtime($currentKeywordsFile)); ?></lastmod>
	</sitemap>
	<?php endfor; ?>
</sitemapindex>
