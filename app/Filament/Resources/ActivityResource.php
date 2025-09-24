<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
use UnitEnum;
use BackedEnum;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar';

    protected static UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Activity')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($set, $get, ?string $old, ?string $state) {
                                if (filled($old)) {
                                    return;
                                }
                                $set('slug', Str::slug((string) $state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->unique(ignoreRecord: true)
                            ->required(),
                        Forms\Components\Textarea::make('excerpt')->rows(3)->columnSpanFull(),
                        Forms\Components\RichEditor::make('description')->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')->disk('public')->image()->directory('activities')->imageEditor(),
                        Forms\Components\DateTimePicker::make('starts_at')
                            ->required()
                            ->default(fn () => now())
                            ->seconds(false)
                            ->timezone(config('app.timezone')),
                        Forms\Components\DateTimePicker::make('ends_at')
                            ->seconds(false)
                            ->timezone(config('app.timezone')),
                        Forms\Components\Toggle::make('is_visible')->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('image_path')->label('Image'),
                Tables\Columns\TextColumn::make('starts_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('ends_at')->dateTime()->sortable(),
                Tables\Columns\IconColumn::make('is_visible')->boolean()->label('Visible'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('visible')
                    ->label('Visible Only')
                    ->query(fn ($query) => $query->where('is_visible', true)),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'past' => 'Past',
                    ])
                    ->query(function ($query, array $data) {
                        if (($data['value'] ?? null) === 'upcoming') {
                            $query->where(function ($q) {
                                $q->whereDate('starts_at', '>=', now()->startOfDay())
                                  ->orWhere(function ($q2) {
                                      $q2->whereNotNull('ends_at')
                                         ->where('ends_at', '>=', now());
                                  });
                            });
                        } elseif (($data['value'] ?? null) === 'past') {
                            $query->where('starts_at', '<', now());
                        }
                    }),
                Tables\Filters\Filter::make('starts_between')
                    ->label('Starts Between')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('to'),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['from'])) {
                            $query->whereDate('starts_at', '>=', $data['from']);
                        }
                        if (!empty($data['to'])) {
                            $query->whereDate('starts_at', '<=', $data['to']);
                        }
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canViewAny(): bool
    {
        return auth('admin')->check();
    }

    public static function canCreate(): bool
    {
        return auth('admin')->user()?->hasAnyRole(['admin','moderator']) === true;
    }

    public static function canEdit($record): bool
    {
        return auth('admin')->user()?->hasAnyRole(['admin','moderator']) === true;
    }

    public static function canDelete($record): bool
    {
        return auth('admin')->user()?->hasRole('admin') === true;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}


