<?php

namespace ModulusCore\Services;

interface ServiceInterface
{
    public function create($data);

    public function update($data);

    public function delete($data);
}
