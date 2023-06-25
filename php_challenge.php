<!DOCTYPE html>
<html>
<head>
	<style>
    	td {
        	 background-color:red;
             width:10px;
             height:10px;

        }
    </style>
</head>
<body>

<?php

$a = 50;
$pocet = 0;
$b = 40;
$pole=array();


for ($i=0;$i<$b;$i++){

	$pole[$i] = array();
	for ($j=0;$j<$a;$j++){
		$pole[$i][$j] = 1;

	}

}

$pole_v = $pole;

function zmen($index,$xx, $farba){
	global $pole_v;

   	$g = $xx;
    for ($x=0;$x<count($pole_v[$index]);$x++){

         if ($x < $g){

              if ($pole_v[$index][$x] != 1){
                 $g++;
              }else{

                  $pole_v[$index][$x] = $farba;
              }

         }


    }


}
$memory = array();
$pary = array();

function la1(){
	global $memory,$pary;

    for ($y=2;$y<=count($memory);$y++){
        for ($x=count($memory)-1;$x>$y-2;$x--){
        	$pary_p = $memory[$x][2];
            $b = 1;
            $pary1 = array();
            $spolu = 0;
            for ($z=$x;$z>$x-$y;$z--){

				if ($pary_p !=$memory[$z][2]){
                	$b = 0;
                }
                array_push($pary1, $memory[$z][2]);
                $spolu+=$memory[$z][2];
            }

            if ($b){
            	array_push($pary,$pary1);
            }
            print_r($spolu.'aaaa'.$memory[$x-$y][2]);
            if ($spolu == $memory[$x-$y][2]){
            	array_splice($memory, $x-$y+1);
                array_push($memory,['ff',$spolu/$y,$spolu]);

                la1();
            }


    	}
    }
}
function la($pole){
	global $pocet,$pole_v,$pole,$memory;
	$sir= count($pole);

	$dl= count($pole[0]);
    if ($dl == 0 && $sir == 0 ){
    	return 0;
    }
    array_push($memory, array());
 	$color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    if ($dl > $sir){
   		$pocet++;
        array_push($memory[count($memory)-1], $color,'dl',$sir);
    	for ($i=0;$i<$sir;$i++){
        	zmen($i,$sir,$color);
        	array_splice($pole[$i],0, $sir);
        }

    }else{
    	$pocet++;
        $poz = 1;
        $o = $dl;
        array_push($memory[count($memory)-1], $color,'sir',$dl);
        for ($y=0;$y<$o;$y++){
        	for ($x=0;$x<count($pole_v[$y]);$x++){
            	if ($pole_v[$y][$x] == 1){
                	$pole_v[$y][$x]=$color;
                    $poz = 0;
                }

            }
            if ($poz){
                $o++;
            }
        }
    	array_splice($pole,0, $dl);
    }



    la($pole);

}
la($pole);
la1();

print_r($pary);

echo '<table>';
for ($i=0;$i<count($pole_v);$i++){
	echo '<tr>';

	for ($j=0;$j<count($pole_v[$i]);$j++){

        echo '<td style=background-color:'.$pole_v[$i][$j].'></td>';
	}
    echo '</tr>';
}

?>

</body>
</html>
