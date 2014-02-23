<?php

require_once 'models/BaseObject.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author Gourav Sarkar
 */
class Pagination extends BaseObject implements XMLSerializeble {

    //put your code here
    //use RenderbleTrait;
    //const ITEM_PER_PAGE = 2;

    private $page;
    private $offset = 0;
    private $limit;
    private $totalPage = 1;
    private $itemPerPage = 10;

    public function __construct($page, $itemPaerPage) {
        if (!empty($page) && is_numeric($page) && $page > 1) {
            $this->page = $page;
        }

        if (!empty($itemPaerPage) && is_numeric($itemPaerPage)) {
            $this->itemPerPage = $itemPaerPage;
        }
    }

    public function getLimit() {
        return $this->itemPerPage;
    }

    public function getOffset() {
        if ($this->page > 1) {
            $this->offset = (($this->page - 1) * $this->itemPerPage);
        }

        return $this->offset;
    }

    public function CountTotalPage() {
        $stmt = DatabaseHandle::getConnection()->query("SELECT FOUND_ROWS()");
        $data = $stmt->fetch();
        $this->totalPage = $data[0] / $this->itemPerPage;

        return $this->totalPage;
    }

    public function xmlSerialize() {

        /*
         * Serialize only when there is more than one page
         * otherwise it dont need to be serialize
         */
        if ($this->totalPage > 1) {
            $xmlSer = new XMLSerialize($this);

            /*
             * Filter
             */
            //$xmlSer->addFilter('itemPerPage');

            //var_dump($xmlSer->xmlSerialize());
            $xmlSer->getWriter()->startElement((string) $this);
            $xmlSer->getWriter()->writeRaw($xmlSer->xmlSerialize());
            $xmlSer->getWriter()->endElement();

            return $xmlSer->getWriter()->outputMemory(true);
        }

        return '';
    }

}

?>
