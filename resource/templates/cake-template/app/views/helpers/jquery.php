<?
class JqueryHelper extends FormHelper {

	function init_menubutton($id){
		return $this->output('
		<style type="text/css">
			.btn_seta{
				background: url('.$this->webroot.'css/img/16-arrow-down_16x16.png) no-repeat 0 0;
				background-position:15% 50%;
			}
			.btn_seta2{
				background: url('.$this->webroot.'css/img/16-arrow-down_16x16.png) no-repeat 0 0;
				background-position:15% 50%;
			}
		</style>
		<script type="text/javascript">
		    $(function(){
				$(\'#'.$id.'\').hover(
				    		function(){ $(this).removeClass(\'ui-state-default\').addClass(\'btn_seta2\'); },
				    		function(){ $(this).removeClass(\'ui-state-focus\').addClass(\'btn_seta2\'); }
				    	);
				$(\'#'.$id.'\').menu({
					content: $(\'#'.$id.'\').next().html(), // grab content from this page
					flyOut: true,
					callerOnState: "btn_seta"
				});
		    });
		</script>
		');
	}

	function menubutton($id,$label,$menu){

		$saida = "";
		foreach($menu as $key=>$val){
			$saida.='<li><a onclick="location.href=\''.$val.'\'" href="#">'.$key.'</a></li>';
		}

		return $this->output('
		<a href="#'.$id.'-menu" id="'.$id.'" class="linkbutton linkbtn btn_seta">'.$label.'</a>
		<div id="'.$id.'-menu" class="hidden">
		<ul>'.$saida.'</ul>
		</div>
		');
	}

	function treeHelp(){
		return $this->output('
			<!--jsTree - INICIO: Copie o codigo e utilize da forma que achar melhor-->
			<script type="text/javascript" src="'.$this->webroot.'js/jquery.jstree/jquery.tree.js"></script>
			<script type="text/javascript">
			    $(function(){
					$("#demo_1").tree({
								callback : {
									onchange : function (NODE, TREE_OBJ) {
										//alert(TREE_OBJ.get_type(NODE) + "-" + TREE_OBJ.get_text(NODE) + "-" + TREE_OBJ.get_node(NODE).attr("id"));
									}
								},
								types : {
									"default" : {
										draggable : false,
										deletable : false,
										renameable : false
									},
									"item" : {
										valid_children : [ "subitem" ],
										icon : {
											image : "'.$this->webroot.'js/jquery.jstree/drive.png"
										}
									},
									"subitem" : {
										valid_children : [ "subsubitem" ],
									},
									"subsubitem" : {
										valid_children : "none",
										icon : {
											image : "'.$this->webroot.'js/jquery.jstree/file.png"
										}
									}
								}

							});
			    });
			</script>
			<div style="overflow:hidden" id="demo_1">
				<ul>
					<li id="id|1" rel="item" class="open"><a href="#"><ins>&nbsp;</ins>Item1</a>
						<ul>
							<li id="sid|1" rel="subitem"><a href="#"><ins>&nbsp;</ins>SubItem1</a></li>
							<li id="sid|2" rel="subitem"><a href="#"><ins>&nbsp;</ins>SubItem2</a>
								<ul>
									<li id="ssid|1" rel="subsubitem"><a href="#"><ins>&nbsp;</ins>Sub SubItem1</a></li>
									<li id="ssid|2" rel="subsubitem"><a href="#"><ins>&nbsp;</ins>Sub SubItem2</a></li>
									<li id="ssid|3" rel="subsubitem"><a href="#"><ins>&nbsp;</ins>Sub SubItem3</a></li>
								</ul>
							</li>
							<li id="sid|3" rel="subitem"><a href="#"><ins>&nbsp;</ins>SubItem3</a>
								<ul>
									<li id="ssid|4" rel="subsubitem"><a href="#"><ins>&nbsp;</ins>Sub SubItem4</a></li>
									<li id="ssid|5" rel="subsubitem"><a href="#"><ins>&nbsp;</ins>Sub SubItem5</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!--jsTree - FIM-->
		');
	}

	function dialogHelp(){
		return $this->output('
			<!--Dialog - INICIO: Copie o codigo e utilize da forma que achar melhor-->
			<script type="text/javascript">
			 	$(function(){
					$("#dialog").dialog({
						bgiframe: true,
						height: 140,
						modal: true,
						autoOpen: false
					});
				});
			</script>

			<div id="dialog" title="Janela Modal">
				<p>Janela de Dialogo Modal</p>
			</div>

			<input type="button" value="Abrir" onclick="$(\'#dialog\').dialog(\'open\')">
			<!--Dialog - FIM-->
		');
	}

	function dialogInit($id = array(),$script=true){
		$saida = '';
		for($x=0;$x<count($id);$x++){
			$saida.="
			$('#".$id[$x]."').dialog({
				bgiframe: true,
				height: 140,
				modal: true,
				autoOpen: false
			});\n
			";
		}

		if($script){
			$retorno = '
				<script type="text/javascript">
					$(function() {'.
					$saida.'
					});
				</script>';
		}else{
			$retorno = $saida;
		}
		return $this->output($retorno);
	}

	function accordionHelp(){
		return $this->output('
			<!--Accordion - INICIO: Copie o codigo e utilize da forma que achar melhor-->
			<script type="text/javascript">
				$(function() {
					$("#accordion").accordion();
				});
			</script>
			<div>
				<div id="accordion">
					<h3><a href="#">Acordion1</a></h3>
					<div>
						<p>
						conteudo do accordion1
						</p>
					</div>
					<h3><a href="#">Acordion2</a></h3>
					<div>
						<p>
						conteudo do accordion2
						</p>
					</div>
				</div>
			</div>
			<!--Accordion - FIM-->
		');
	}

	function accordionInit($id = array(),$script=true){
		$saida = '';
		for($x=0;$x<count($id);$x++){
			$saida.="$(\"#".$id[$x]."\").accordion();\n";
		}
		if($script){
			$retorno = '
			<script type="text/javascript">
				$(function() {'.
				$saida.'
				});
			</script>
			';
		}else{
			$retorno = $saida;
		}
		return $this->output($retorno);
	}

    function ajaxMsg($msg='Loading...',$id='ajax_msg'){
        return $this->output('<div id="'.$id.'" style="display:none;background:red;color:white;position:absolute;top:0px;right:0px">'.$msg.'</div>');
    }

    function ajaxConfigMsg($id='ajax_msg'){
        return $this->output('
        <script type="text/javascript">
            $(document).ready(function(){

                $("#'.$id.'").ajaxSend(function(){
                    $(this).css({display: "block"});
                });

                $("#'.$id.'").ajaxStart(function(){
                    $(this).css({display: "block"});
                });

                $("#'.$id.'").ajaxError(function(){
                    $(this).css({display: "none"});
                });

                $("#'.$id.'").ajaxComplete(function(){
                    $(this).css({display: "none"});
                });

                $("#'.$id.'").ajaxStop(function(){
                    $(this).css({display: "none"});
                });

            });
        </script>');
    }

    function ajaxHelp(){
        return $this->output('

		<!--Ajax - INICIO: Copie o codigo e utilize da forma que achar melhor-->

        $("#{DIV_RETORNO}").empty().html("<img id=\'loading\' src=\'<?php echo $this->webroot;?>img/ajax_preloader.gif\'/> Loading...");//Loading info

        jQuery.ajax({
            type: \'{POST|GET}\',
            data: $(\':input\',document.forms[0]).serialize(),//If method get no data
            url:\'{URL}\',
            success: function(data){
                $("#{DIV_RETORNO}").empty().html(data);
            }
        });
		<!--Ajax - FIM-->
		');
    }

    function ajaxGetMethod($url,$divret,$msg=""){

        if($msg!=""){
            $msg_ret = "$(\"#".$divret."\").empty().html(\"<img id='imgloading' src='<?php echo \$this->webroot;?>img/ajax_preloader.gif'/> ".$msg."\");";
        }

        return $this->output("
        ".$msg_ret."
        jQuery.ajax({
            type: 'get',
            url:'".$url."',
            success: function(data){
                $(\"#".$divret."\").empty().html(data);
            }
        });");
    }

    function ajaxPostMethod($url,$divret,$form_exp="\$(':input',document.forms[0]).serialize()",$msg=""){

        if($msg!=""){
            $msg_ret = "$(\"#".$divret."\").empty().html(\"<img id='imgloading' src='<?php echo \$this->webroot;?>img/ajax_preloader.gif'/> ".$msg."\");";
        }

        return $this->output("
        ".$msg_ret."
        jQuery.ajax({
            type: 'post',
            data:".$form_exp.",
            url:'".$url."',
            success: function(data){
                $(\"#".$divret."\").empty().html(data);
            }
        });");
    }


        var $stags = array(
        'selectmultiplestart' => '<div id="select" %s>',
        'selectempty' => '<input type="hidden" name="data[%s][%s][]" value="">',
        'selectoption' => '<input type="checkbox" name="data[%s][%s][]" value="%s" %s>%s %s',
        'selectend' => '</div>'
        );


        function init_shiftselect(){
            return $this->output('
                <script src="'.$this->webroot.'js/jquery.shiftclick/jquery.shiftclick.js" type="text/javascript"></script>
                <script type="text/javascript" charset="utf-8">
                    $(function() {
                        $(\'input[type=checkbox]\').shiftClick();
                    });
                </script>
            ');
        }

        function tooltip($texto,$tamanho=60){
            return $this->output(substr($texto,0,$tamanho).'...');
        }

        /*
        USE TAG SUGEST:
        <?php echo $jquery->init_tagsugest();?>
        <?php echo $jquery->tagsugest("ProjetoNome",array("igor","igoroliveira","igoroliveiratakenmi"));?>
         */
        function init_tagsugest(){
            return $this->output('
                <script src="'.$this->webroot.'js/jquery.tagging/tag.js" type="text/javascript"></script>
                <style>
                      SPAN.tagMatches {
                          margin-left: 10px;
                      }
                      SPAN.tagMatches SPAN {
                          padding: 0px;
                          margin-right: 8px;
                          border-bottom: 2px solid black;
                          color: black;
                          cursor: pointer;
                      }
                </style>
            ');
        }

        function tagsugest($id,$lista){
            $tags = "";
            foreach($lista as $lst){
                if($tags==""){
                  $tags='"'.$lst.'"';
                }else{
                  $tags.=',"'.$lst.'"';
                }
            }
            return $this->output('
                <script type="text/javascript">
                    <!--
                    $(function () {
                        $(\'#'.$id.'\').tagSuggest({
                            tags: ['.$tags.']});
                    });
                    //-->
                </script>
            ');
        }

        function init_comboselect(){
          return $this->output('
                <link rel="stylesheet" type="text/css" href="'.$this->webroot.'js/jquery.comboselect/jquery.comboselect.css" />
		<!--[if IE]>
		<style type="text/css">
		select.csleft, select.csright {
			width: 100px;
		}
		</style>
		<![endif]-->
		<script type="text/javascript" src="'.$this->webroot.'js/jquery.comboselect/jquery.selso.js"></script>
		<script type="text/javascript" src="'.$this->webroot.'js/jquery.comboselect/jquery.comboselect.js"></script>
            ');
        }

        function comboselect($id,$add="  +  ",$rem="  -  "){
          return $this->output("
            <script>
               $(function(){\$('#".$id."').comboselect({ sort: 'both', addbtn: '".$add."',  rembtn: '".$rem."' });});
            </script>
            ");
        }


        function init_date($local = "br", $start_date = "2000-01-01"){
            return $this->output('
                <script type="text/javascript" charset="utf-8">
                    $(function(){
                            '.$this->config_date($local,$start_date).'
                    });
                </script>
                ');
        }

        function tab_image($img){
            return $this->output('<img style="position:absolute;left:8px;top:4px" border="0" src="'.$this->webroot.'img/ico/'.$img.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
        }

        function config_date($local="en",$start_date = "2000-01-01"){

            $saida = "";

            switch($local){
                case "en":
					$data=explode("-",$start_date);
                    $saida = '
					$(\'.date-pick\').datepicker(
						{
						dateFormat: \'yy-mm-dd\',
						minDate: new Date('.$data[0].','.$data[1].','.$data[2].')
						}

					);';
                break;
                case "pt-br":
					$data=explode("/",$start_date);
                    $saida = '
					$(\'.date-pick\').datepicker(
						{
						dateFormat: \'dd/mm/yy\',
						minDate: new Date('.$data[2].','.$data[1].','.$data[0].'),
						dayNamesMin: [\'Do\', \'Se\', \'Te\', \'Qu\', \'Qi\', \'Se\', \'Sa\'],
						monthNames: [\'Janeiro\',\'Fevereiro\',\'Março\',\'Abril\',\'Maio\',\'Junho\',\'Julho\',\'Agosto\',\'Setembro\',\'Outubro\',\'Novembro\',\'Dezembro\'],
						}
					);
                    ';
                break;
            }
            return $saida;
        }

		function dateTime($fieldName, $dateFormat = 'DMY', $timeFormat = '12', $selected = null, $options = array(), $showEmpty = true){


            if(isset($options['class'])){
                $class = 'date-pick '.$options['class'];
            }else{
                $class = 'date-pick ';
            }

            $options = $this->_initInputField($fieldName, array_merge(array('type' => 'text','class'=>$class), $options));
            $this->__secure();
            return $this->output(sprintf($this->Html->tags['input'], $options['name'], $this->_parseAttributes($options, array('name'), null, ' ')));
	    }

		function select($fieldName, $options = array(), $selected = null, $attributes = array(), $showEmpty = '') {

			if(isset($attributes['multiple'])){
				$attributes['multiple']='checkbox';
			}

			$select = array();
			$showParents = false;
			$escapeOptions = true;
			$style = null;
			$tag = null;

			if (isset($attributes['escape'])) {
				$escapeOptions = $attributes['escape'];
				unset($attributes['escape']);
			}
			$attributes = $this->_initInputField($fieldName, array_merge(
				(array)$attributes, array('secure' => false)
			));

			if (is_string($options) && isset($this->__options[$options])) {
				$options = $this->__generateOptions($options);
			} elseif (!is_array($options)) {
				$options = array();
			}
			if (isset($attributes['type'])) {
				unset($attributes['type']);
			}
			if (in_array('showParents', $attributes)) {
				$showParents = true;
				unset($attributes['showParents']);
			}

			if (!isset($selected)) {
				$selected = $attributes['value'];
			}

			if (isset($attributes) && array_key_exists('multiple', $attributes)) {
				$style = ($attributes['multiple'] === 'checkbox') ? 'checkbox' : null;
				$template = ($style) ? 'checkboxmultiplestart' : 'selectmultiplestart';
				$tag = $this->Html->tags[$template];
				$select[] = $this->hidden(null, array('value' => '', 'id' => null, 'secure' => false));
			} else {
				$tag = $this->Html->tags['selectstart'];
			}

			if (!empty($tag) || isset($template)) {
				$this->__secure();
				$select[] = sprintf($tag, $attributes['name'], $this->_parseAttributes(
					$attributes, array('name', 'value'))
				);
			}
			$emptyMulti = (
				$showEmpty !== null && $showEmpty !== false && !(
					empty($showEmpty) && (isset($attributes) &&
					array_key_exists('multiple', $attributes))
				)
			);

			if ($emptyMulti) {
				$showEmpty = ($showEmpty === true) ? '' : $showEmpty;
				$options = array_reverse($options, true);
				$options[''] = $showEmpty;
				$options = array_reverse($options, true);
			}

			$select = array_merge($select, $this->__selectOptions(
				array_reverse($options, true),
				$selected,
				array(),
				$showParents,
				array('escape' => $escapeOptions, 'style' => $style)
			));

			$template = ($style == 'checkbox') ? 'checkboxmultipleend' : 'selectend';
			$select[] = $this->Html->tags[$template];
			return $this->output(implode("\n", $select));
		}

    }
?>
