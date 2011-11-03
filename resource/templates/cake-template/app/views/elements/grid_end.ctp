		<? if(isset($rodape)): ?>
    <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">
        <!--div class="ui-grid-paging ui-helper-clearfix">
            <a href="?results=1" class="ui-grid-paging-prev ui-state-default ui-corner-left"><span class="ui-icon ui-icon-triangle-1-w" title="previous set of results"></span></a>
            <a href="?results=3" class="ui-grid-paging-next ui-state-default ui-corner-right"><span class="ui-icon ui-icon-triangle-1-e" title="next set of results"></span></a>
        </div-->
        <div class="ui-grid-results"><?=$rodape?>
            <div style="float: right;"><div class="ui-widget ui-state-default rodape ui-corner-all" style="width:80px; height:20px; padding-top: 5px; text-align:center;  float:left; margin-right: 2px;margin-left: 2px;"><?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?></div> 	<?php echo $this->Paginator->numbers(array('style'=>'text-decoration: underline;','before'=>'<div class="ui-widget ui-state-default rodape ui-corner-all botaoGridPaginacao" >','after'=>'</div>',  'separator'=>'</div><div class="ui-widget ui-state-default rodape ui-corner-all botaoGridPaginacao">'));?><div class="ui-widget ui-state-default rodape ui-corner-all" style="width:80px; height:20px; padding-top: 5px; text-align:center;  float:left; margin-right: 2px;margin-left: 2px;"><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?></div></div>
			</div>

    </div>
    <? endif; ?>
</div>