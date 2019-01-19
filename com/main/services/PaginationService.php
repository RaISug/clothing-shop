<?php

namespace service;

use request\Request;
use exception\BadRequestException;

class PaginationService {

    public function getPage(Request $request) {
        $page = $request->getQueryParameter("page");
        if ($page != null && is_numeric($page) === false) {
            throw new BadRequestException("Page parameter must be an integer.");
        }

        return $page == null ? 0 : intval($page);
    }

    public function getOffset(Request $request) {
        $offset = $request->getQueryParameter("offset");
        if ($offset != null && is_numeric($offset) === false) {
            throw new BadRequestException("Offset parameter must be an integer.");
        }

        if ($offset == null || intval($offset) > 50) {
            $offset = 50;
        }

        return intval($offset);
    }

}