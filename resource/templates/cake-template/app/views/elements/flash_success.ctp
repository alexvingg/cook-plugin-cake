<script>
	window.onload = function(){
		setInterval("document.getElementById('msginfo').style.display='none'", 5000);
	}
</script>

<div id="msginfo" class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 3px;margin-bottom: 5px; padding: 0 .7em;">
	   <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
			<?=$message?></p>
	</div>
</div>