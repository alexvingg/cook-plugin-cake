<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php echo '<script type="text/javascript">
	$(function(){

                $("input").addClass("text ui-widget-content ui-corner-all");
                $("textarea").addClass("text ui-widget-content ui-corner-all");
                $("multiple").addClass("text ui-widget-content ui-corner-all");
                $("select").addClass("text ui-widget-content ui-corner-all");
		<?=$this->element("tabs_fnc", array("tab" => "tabs") ); ?>
		<?=$this->element("button_fnc", array("obj" => "#btn_salvar", "icon" => "ui-icon-disk" ) ); ?>
		<?=$this->element("button_fnc", array("obj" => "#btn_voltar", "icon" => "ui-icon-arrowreturnthick-1-w" ) ); ?>
                '?>
                <?
foreach ($schema as $tipo) {
    if($tipo['type']=='date' || $tipo['type']=='datetime'){
    echo '<?=$this->element("date_fnc"); ?>';
    break;
    }
}
echo'
        });

</script>'."\n"?>
<?
        echo '          <?=$this->element("box_create"); ?>
        <?=$this->element("button", array( "label" => "Voltar", "id" => "btn_voltar", "href" => $this->Html->url( array("action" => "index") ) ) ); ?>
        <?=$this->element("box_end"); ?>'
?>
<? echo '<?=$this->element("tabs_create", array("name" => "tabs", "tabs" =>"tab-1", "labels" => "'.$singularHumanName.'")); ?>'."\n\t"; ?>
<div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
<?php echo "\t\t<?php echo \$this->Form->create('{$modelClass}');?>\n";?>
<?php
		echo "\t\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\t\techo \$jquery->input('{$field}');\n";
			}
		}
                echo"\t\t\t".'echo "<br/>";'."\n";
                echo "\t\t?>\n";
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                                echo "\t\t\t<label>$assocName:</label>";
                                echo '<?=$this->element("listcheck_create", array("width" => "300", "height" => "200")); ?>
			<? foreach ($'.Inflector::pluralize(Inflector::underscore($assocName)).' as $k=>$a): ?>
				<?=$this->element("check", array("value" => $k, "label" => $a, "name" => "data['.$assocName.']['.$assocName.'][]" )); ?>
			<?endforeach;?>
			<?=$this->element("listcheck_end"); ?>
                       	<?php if( isset($this->data[\''.$assocName.'\']) ): ?>
			<script type="text/javascript">
				<? foreach ($this->data[\''.$assocName.'\'] as $a): ?>
					<?=$this->element("check_scr", array("value" => $a["id"], "name" => "data['.$assocName.']['.$assocName.'][]" )); ?>
				<?endforeach;?>
			</script>
			<?endif;?>';
				//echo "\t\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		
?>
<?php
       echo "<br/>\n<label></label>\n";
       echo "\n\t\t".'<?=$this->element("button", array( "label" => "Salvar", "id" => "btn_salvar") ); ?>'."\n\t";
?>
</div>
<? echo'<?=$this->element("tabs_end")?>'?>