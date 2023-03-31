<?php echo '<?xml version="1.0" encoding="UTF-8"?>';
    $currentKeywordsFile = $this->getSettings()['keywordsFolder'].HTTP_HOST.'.txt';
    $keywordsPerMap = $this->getSettings()['keywordsPerMap'];
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach (fileReadLines($currentKeywordsFile, $currentPage * $keywordsPerMap, $keywordsPerMap) as $keyword): ?>
	<url>
		<loc><?php echo $this->getBaseUrl().$this->getUrl('post', ['keyword' => $this->toUrl($keyword)]); ?></loc>
		<lastmod><?php echo date('c', filemtime($currentKeywordsFile)); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<?php endforeach; ?>
</urlset>