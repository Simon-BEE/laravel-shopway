<?php

namespace App\Traits\Classify;

trait IsFilterableWithLivewire
{
    public $perPage = 10;
    public $searchTerm;
    public $sortField ='name';
    public $sortAsc = true;

    public function updatedSearchTerm($value)
    {
        $this->gotoPage(1);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        }else{
            $this->sortAsc = true;
        }

        $this->sortField = $field;

        $this->gotoPage(1);
    }
}