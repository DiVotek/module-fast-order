<?php

namespace Modules\FastOrder\Admin\FastOrderResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\FastOrder\Admin\FastOrderResource;

class ListFastOrders extends ListRecords
{
    protected static string $resource = FastOrderResource::class;
}
