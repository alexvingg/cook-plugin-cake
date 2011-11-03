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
		$(".rodape").find("span.disabled").parent().addClass("ui-state-disabled");
		<?=$this->element("button_fnc", array("obj" => ".btn_salvar", "icon" => "ui-icon-disk" ) ); ?>
		<?=$this->element("button_fnc", array("obj" => "#btn_voltar", "icon" => "ui-icon-arrowreturnthick-1-w" ) ); ?>
		<?=$this->element("button_fnc", array("obj" => "#btn_edit", "icon" => "ui-icon-pencil" ) ); ?>
                <?=$this->element("button_fnc", array("obj" => ".btn_delete", "icon" => "ui-icon-trash", "text" => false ) ); ?>
                <?=$this->element("button_fnc", array("obj" => "#btn_novo", "icon" => "ui-icon-plus" ) ); ?>		
                <?=$this->element("button_fnc", array("obj" => ".btn_edit", "icon" => "ui-icon-pencil", "text" => false ) ); ?>
                <?=$this->element("button_rodape");?>
                <?=$this->element("grid_fnc");?>                
        });

</script>'?>

<?php echo '<?=$this->element("box_create"); ?>
<?=$this->element("button", array( "label" => "Novo '.$singularHumanName.'", "id" => "btn_novo", "href" => $this->Html->url( array("action" => "add") ) ) ); ?>
<?=$this->element("box_end") ?>'."\n";?>


    <?php echo '<?php echo $this->element("grid_create", array("titulo" => "Lista de '.$pluralHumanName.'")); ?>'."\n" ;?>
    <?php echo "<table class='ui-grid-content ui-widget-content'>"."\n";
                echo "\t<thead>\n";
                echo "\t\t<th align='center' class='ui-state-default'>&nbsp;</th>\n";
		foreach ($fields as $field) {
                    if($field != 'id'){
			if (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\t<th align='left' class='ui-state-default'><?php echo \$this->Paginator->sort('{$field}'); ?></th>\n";
                            }
                        }
                   }
                echo "\t</thead>\n"
                ?>
    <?php
    echo '<?php foreach ($'.$pluralVar.' as $'.$singularVar.'):?>'."\n";
    echo "\t<tr>\n";
    echo "\t".'<td style="width:60px" class="ui-widget-content">
		<?=$this->element("button", array( "label" => __("Edit", true), "class" => "btn_edit", "href" => $this->Html->url( array("action" => "edit", $'.$singularVar.'["'.$singularHumanName.'"]["'.$primaryKey.'"]) ) ) ); ?>
                <?=$this->element("button", array( "label" => __("Delete", true), "class" => "btn_delete", "href" => $this->Html->url( array("action" => "delete", $'.$singularVar.'["'.$singularHumanName.'"]["'.$primaryKey.'"]) ) ) ); ?>
	</td>'."\n";

        foreach ($fields as $field) {
            $isKey = false;
            if($field != 'id'){
                if($field == 'nome'){
                    echo "\t".'<td style="text-align:left" class="ui-widget-content">
                    <?php echo $this->Html->link($'.$singularVar.'["'.$singularHumanName.'"]["'.$field.'"], array("controller"=>"'.$pluralVar.'", "action" => "view", $'.$singularVar.'["'.$singularHumanName.'"]["'.$primaryKey.'"]), array() ); ?>&nbsp;'."\n"."\t</td>\n";
                  }else{
                      if(!empty ($associations['belongsTo']))
                      {
                            foreach ($associations['belongsTo'] as $alias => $details) {
                                if ($field === $details['foreignKey']) {
                                    $isKey = true;
                                    //print_r ($alias);
                                    //print_r ($details['displayField']);
                                    /*echo "<div class='labelform'><?php __('" . Inflector::humanize(Inflector::underscore($alias)) . ":'); ?></div><br/>";
                                    echo "<div class='labelform'>\n<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}']));?></div>\n<br/>\n";*/
                                    echo "\t".'<td style="text-align:left" class="ui-widget-content">
                                    <?php echo $'.$singularVar.'["'.$alias.'"]["'.$details['displayField'].'"];?>'."\n"."\t</td>\n";
                                }
                            }
                       }
                      if(!$isKey)
                      {
                        echo "\t".'<td style="text-align:left" class="ui-widget-content">
                        <?php echo $'.$singularVar.'["'.$singularHumanName.'"]["'.$field.'"];?>'."\n"."\t</td>\n";
                        $isKey = false;
                      }
                }
            }
        }
    echo "\t</tr>\n";
    echo "<?php endforeach;?>\n";
    echo "</table>\n";
    ?>

<?php echo '<?php echo $this->element("grid_end", array("rodape" => $this->Paginator->counter( array("format" => __("Página %page% de %pages%, mostrando %current% registros de um total de %count% .", true))))); ?>'."\n";?>
