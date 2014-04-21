<?php $this->layout('index') ?>

<ul>
<?php foreach ($this->posts as $post): ?>
	<li>
		<a href="<?php echo $post->getUrl();?>">
			<?php echo $post->title;?>
		</a>
	</li>
<?php endforeach; ?>
</ul>
