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
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
            echo $html->charset();
            echo $this->Html->meta('icon');
            //echo $this->Html->css(array('main', 'grid'));
            echo $this->Html->script(array('jquery-1.4.2.min', 'jquery.ui/js/jquery-ui-1.8.4.custom.min', 'jquery.thememenu/ddsmoothmenu'));
            echo $scripts_for_layout;
        ?>
        <link type="text/css" href="<?php echo $this->Html->url('/css/main.css', true) ?>" rel="stylesheet" />
        <link type="text/css" href="<?php echo $this->Html->url('/js/jquery.ui/css/' . $tema . '/jquery-ui-1.8.4.custom.css', true) ?>" rel="stylesheet" />
        <link type="text/css" href="<?php echo $this->Html->url('/js/jquery.thememenu/ddsmoothmenu.css', true) ?>" rel="stylesheet" />
        <link type="text/css" href="<?php echo $this->Html->url('/css/grid.css', true) ?>" rel="stylesheet" />
        <script type="text/javascript">
                ddsmoothmenu.init({
                    mainmenuid: "smoothmenu1", //menu DIV id
                    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                    classname: 'ddsmoothmenu', //class added to menu's outer DIV
                    //customtheme: ["#5c9ccc url(images/ui-bg_gloss-wave_55_5c9ccc_500x100.png) 50% 50% repeat-x", "#dfeffc url(images/ui-bg_glass_85_dfeffc_1x400.png) 50% 50% repeat-x"],
                    //customtheme: [$('#take').css('backgroundColor')+" "+$('#take').css('background-image')+" 50% 50% repeat-x", "#dfeffc url(images/ui-bg_glass_85_dfeffc_1x400.png) 50% 50% repeat-x"],
                    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
                });
            </script>

        </head>
        <body>
            <table cellspacing="0" cellspacing="0" width="100%">
                <tr>
                    <td class="ui-state-default" style="height: 70px;"></td>
                </tr>
            </table>
            <div id="smoothmenu1">
                <ul>
                    <li><a href="#">Cadastros</a>
                        <ul class="ui-widget-header">
                            <li class="ui-widget-header"><?php echo $this->Html->link('Teste Link', array()); ?></li>
                        </ul>
                    </li>
                    <li><a href="#">Temas</a>
                        <ul class="ui-widget-header">
                            <li class="ui-widget-header"><?php echo $this->Html->link('Redmond', array('action' => 'changeTema', 'redmond'), array()); ?></li>
                            <li class="ui-widget-header"><?php echo $this->Html->link('Ui-lightness', array('action' => 'changeTema', 'ui-lightness'), array()); ?></li>
                            <li class="ui-widget-header"><?php echo $this->Html->link('Sunny', array('action' => 'changeTema', 'sunny'), array()); ?></li>
                            <li class="ui-widget-header"><?php echo $this->Html->link('Le Frog', array('action' => 'changeTema', 'le-frog'), array()); ?></li>
                            <li class="ui-widget-header"><?php echo $this->Html->link('Blitzer', array('action' => 'changeTema', 'blitzer'), array()); ?></li>
                        </ul>
                    </li>
                </ul>
                <br style="clear: left" />
            </div>
            <div style="padding:8px">
            <?= $this->Session->flash() ?>
            <?= $content_for_layout; ?>
        </div>
    </body>
</html>