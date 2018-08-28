<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2018/08/28
 * Time: 18:19
 */
declare(strict_types=1);

require_once 'Game.php';

$game = new Game(new Scorer());

$game->add(1);
$game->add(4);
$game->add(4);
$game->add(5);
$game->add(6);
$game->add(4);
$game->add(5);
$game->add(5);
$game->add(10);
$game->add(0);
$game->add(1);
$game->add(7);
$game->add(3);
$game->add(6);
$game->add(4);
$game->add(10);
$game->add(2);
$game->add(8);
$game->add(6);

echo $game->score();

