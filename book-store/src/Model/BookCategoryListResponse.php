<?php

namespace App\Model;

class BookCategoryListResponse
{

    /**
     * @param BookCategoryListItem[] $items
     */
    public function __construct(private array $items)
    {
    }

    /**
     * @return BookCategoryListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}
