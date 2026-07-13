<?php

namespace Dapodik\Laravel\API\Contracts;

interface ResponseContract
{
    public function toArray();

    public function toCollection();

    public function toJson();
}
