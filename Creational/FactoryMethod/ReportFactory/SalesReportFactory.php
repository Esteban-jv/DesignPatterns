<?php

class SalesReportFactory extends ReportFactory
{

    public function createReport(): Report
    {
        return new SalesReport();
    }
}