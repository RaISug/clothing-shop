<?php

namespace service;

class TableBuilder {

    private $headers;
    private $allRows;
    private $rowValues;

    public function __construct() {
        $this->headers = array();
        $this->allRows = array();
        $this->rowValues = array();
    }

    public function withHeader($name) {
        $this->headers[] = $name;
        
        return $this;
    }

    public function newRow() {
        $this->allRows[] = $this->rowValues;
        $this->rowValues = array();

        return $this;
    }

    public function withRowValue($value) {
        $this->rowValues[] = $value;

        return $this;
    }

    public function build() {
        $this->allRows[] = $this->rowValues;

        $tableHeader = '';
        foreach ($this->headers as $header) {
            $tableHeader .= "<th>" . $header . "</th>";
        }

        $tableHeader = "<tr>" . $tableHeader . "</tr>";

        $tableRows = '';
        foreach ($this->allRows as $rows) {
            $tableRow = '';
            foreach ($rows as $row) {
                $tableRow .= "<td>" . $row . "</td>";
            }

            $tableRows .= "<tr>" . $tableRow . "</tr>";
        }

        return "<table border='1'>" . $tableHeader . "" . $tableRows . "</table>";
    }

}