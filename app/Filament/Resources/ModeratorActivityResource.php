<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModeratorActivityResource\Pages;
use App\Models\ModeratorActivity;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use UnitEnum;
use BackedEnum;

class ModeratorActivityResource extends Resource
{
    protected static ?string $model = ModeratorActivity::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static UnitEnum|string|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Activity History';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Activity Details')
                    ->schema([
                        Forms\Components\Select::make('admin_id')
                            ->relationship('admin', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('action')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('model_type')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('model_id')
                            ->required()
                            ->numeric(),
                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\KeyValue::make('old_data')
                            ->columnSpanFull(),
                        Forms\Components\KeyValue::make('new_data')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('admin.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('action')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('model_type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('action')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),
                Tables\Filters\SelectFilter::make('model_type')
                    ->options([
                        'App\Models\Article' => 'Articles',
                        'App\Models\Activity' => 'Activities',
                        'App\Models\Member' => 'Members',
                        'App\Models\StaticPage' => 'Static Pages',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function canViewAny(): bool
    {
        return auth('admin')->user()?->hasRole('admin') === true;
    }

    public static function canCreate(): bool
    {
        return false; // Activities are created automatically
    }

    public static function canEdit($record): bool
    {
        return false; // Activities should not be edited
    }

    public static function canDelete($record): bool
    {
        return auth('admin')->user()?->hasRole('admin') === true;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModeratorActivities::route('/'),
            'view' => Pages\ViewModeratorActivity::route('/{record}'),
        ];
    }
}
