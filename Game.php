<?php
/**
 * Created by PhpStorm.
 * User: sizukutamago
 * Date: 2018/08/28
 * Time: 18:19
 */
declare(strict_types=1);

require_once 'Scorer.php';

class Game
{
    /**
     * @var int
     */
    private $itsCurrentFrame = 0;

    /**
     * @var bool
     */
    private $firstThrowInFrame = true;

    /**
     * @var Scorer
     */
    private $itsScorer;

    public function __construct(Scorer $scorer)
    {
        $this->itsScorer = $scorer;
    }

    public function score(): int
    {
        return $this->scoreForFrame($this->itsCurrentFrame);
    }

    public function add(int $pins): void
    {
        $this->itsScorer->addThrow($pins);
        $this->adjustCurrentFrame($pins);
    }

    private function adjustCurrentFrame(int $pins): void
    {
        if ($this->lastBallInFrame($pins)) {
            $this->advanceFrame();
        } else {
            $this->firstThrowInFrame = false;
        }
    }

    private function lastBallInFrame(int $pins): bool
    {
        return $this->strike($pins) || !$this->firstThrowInFrame;
    }

    private function strike(int $pins): bool
    {
        return ($this->firstThrowInFrame && $pins === 10);
    }

    private function advanceFrame(): void
    {
        $this->itsCurrentFrame = min(10, $this->itsCurrentFrame + 1);
    }

    public function scoreForFrame(int $theFrame): int
    {
        return $this->itsScorer->scoreForFrame($theFrame);
    }
}