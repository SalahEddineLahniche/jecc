<?php
#require 'functions.php';
$posts = get_posts($departement_id);

?>

<div class="container">
	<div class="new-post">
		<div class="new-post-content">
			<textarea class="form-control text-content" rows="3" max-length="400"></textarea>
			<button type="button" class="btn btn-primary">Submit</button>
			<span>400</span>
		</div>
	</div>
</div>
<div class="container posts">
    <?php foreach ($posts as $post): ?>
			<div class="post">
				<div class="name">
					<span class="role"><?= $post['urole'].":" ?></span>
					<span class="full-name"><?= $post['uname'] ?></span>
					<span class="date"><?= $post['pdate'] ?></span>
				</div>
				<div class="content"><?= $post['ptext'] ?></div>
				<div class="attachment">
					<div class="link-image glyphicon glyphicon-link"></div>
					<div class="link-content"><a href="<?= $post['plink'] ?>"><?= $post['plink'] ?></a></div>
				</div>
			</div>
	<?php endforeach;?>
</div>