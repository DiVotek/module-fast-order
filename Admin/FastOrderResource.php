<?php

namespace Modules\FastOrder\Admin;

use App\Models\Language;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\FastOrder\Models\FastOrder;
use Modules\FastOrder\Admin\FastOrderResource\Pages;

class FastOrderResource extends Resource
{
    protected static ?string $model = FastOrder::class;


    public static function getNavigationGroup(): ?string
    {
        return __('Sales');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getModelLabel(): string
    {
        return __('Fast order');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Fast orders');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
                TableSchema::getPhone(),
                TableSchema::getProduct(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return __(FastOrder::STATUSES[$record->status]);
                    }),
                TableSchema::getUpdatedAt(),
            ])
            ->headerActions([
                Action::make(__('Help'))
                    ->iconButton()
                    ->icon('heroicon-o-question-mark-circle')
                    ->modalDescription(__('Here you can manage blog categories. Blog categories are used to group blog articles. You can create, edit and delete blog categories as you want. Blog category will be displayed on the blog page or inside slider(modules section). If you want to disable it, you can do it by changing the status of the blog category.'))
                    ->modalFooterActions([]),
                Tables\Actions\Action::make('Settings')
                    ->slideOver()
                    ->icon('heroicon-o-cog')
                    ->modal()
                    ->fillForm(function (): array {
                        return [
                            'show' => setting(config('settings.fastOrder.show'), false),
                            'name' => setting(config('settings.fastOrder.name'), []),
                            'design' => setting(config('settings.fast0rder.design'), 'fast-order.default'),
                        ];
                    })
                    ->action(function (array $data): void {
                        setting([
                            config('settings.fastOrder.show') => $data['show'],
                            config('settings.fastOrder.name') => $data['name'],
                        ]);
                    })
                    ->form(function ($form) {
                        $fields = [
                            TextInput::make('name.' . main_lang())
                                ->label(__('Name'))
                                ->required(),
                        ];
                        if (is_multi_lang()) {
                            foreach (Language::all() as $lang) {
                                if ($lang->id == main_lang_id()) {
                                    continue;
                                }
                                $fields[] = TextInput::make('name.' . $lang->slug)
                                    ->label(__('Name') . ' ' . $lang->name)
                                    ->required();
                            }
                        }
                        return $form
                            ->schema([
                                Section::make('')->schema([
                                    Toggle::make('show')
                                        ->label(__('Show fast order'))
                                        ->helperText(__('Enable or disable fast order button'))
                                        ->required(),
                                    ...$fields,
                                    Schema::getModuleTemplateSelect('fast-order'),
                                ]),
                            ]);
                    }),
            ])
            ->filters([
                TableSchema::getFilterStatus(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFastOrders::route('/'),
            'view' => Pages\ViewFastOrder::route('/{record}'),
        ];
    }
}
