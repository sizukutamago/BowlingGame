<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2018/08/28
 * Time: 18:21
 */
declare(strict_types=1);

class Scorer
{
    /**
     * @var int
     */
    private $ball;

    /**
     * @var int[]
     */
    private $itsThrows = [];

    /**
     * @var int
     */
    private $itsCurrentThrow = 0;

    public function __construct()
    {
        $this->itsThrows = array_fill(0, 22, 0);
        var_dump($this->itsThrows);
    }

    public function addThrow(int $pins): void
    {
        $this->itsThrows[$this->itsCurrentThrow++] = $pins;
    }

    public function scoreForFrame(int $theFrame): int
    {
        $this->ball = 0;
        $score = 0;

        for ($currentFrame = 0; $currentFrame < $theFrame; $currentFrame++) {
            if ($this->strike()) {
                $score += 10 + $this->nextTwoBallsForStrike();
                $this->ball++;
            } elseif ($this->spare()) {
                $score += 10 + $this->nextBallForSpare();
                $this->ball += 2;
            } else {
                $score += $this->twoBallsInFrame();
                $this->ball += 2;
            }
        }
        return $score;
    }

    private function strike(): bool
    {
        return $this->itsThrows[$this->ball] === 10;
    }

    private function spare(): bool
    {
        return ($this->itsThrows[$this->ball] + $this->itsThrows[$this->ball + 1]) === 10;
    }

    private function nextTwoBallsForStrike(): int
    {
        return $this->itsThrows[$this->ball + 1] + $this->itsThrows[$this->ball + 2];
    }

    private function nextBallForSpare(): int
    {
        return $this->itsThrows[$this->ball + 2];
    }

    private function twoBallsInFrame(): int
    {
        return $this->itsThrows[$this->ball] + $this->itsThrows[$this->ball + 1];
    }
}