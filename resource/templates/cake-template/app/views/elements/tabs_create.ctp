<div id="<?=$name?>">
    <ul>
        <?
        $tabs = split(",", $tabs);
        $labels = split(",", $labels);
        for($x=0;$x< count($tabs);$x++) {
        	echo "<li><a href='#".$tabs[$x]."'>".$labels[$x]."</a></li>";
				}
                                
        ?>
    </ul>