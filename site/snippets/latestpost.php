<div class="container latestBlog">
    <h2>Latest news</h2>

    <div class="latestBlog__twitter latestBlog__box">
        <?php snippet('twitter') ?>
    </div>

	<div class="lastestBlog__slider latestBlog__box last">
		<div class="lastestBlog__slider--inner">
			<?
				$i = 0;
				foreach($pages->find('blog')->children()->visible()->flip() as $article):
					if ($i >= 4) break;


					$pubDate = strtotime($article->pub_date()); ?>
					<? if($article->hasImages() && $article->frontpage() == 'on') { $i++; ?>

						<div class="latestBlog__post" style="background: url('<? if($article->hasImages()) {foreach ($article->images() as $image) {echo $image->url();break;}} ?>') center center; background-size: cover;">
							<div class="latestBlog__post--date"><span><?= date('d', $pubDate); ?></span> <br><?= date('M', $pubDate); ?></div>

							<div class="latestBlog__post--text"><a href="<?= $article->url(); ?>"><?php echo html($article->title()) ?></a></div>
						</div>
					<? } ?>

			<?php endforeach ?>
		</div>
	</div>
</div>