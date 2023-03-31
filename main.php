<?php
	//srand(__CHECKSUM__);
    include(dirname(__FILE__).'/includes.php');
    // Генерация служебных данных
    if (!file_exists('cache/'.$this->getHttpHost().'-sqlite_cache.db')) {
        $currentKeywordsFile = $this->getSettings()['keywordsFolder'].HTTP_HOST.'.txt';
        $totalSitePages = fileLinesCount($currentKeywordsFile);
        foreach (fileReadLines($currentKeywordsFile, 0, $totalSitePages) as $keyword):
            $this->getBaseUrl().$this->getUrl('post', ['keyword' => $this->toUrl($keyword)]);
        endforeach;
    }
    /**/
    // служебные данные для пагинации
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $size_page = $this->getSettings()['size_page'];
    $offset = ($page - 1) * $size_page;
    $file = 'data/'.$this->getHttpHost().'.txt';
    $total_lines = count(file($file));
    $total_pages = ceil($total_lines / $size_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php $this->startCache('{$ckey}.fav', 0);?><link rel="shortcut icon" href="/images/<?php echo rand(1, 99);?>.png" type="image/png"><?php $this->endCache(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $ckey = $this->getHttpHost(); ?>
    <title>TITLE NAME<?php if ($page > 1) {
    echo ' - page '.$page;
} ?></title>

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap');

        .font-family-ubuntu {
            font-family: ubuntu;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>
<body class="bg-white font-family-ubuntu">

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="/">
                <?php echo $this->getHttpHost(); ?>
            </a>
            <p class="text-lg text-gray-600">
                DEMO SITE
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open"
            >
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                <!--<a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Privacy</a>
                <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Contact</a>-->
            </div>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">
			<?php $fileArr = file($file); ?>
			<?php for ($i = $offset; $i < ($offset + $size_page); ++$i) {
					if ($i >= $total_lines) {
						break;
					}
					else {
						echo '<article class="flex flex-col shadow my-4 w-full"><div class="bg-white flex flex-col justify-start p-6">';
						echo '<h2 class="text-3xl font-bold hover:text-gray-700"><a href = "'.$this->getBaseUrl().$this->getUrl('post', ['keyword' => $this->toUrl($fileArr[$i])]).'">'.ucwords($fileArr[$i]).'</a></h2>';
						echo '</div>';
						echo '</article>';
					}
				}
			?>
			
			<?php
				// пагинация
				if($total_pages > 1){
					include(dirname(__FILE__).'/pagination.php');	
				}
			?>

        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Latest posts</p>
                <ul class="bg-white rounded-lg w-full text-gray-900">
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
				</ul>
                <!--<a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>-->
            </div>

        </aside>

    </div>

    <footer class="w-full border-t bg-white pb-12">
        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
                <!--<a href="#" class="uppercase px-3">Privacy</a>
                <a href="#" class="uppercase px-3">Contact</a>-->
            </div>
            <div class="uppercase pb-6">&copy; <?php echo $this->getHttpHost(); ?></div>
        </div>
    </footer>

</body>
</html>