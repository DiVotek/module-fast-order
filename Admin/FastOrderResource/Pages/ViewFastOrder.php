<?php

namespace Modules\FastOrder\Admin\FastOrderResource\Pages;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\FastOrder\Admin\FastOrderResource;
use Modules\FastOrder\Models\FastOrder;
use Modules\Product\Models\Product;

class ViewFastOrder extends ViewRecord
{
    protected static string $resource = FastOrderResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        if ($infolist->record->status != 1) $infolist->record->update(['status' => FastOrder::ON]);

        return $infolist
            ->schema([
                Section::make(__('Details'))
                    ->schema([
                        KeyValueEntry::make('details')
                            ->columnSpanFull()
                            ->hiddenLabel()
                            ->keyLabel(__('Order info'))
                            ->valueLabel(false)
                            ->getStateUsing(function ($record) {
                                return [
                                    __('Name') => $record->name,
                                    __('Phone') => $record->phone,
                                    __('Product') => Product::query()->find($record->product_id)->name,
                                    __('Status') => __(FastOrder::STATUSES[$record->status]),
                                    __('Updated at') => $record->updated_at->format('d.m.Y H:i:s'),
                                ];
                            }),
                    ])->collapsible(),
            ]);
    }
}
