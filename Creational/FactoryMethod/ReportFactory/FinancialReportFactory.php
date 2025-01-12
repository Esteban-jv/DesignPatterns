<?php

class FinancialReportFactory extends ReportFactory
{

    public function createReport(): Report
    {
        // add some extra logic here
        return new FinantialReport();
    }
}