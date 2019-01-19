<?php

namespace filter;

use request\Request;

interface RequestFilter {

    public function canHandle(Request $request);

    public function filter(Request $request);

}