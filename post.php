<?php
	// ботстат
    include(dirname(__FILE__).'/includes.php');

	// есть ли ключ в файле домена
    if (stripos(file_get_contents('data/'.HTTP_HOST.'.txt'), $keyword) !== false) {
    } else {
        header('HTTP/1.1 404 Not Found');
        include '404.php';
        exit();
    }
	
	// ключ кэша
    $ckey = $this->getHttpHost();

	// псевдорандом
    // srand(__CHECKSUM__);
	
	// тайтл
    $ctitle = $this->randomizeText('{Online comics|Free comics|Graphic novels|DC/Marvel comics|Manga|Science fiction/fantasy comics|Comics for kids/teens|Superhero comics|Historical comics|Romance comics|Action comics|Adventure comics|Horror comics|Humorous comics|Independent comics|Webcomics|Comic book series|Comic book artists|Digital comics|Comic book reviews|Comic book news|Comic book conventions|Comic book collecting|Comic book characters|Comic book movies|Comic book TV shows|Comic book merchandise|Comic book publishers|Comic book events|Comic book auctions|Online comics|Free comics online|Digital comics|Read comics online|Webcomics|Comic strips online|Best online comics|Top digital comics|Popular online comics|New comics online|Free webcomics|Best webcomics|Online manga|Free manga online|Digital manga|Read manga online|Best online manga|Popular online manga|New manga online|Free comic books online|Best comic books online|Digital comic books|Read comic books online|Popular comic books online|New comic books online|Free graphic novels online|Best graphic novels online|Digital graphic novels|Read graphic novels online|Popular graphic novels online|New graphic novels online|Online comic book store|Online comic book community|Online comic book forum|Online comic book news|Online comic book reviews|Online comic book resources|Online comic book subscriptions|Online comic book sales|Online comic book auctions|Online comic book events|Online comic book conventions|Online comic book signings|Online comic book giveaways|Online comic book contests|Online comic book fan art|Online comic book cosplay|Online comic book podcasts|Online comic book merchandise|Online comic book movies and TV shows|Free comics|Download free comics|Free comic books|Read free comics online|Best free comics|Free digital comics|Free comic strips|Free webcomics|Free comic book series|Free comic book artists|Free comic book reviews|Free comic book news|Free comic book resources|Free comic book downloads|Free comic book apps|Free comic book reader|Free comic book website|Free comic book community|Free comic book forum|Free comic book giveaways|Free comic book contests|Free comic book samples|Free comic book previews|Free comic book subscriptions|Free comic book sales|Free comic book auctions|Free comic book events}', $keyword).' '.ucwords($keyword);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $ctitle ?></title>
	<?php echo $this->addMetaTags(); ?>
	<meta name="robots" content="noarchive" />
	<?php $this->startCache('{$ckey}.fav', 0);?><link rel="shortcut icon" href="/images/<?php echo rand(1, 99);?>.png" type="image/png"><?php $this->endCache(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />

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
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2"></div>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article id="content" class="w-full flex flex-col shadow my-4">
                <div class="bg-white flex flex-col justify-start p-6">
					<h1 class="text-3xl font-bold hover:text-gray-700 pb-4"><?php echo ucwords($keyword); ?></h1>
					<h2 class="text-3xl font-bold hover:text-gray-700 pb-4">Content</h2>
					<div id="toc" class="pb-3 pt-3"></div>
					<?php 
						echo $this->getSnippets();
					?>
					<h2 class="text-3xl font-bold hover:text-gray-700 pb-4 pt-4">Video</h2>
					
					<?php $videosUrls = $this->getBingYoutubeVideos(); ?>
					<?php echo $this->getPlayer($videosUrls[0]); ?>
					
					<h2 class="text-3xl font-bold hover:text-gray-700 pb-4 pt-4">Suggestion</h2>
					
					<ul> 
						<?php foreach($this->getDuckSuggests() as $suggest): ?> 
						<li><?php echo $suggest; ?></li> 
						<?php endforeach; ?> 
					</ul> 

                </div>
            </article>

            <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
                <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                    <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1" class="rounded-full shadow h-32 w-32">
                </div>
                <div class="flex-1 flex flex-col justify-center md:justify-start">
                    <p class="font-semibold text-2xl">Author name</p>
                    <p class="pt-2">Author Description</p>
                    <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                        <a class="" href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
			
			<div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 items-center p-3">
				<div class="flex-1 flex flex-col justify-center md:justify-start">
					<p class="text-3xl font-bold hover:text-gray-700 pb-4">Related articles</p>
					<ul class="bg-white rounded-lg w-full text-gray-900">
						<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
						<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
						<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
						<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
						<div class ="pb-2"><li class="hover:bg-gray-100 hover:text-gray-500 px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"><i class="fas fa-newspaper"></i> <?php echo $this->getDomainRandomLinksKW('post', 1); ?></li><hr></div>
					</ul>
				</div>
			</div>

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
<script>
window.onload = function () {
    var toc = "";
    var level = 0;

    document.getElementById("content").innerHTML =
        document.getElementById("content").innerHTML.replace(
            /<h([\d])>([^<]+)<\/h([\d])>/gi,
            function (str, openLevel, titleText, closeLevel) {
                if (openLevel != closeLevel) {
                    return str;
                }

                if (openLevel > level) {
                    toc += (new Array(openLevel - level + 1)).join("<ul class=\"list-decimal ml-2 bg-gray-100 pb-3 pt-3 pl-3\">");
                } else if (openLevel < level) {
                    toc += (new Array(level - openLevel + 1)).join("</ul>");
                }

                level = parseInt(openLevel);

                var anchor = titleText.replace(/ /g, "_");
                toc += "<li><a href=\"#" + anchor + "\">" + titleText
                    + "</a></li>";

                return "<h" + openLevel + " class=\"text-3xl font-normal leading-normal mt-0 mb-2 text-pink-800\"><a name=\"" + anchor + "\">"
                    + titleText + "</a></h" + closeLevel + ">";
            }
        );

    if (level) {
        toc += (new Array(level + 1)).join("</ul>");
    }

    document.getElementById("toc").innerHTML += toc;
};
</script>
</body>
</html>