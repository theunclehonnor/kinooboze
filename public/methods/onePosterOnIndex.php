<?php
global $data;
for ($i=0;$i<count($data);$i++) {
	echo '<div class="posters-content__poster">
			<div class="posters-content__img-poster transation" onclick="getPageObzor(' . $data[$i]['idObzor'] . ');">
				<img src=' . $data[$i]['poster'] . ' alt="Постер" class="posters-content__img"/>
				<div class="posters-content__info">
					<div class="posters-content__plice">
						<p class="posters-content__title"></p>
					</div>
					<div class="posters-content__plice">
						<p class="posters-content__title"></p>
					</div>
					<div class="posters-content__plice">
						<p class="posters-content__title"></p>
					</div>
					<div class="posters-content__plice">
						<p class="posters-content__title"></p>
					</div>
				</div>
			</div>
			<ul class="posters-content__slice slice_active transation">
				<li class="posters-content__li">' . $data[$i]['nameFilm'] . '</li>
				<li class="posters-content__li">от ' . $data[$i]['name'] . '</li>
				<li class="posters-content__li">' . $data[$i]['dateAdd'] . '</li>
			</ul>
		</div>';
}
?>