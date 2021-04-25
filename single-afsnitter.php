<?php
/**
Template for displaying front page
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">


        <section id="afsnit">
            <template>
                <article>
                    <div>
                        <img src="" alt="" class="afsnit_billede">
                    </div>
                    <div>
                        <h2></h2>
                        <h3></h3>
                        <p class="afsnit_nr"></p>
                        <p class="varighed"></p>
                        <p class="dato"></p>
                        <p class="varighed"></p>
                        <p class="vaerter"></p>
                        <p class="medvirkende"></p>
                        <p class="redaktoer"></p>



                    </div>
                </article>
            </template>
        </section>

    </main><!-- #main -->

    <script>
        let aktuelafsnit;

        const afsnitUrl = "https://rys.dk/kea/09_cms/radio_loud/wp-json/wp/v2/afsnitter/" + <?php echo get_the_ID() ?>;

        const container = document.querySelector("#afsnit");

        async function getJson() {
            const data = await fetch(afsnitUrl);
            afsnit = await data.json();
            console.log("afsnit: ", afsnit);


            visAfsnit();

        }

        function visAfsnit() {
            console.log("visAfsnit");

          /*  document.querySelector(".afsnit_billede").src = afsnit.billede.guid;*/

            document.querySelector("h2").textContent = afsnit.title.rendered;
            document.querySelector("h3").textContent = afsnit.afsnit_navn;
            document.querySelector(".afsnit_nr").textContent = afsnit.afsnit_nr;
            document.querySelector(".varighed").textContent = afsnit.varighed;
            document.querySelector(".dato").textContent = afsnit.dato;
            document.querySelector(".vaerter").textContent = afsnit.vaerter;
            document.querySelector(".medvirkende").textContent = afsnit.medvirkende;
            document.querySelector(".redaktoer").textContent = afsnit.redaktoer;


        }

        getJson();

    </script>

</div><!-- #primary -->

<?php
get_footer();
