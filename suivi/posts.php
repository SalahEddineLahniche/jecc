<?php
#require 'functions.php';
$current = 15;
$count = get_posts_count($departement_id);
$posts = get_posts($departement_id, 0, $current);

?>

<div class="container">
	<div class="new-post">
		<div class="new-post-content">
			<textarea class="form-control text-content" rows="3" max-length="400"></textarea>
			<button type="button" class="btn btn-primary">Submit</button>
			<span>400</span>
			<input type="text" value="http://" class="form-control hidden">
			<a href="#">Add link</a>
		</div>
	</div>
</div>
<div class="container posts" data-current="<?= $current?>" data-count="<?= $count?>">
    <?php foreach ($posts as $post): ?>
			<div class="post">
				<div class="name">
					<span class="role"><?= $post['urole'].":" ?></span>
					<span class="full-name"><?= $post['uname'] ?></span>
					<span class="date"><?= $post['pdate'] ?></span>
				</div>
				<div class="content"><?= $post['ptext'] ?></div>
				<?php if ($post['plink']):?>
				<div class="attachment">
					<div class="link-image glyphicon glyphicon-link"></div>
					<div class="link-content"><a href="<?= $post['plink'] ?>"><?= $post['plink'] ?></a></div>
				</div>
				<?php endif?>
			</div>
	<?php endforeach;?>
</div>
<?php if($count > $current):?>
<button id="loadmore" class="btn btn-primary glyphicon glyphicon-repeat"></button>
<?php endif;?>