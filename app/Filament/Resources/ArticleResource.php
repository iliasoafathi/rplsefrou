<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Article')
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
                        Forms\Components\Textarea::make('excerpt')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->toolbarButtons([
                                'bold', 'italic', 'strike', 'underline', 'link', 'orderedList', 'bulletList', 'blockquote', 'codeBlock', 'h2', 'h3', 'undo', 'redo',
                            ])
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('cover_image_path')
                            ->disk('public')
                            ->image()
                            ->directory('articles')
                            ->imageEditor()
                            ->downloadable()
                            ->openable(),
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible')
                            ->default(true),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Published At')
                            ->seconds(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('cover_image_path')->label('Cover'),
                Tables\Columns\IconColumn::make('is_visible')->boolean()->label('Visible'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('visible')
                    ->label('Visible Only')
                    ->query(fn ($query) => $query->where('is_visible', true)),
                Tables\Filters\Filter::make('published_between')
                    ->label('Published Between')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('to'),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['from'])) {
                            $query->whereDate('published_at', '>=', $data['from']);
                        }
                        if (!empty($data['to'])) {
                            $query->whereDate('published_at', '<=', $data['to']);
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}


