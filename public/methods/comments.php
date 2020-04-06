<?php
$comment = new Comment();
$comments = $comment->getAllComments($_SESSION['obzor']->idObzor);

foreach ($comments as $item) {
    echo '<div class="comment-users">
			<div class="comment-users__img">
			<p class="comment-users__name">'. $item->name . '</p>
			</div>
			<div class="comment-users__pole">
				<p class="comment-users__date">' . $item->dateComment . '</p>
				<div class="comment-users__container-line">
					<div class="comment-users__line"></div>
				</div>
				<div class="comment-users__textarea">
					<textarea name="textComment" maxlength=350 rows="5" id="textComment" 
					class="comment-users__textarea-redacted" readonly>' . $item->textComment . '</textarea>
				</div>
			</div>
		</div>';
}
