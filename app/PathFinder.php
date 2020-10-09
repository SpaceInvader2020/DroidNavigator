<?php


namespace App;


class PathFinder
{
    const LEFT = 'l';
    const RIGHT = 'r';
    const FORWARD = 'f';

    /**
     * @var string
     */
    private $path;

    private $yDirection = -1;
    /**
     * @var integer
     */
    private $xPosition = 0;
    /*
     * @var integer
     */
    private $yPosition = 4;
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }


    public function stepLeft(){
        $this->path = $this->path.self::LEFT;
        $this->yPosition = $this->yPosition - 1;
    }

    public function stepRight(){
        $this->path = $this->path.self::RIGHT;
        $this->yPosition = $this->yPosition + 1;
    }

    public function stepForward(){
        $this->path = $this->path.self::FORWARD;
        $this->xPosition = $this->xPosition + 1;
    }

    public function stepBack(){
        $this->path = substr($this->path, 0, -1);
        $this->xPosition = $this->xPosition - 1;
    }


    public function clearPreviousMovingDirection(){
        $length = strlen($this->path);

        if($this->yDirection > 0) {

            $this->path = rtrim($this->path, self::RIGHT);
        }else{
            $this->path = rtrim($this->path, self::LEFT);
        }

        $newLength = strlen($this->path);
        $this->yPosition = $this->yPosition + ($length - $newLength) * $this->yDirection * (-1);
        $this->yDirection = $this->yDirection * (-1);
    }

    /**
     * @return int
     */
    public function getXPosition()
    {
        return $this->xPosition;
    }

    /**
     * @param int $xPosition
     */
    public function setXPosition($xPosition)
    {
        $this->xPosition = $xPosition;
    }

    /**
     * @return mixed
     */
    public function getYPosition()
    {
        return $this->yPosition;
    }

    /**
     * @param mixed $yPosition
     */
    public function setYPosition($yPosition)
    {
        $this->yPosition = $yPosition;
    }

    /**
     * @return int
     */
    public function getYDirection()
    {
        return $this->yDirection;
    }

    /**
     * @param int $yDirection
     */
    public function setYDirection($yDirection)
    {
        $this->yDirection = $yDirection;
    }

    public function stepLeftOrRight(){
        /**
         * Move Left or Right
         */
        if($this->yDirection < 0) {
            $this->stepLeft();
        }else{
            $this->stepRight();
        }
    }




}