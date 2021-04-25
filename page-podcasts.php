<?php
/**
Template for displaying front page
 */

get_header();
?>

<template>
    <article>
        <img src="" alt="">
        <h2></h2>
    </article>
</template>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section id="primary" class="content-area"></section>
        <nav id="filtrering"><button data-podcasts="alle">Alle</button></nav>

        <section id="podcastcontainer"></section>

    </main><!-- #main -->

    <script>
        let podcasts;
        let categories;
        let filterPodcast = "alle";
        const dbUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/podcasts?per_page=100";

        const catUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/categories";


        async function getJson() {
            const data = await fetch(dbUrl);
            const catdata = await fetch(catUrl);
            podcasts = await data.json();
            categories = await catdata.json();
            visPodcasts();
            opretKnapper();

        }


        function opretKnapper() {

            categories.forEach(cat => {
                document.querySelector("#filtrering").innerHTML += `<button class="filter" data-podcast="${cat.id}">${cat.name}</button>`
            })

            addEventListenerToButtons();

        }

        function addEventListenerToButtons() {
            document.querySelectorAll("#filtrering button").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
        }

        function filtrering() {
            filterPodcast = this.dataset.podcast;
            console.log(filterPodcast);

            visPodcasts();


        }

        function visPodcasts() {
            let temp = document.querySelector("template");
            let container = document.querySelector("#podcastcontainer")
            container.innerHTML = "";
            podcasts.forEach(podcast => {
                if (filterPodcast == "alle" || podcast.categories.includes(parseInt(filterPodcast))) {

                    let klon = temp.cloneNode(true).content;
                    klon.querySelector("img").src = podcast.billede.guid;
                    klon.querySelector("h2").innerHTML = podcast.title.rendered;

                    klon.querySelector("article").addEventListener("click", () => {
                        location.href = podcast.link;


                    })
                    container.appendChild(klon);
                }
            })

        }

        getJson();

    </script>


</div><!-- #primary -->

<?php
get_footer();
