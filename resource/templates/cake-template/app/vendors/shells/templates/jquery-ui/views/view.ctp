<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
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
		<?=$this->element("button_fnc", array("obj" => ".btn_salvar", "icon" => "ui-icon-disk" ) ); ?>
		<?=$this->element("button_fnc", array("obj" => "#btn_voltar", "icon" => "ui-icon-arrowreturnthick-1-w" ) ); ?>
		<?=$this->element("button_fnc", array("obj" => "#btn_edit", "icon" => "ui-icon-pencil" ) ); ?>
                <?=$this->element("button_fnc", array("obj" => ".btn_delete", "icon" => "ui-icon-trash", "text" => false ) ); ?>
                <?=$this->element("button_fnc", array("obj" => "#btn_novo", "icon" => "ui-icon-plus" ) ); ?>
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

</script>'?>

<?$done = array();
        $qtd = 2;
        $tabs = 'tab-1,';
        $label = __($singularHumanName,true).',';
    foreach ($associations as $type => $data) {
                //if($type!="belongsTo"){
                    foreach($data as $alias => $details) {
                            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                                    $tabs = $tabs.'tab-'.$qtd.',';
                                    if($type == "belongsTo" || $type == "hasOne" )
                                    {                                      
                                        $label = $label.Inflector::Singularize(Inflector::humanize($details['controller'])).',';
                                    }else{
                                       $label = $label.Inflector::humanize($details['controller']).',';
                                    }
                                    $qtd++;
                                    $done[] = $details['controller'];
                            }
                    }
                //}
    }
    $label = substr($label,0,-1);
    $tabs = substr($tabs,0,-1);
?>
<?php echo '<?=$this->element("box_create"); ?>
                <?=$this->element("button", array( "label" => "Voltar", "id" => "btn_voltar", "href" => $this->Html->url( array("action" => "index") ) ) ); ?>
                <?=$this->element("button", array( "label" => "Editar", "id" => "btn_edit", "href" => $this->Html->url( array("action" => "edit", $'.$singularVar.'["'.$singularHumanName.'"]["'.$primaryKey.'"]) ) ) ); ?>
                <?=$this->element("button", array( "label" => "Novo '.$singularHumanName.'", "id" => "btn_novo", "href" => $this->Html->url( array("action" => "add", $'.$singularVar.'["'.$singularHumanName.'"]["'.$primaryKey.'"]) ) ) ); ?>
            <?=$this->element("box_end"); ?>'."\n\n" ?>
<? echo '<?=$this->element("tabs_create", array("name" => "tabs", "tabs" =>'."'".$tabs."'".', "labels" =>'."'".$label."'".')); ?>'."\n"; ?>
<div id="tab-1">
<?php echo "<?php if (!empty(\${$singularVar}['{$modelClass}']['id'])):?>\n";?>
<?php
foreach ($fields as $field) {
	$isKey = false;
        
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				/*echo "<div class='labelform'><?php __('" . Inflector::humanize(Inflector::underscore($alias)) . ":'); ?></div><br/>";
				echo "<div class='labelform'>\n<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}']));?></div>\n<br/>\n";*/
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "<label><?php __('" . Inflector::humanize($field) . ":'); ?></label>\n";
		echo "<div class='labelform'> <?php echo \${$singularVar}['{$modelClass}']['{$field}'];?> </div>\n<br/>\n";
	}
}
?>

<?php echo "<?php endif; ?>\n";?>
</div>
<?php
$qtd = 2;
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div id="tab-<?echo $qtd?>">
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}']['id'])):?>\n";?>
		<?php echo "\t<?php \$i = 0; \$class = ' class=\"altrow\"';?>\n";?>
	<?php
			foreach ($details['fields'] as $field) {
				echo "<label>\n\t<?php __('" . Inflector::humanize($field) . ":');?>\n</label>\n";
				echo "<div class='labelform'>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}'];?>\n</div>\n<br>";
			}
	?>
		
	<?php echo "<?php endif; ?>\n";?>
        </div>
	<?php
	endforeach;
        $qtd++;
endif;

if (!empty($associations['belongsTo'])) :
	foreach ($associations['belongsTo'] as $alias => $details): ?>
	<div id="tab-<?echo $qtd?>">
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}']['id'])):?>\n";?>
		<?php echo "\t<?php \$i = 0; \$class = ' class=\"altrow\"';?>\n";?>
	<?php
			foreach ($details['fields'] as $field) {
				echo "<label>\n\t<?php __('" . Inflector::humanize($field) . ":');?>\n</label>\n";
				echo "<div class='labelform'>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}'];?>\n</div>\n<br>";
			}
	?>
		
        </div>
	<?php echo "<?php endif; ?>\n";?>
	<?php
	endforeach;
        $qtd++;
endif;

if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
<div id="tab-<?echo $qtd?>">
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
        <?php echo '<?=$this->element("grid_create")?>' ?>
	<table class="ui-grid-content ui-widget-content">
	<thead>
            <tr>
<?php
			foreach ($details['fields'] as $field) {				
                                echo '
                                        <th align="left" class="ui-state-default">'.Inflector::humanize($field).'</th>
                                      ';

			}
?>
           </tr>
        </thead>
<?php
echo "\t<?php
		\$i = 0;
		foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}):
			\$class = null;
			if (\$i++ % 2 == 0) {
				\$class = ' class=\"altrow\"';
			}
		?>\n";
		echo "\t\t<tr<?php echo \$class;?>>\n";

				foreach ($details['fields'] as $field) {
                                    if($field == 'nome')
                                    {
					echo "\t\t\t".'<td style="text-align:left;"> <?php echo $this->Html->link($'.$otherSingularVar.'["'.$field.'"], array("controller"=>"'.strtolower($otherPluralHumanName).'", "action" => "view", $'.$otherSingularVar.'["'.$primaryKey.'"]), array() ); ?> </td>'."\n";
                                    }else{
					echo "\t\t\t<td style='text-align:left;'><?php echo \${$otherSingularVar}['{$field}'];?></td>\n";
                                    }
                                }

			echo "\t\t</tr>\n";
echo "\t<?php endforeach; ?>\n";
$qtd++;
?>
	</table>
    <? echo '<?=$this->element("grid_end")?>'; ?>
<?php echo "<?php endif; ?>\n\n";?>
</div>
<?php endforeach;?>

<? echo'<?=$this->element("tabs_end")?>'?>