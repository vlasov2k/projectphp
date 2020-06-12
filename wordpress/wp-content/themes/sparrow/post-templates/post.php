<article class="post">

    <div class="entry-header cf">

        <h1><a href="<?php the_permalink() ?>" title=""><?php the_title() ?></a></h1>

        <p class="post-meta">

            <time class="date" datetime="2014-01-14T11:24"><?php the_time('F jS, Y') ?></time>
            /
            <span class="categories">
                                <?php the_category( ' / ') ?>

                                <?php the_tags ( ' #', ' #') ?>

                            </span>

        </p>

    </div>

    <div class="post-thumb">
        <a href="single.html" title=""><?php the_post_thumbnail() ?></a>
    </div>

    <div class="post-content">

        <?php
        the_content();
        //                    do_action('my_action');
        ?>

    </div>

</article> <!-- post end -->
