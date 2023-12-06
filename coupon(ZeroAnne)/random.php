<?php
$letters = range('A', 'Z');

// 生成多个随机字母
$numberOfRandomLetters = 3; // 你可以根据需要更改此数量
for ($i = 0; $i < $numberOfRandomLetters; $i++) {
    $randomLetter = $letters[array_rand($letters)];
    // echo "$randomLetter";
}
$letter = range('1', '2');
$number = 4;
for ($i = 0; $i < $number; $i++) {
    $Number = $letter[array_rand($letter)];
    // echo "$Number";
}
$codeRandom = $randomLetter . $Number;
echo $codeRandom;

?>
