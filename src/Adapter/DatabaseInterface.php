<?php
namespace Adapter;

interface DatabaseInterface
{
    public function prepare($statement): DatabaseStatementInterface;
}