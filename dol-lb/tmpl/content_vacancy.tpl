<h2>Вакансии</h2>
<table id="vacancy">
	<?php for ($i = 0; $i < count($this->vacancy); $i++) { ?>
	<tr>
		<td><?=($i + 1).".&nbsp;&nbsp;"?></td><td><?=$this->vacancy[$i]["title"]?></td>
	</tr>
	<?php } ?>
</table>
<br/>
<br/>
<p>
	Подробное резюме присылать на e-mail: <a href="mailto:dol-lb@yandex.ru" title="Наша почта"><?=$this->email?></a>
</p>