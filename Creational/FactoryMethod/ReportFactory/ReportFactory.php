<?php

abstract class ReportFactory
{
    // NOTA: En este caso se usa protected porque no queremos que se pueda instanciar directamente desde la clase cliente
    // pero queremos que las subclases puedan acceder a este método
    abstract protected function createReport(): Report;

    public function generateReport(): void
    {
        $report = $this->createReport();
        $report->generate();
    }
}