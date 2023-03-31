<?php echo '<?xml version="1.0" encoding="UTF-8"?>';

$currentKeywordsFile = $this->getSettings()['keywordsFolder'].HTTP_HOST.'.txt';
?>
<rss version="2.0">
	<channel>
		<title>OUR RSS CHANNEL</title>
		<link><?php echo $this->getBaseUrl(); ?></link>
		<description>RSS</description>
	<?php foreach (fileReadLines($currentKeywordsFile, 0, 1000) as $keyword): ?>
		<item>
			<title><?php echo $keyword; ?></title>
			<link><?php echo $this->getBaseUrl().$this->getUrl('post', ['keyword' => $this->toUrl($keyword)]); ?></link>
			<description><?php echo $keyword; ?></description>
			<author>admin</author>
			<pubDate><?php echo date('c', filemtime($currentKeywordsFile)); ?></pubDate>
		</item>
	<?php endforeach; ?>
	</channel>
</rss>
