<?php
	if(!r::is_ajax()) notFound();

	header('Content-type: application/json; charset=utf-8');

	$data = $pages->find('blog')->children()->visible()->flip()->paginate(10);

	$json = array();

	$json['data']  = array();
	$json['pages'] = $data->pagination()->countPages();
	$json['page']  = $data->pagination()->page();

	foreach($data as $article) {

		$pubDate = strtotime($article->pub_date());

		$date = date('dS F', $pubDate);

		$articleLength = rand(1, 3);
		if($articleLength==1) {
			$articleLength = 300;
		} elseif ($articleLength==2) {
			$articleLength = 400;
		} elseif ($articleLength==3) {
			$articleLength = 500;
		} else {
			$articleLength = 300;
		}

		$text = excerpt($article->text(), $articleLength);

		$image = $article->images();
		$image = strstr($image, '"');
		$image = substr($image, 1);
		$image = strstr($image, '"', true);

		$json['data'][] = array(
			'url'   => (string)$article->url(),
			'tag'   => (string)$article->tags(),
			'title' => (string)$article->title(),
			'images' => (string)$image,
			'text'  => (string)$text,
			'date'  => (string)$date
		);

	}

	echo json_encode($json);
?>