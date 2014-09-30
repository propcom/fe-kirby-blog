<?php snippet('header') ?>
<?php snippet('slider') ?>

<div class="container--lrg content">
  <h1><?php echo html($page->title()) ?></h1>
  <?php echo kirbytext($page->text()) ?>
</div>

<div class="blog">
	<div class="container--lrg">
		<div class="filter">
			<select class="filter__type">
				<option value="*" style="display: none;">Category: All</option>
				<option value="*">All</option>
				<option value=".blog__post--food">Food</option>
				<option value=".blog__post--chefs">Chefs</option>
				<option value=".blog__post--ingredients">Ingredients</option>
				<option value=".blog__post--ourshop">Our Shop</option>
			</select>
			<select class="filter__month">
				<option value="*">Archive: Select a date</option>
					<?php
						for ($i = 0; $i <= 12; ++$i) {
							$time = strtotime(sprintf('-%d months', $i));
							$value = date('Y-m', $time);
							$label = date('F Y', $time);
							printf('<option value=".blog__post--%s">%s</option>', $value, $label);
						}
					?>
			</select>
		</div>
		<div class="isotope-container">
			<?
				$i = 0;
				foreach($page->children()->visible()->flip() as $article):
				if (++$i == 11) break;
			?>
			<? $pubDate = strtotime($article->pub_date()); ?>

			<article class="blog__post blog__post--<?php echo str_replace(" ", "", strtolower(html($article->tags()))) ?> blog__post--<? echo date('Y-m', $pubDate); ?>">

				<div class="blog__post--tags">
					<i class="icon icon-tag"></i> <?php echo html($article->tags()) ?>
				</div>

				<? if($article->hasImages()) {
					foreach ($article->images() as $image) { ?>
					<div class="blog__post--img">
						<img src="/assets/img/blank/blank.png" class="pll" data-src="<?php echo $image->url(); ?>">
					</div>
					<? break;
					} ?>
				<? } ?>



				<? echo date('dS F', $pubDate); ?>

				<h1><?php echo html($article->title()) ?></h1>

				<?
					$articleLength = rand(1, 3);
					if($articleLength==1) {
						$articleLength = 300;
					} elseif ($articleLength==2) {
						$articleLength = 400;
					} elseif ($articleLength==3) {
						$articleLength = 500;
					} else {
						$articleLength = 400;
					}
				?>

				<p><?php echo excerpt($article->text(), $articleLength) ?></p>

				<a class="blog__post--readMore" href="<?php echo $article->url() ?>">Continue Reading</a>

			</article>

			<?php endforeach ?>

		</div>
	</div>
	<div class="blog__loadMore js-blog__loadMore">
		Load More Posts
	</div>
</div>

<?php snippet('footer') ?>