<?php

class InventoryReportFactory extends ReportFactory
{

    public function createReport(): Report
    {
        return new InventoryReport();
    }
}