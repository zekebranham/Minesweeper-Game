<?php


$mode = $_GET['mode'] ?? 'beginner';

$modes = [
    'beginner' => ['rows' => 8, 'cols' => 8, 'mines' => 10],
    'intermediate' => ['rows' => 16, 'cols' => 16, 'mines' => 40],
    'expert' => ['rows' => 16, 'cols' => 30, 'mines' => 99],
];

echo json_encode($modes[$mode]);
?>
