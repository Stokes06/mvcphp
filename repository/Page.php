<?php
namespace Repository;
class Page{

    protected $content;
    protected $numberTotalOfRows;

    /**
     * Page constructor.
     * @param $content
     */
    public function __construct($content, $count)
    {
        $this->content = $content;
        $this->numberTotalOfRows = $count;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberTotalOfRows()
    {
        return $this->numberTotalOfRows;
    }

    /**
     * @param mixed $numberTotalOfRows
     * @return Page
     */
    public function setNumberTotalOfRows($numberTotalOfRows)
    {
        $this->numberTotalOfRows = $numberTotalOfRows;
        return $this;
    }


}