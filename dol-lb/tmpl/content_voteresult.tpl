<h2>Результаты голосования</h2>
<table class="voteresult" >
	<tr>
		<td colspan="3"><h3><i><?=$this->vote?></i></h3></td>
	</tr>
	<?php for ($i = 0; $i < count($this->voteresult_variants); $i++) { ?>
	<tr>
		<td>
			<div class="title1"><?=$this->voteresult_variants[$i]["title"]?></div>
		</td>
		<td>
			<div class="title2"><?=$this->voteresult_variants[$i]["votes"]?></div>
		</td>
		<td>
			<div class="bar">
				<div class="progressbar" id="progressbar_<?=$i?>"></div><div class="proc"><?=$this->voteresult_variants[$i]["proc"]."%"?></div>	
			</div>
		</td>
	</tr>	
	<?php } ?>
</table>
<br/>
<p>Общее количество проголосовавших человек: <b><i><?=$this->voteresult_variants[0]["summ"]?></i></b></p>
<script type="text/javascript">
	<?php for ($i = 0; $i < count($this->voteresult_variants); $i++) { ?>	
		$("#progressbar_<?=$i?>").css("width", <?=$this->voteresult_variants[$i]["proc"]?> * 3);	
	<?php } ?>
</script>