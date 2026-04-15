<?php
$file = 'customizer.dat';
$data = file_get_contents($file);
$unserialized = unserialize($data);

array_walk_recursive($unserialized, function(&$item, $key){
    if(is_string($item)) {
        $item = str_replace('glozin', 'foodforlife', $item);
        $item = str_replace('Glozin', 'FoodForLife', $item);
        $item = str_replace('GLOZIN', 'FOODFORLIFE', $item);
    }
});

if(isset($unserialized['template'])) {
    $unserialized['template'] = str_replace('glozin', 'foodforlife', $unserialized['template']);
}

file_put_contents('customizer_fixed.dat', serialize($unserialized));
echo "Fixed customizer.dat\n";
