<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommonQuestionsResource\Pages;
use App\Filament\Resources\CommonQuestionsResource\RelationManagers;
use App\Models\CommonQuestion;
use App\Models\CommonQuestions;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CommonQuestionsResource extends Resource
{
    protected static ?string $model = CommonQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'FQA Questions - FQAQ -';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Group::make()->schema([
                    Section::make('Question')->schema([

                        TextInput::make('question')
                            ->label('FQA Question')
                            ->required()
                            ->minValue(2)
                            ->reactive()
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                if (! $get('is_slug_changed_manually') && filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->maxValue(50),

                        TextInput::make('slug')
                            ->label('FQA Question Slug')
                            ->required()
                            ->minValue(2)
                            ->maxValue(50)
                            ->afterStateUpdated(function (Set $set) {
                                $set('is_slug_changed_manually', true);
                            }),

                        Hidden::make('is_slug_changed_manually')
                            ->default(false)
                            ->dehydrated(false),

                        MarkdownEditor::make('answer')
                            ->label('FQA Answer')
                            ->required()
                            ->columnSpanFull(),

                    ])->columns(2),
                ]),

                Group::make()->schema([

                    Section::make('Visibility & Publishing')
                        ->schema([

                            Select::make('status')
                                ->label('FQA Status')
                                ->helperText('Visible questions will automatically show.')
                                ->options([
                                    'visible' => 'Visible',
                                    'invisible' => 'Invisible',
                                ]),

                            DateTimePicker::make('published_at')
                                ->label('Publish Question At'),
                        ]),


                    Section::make('Category')
                        ->schema([

                            Select::make('common_question_category_id')
                                ->relationship('category', 'name_en')
                                ->searchable()
                                ->label('Category'),

                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                TextColumn::make('question')
                    ->label('Common Question')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($record) => ucfirst($record->question)),

                TextColumn::make('slug')
                    ->label('FQA Slug')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category.name_en')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('FQA Status')
                    ->sortable()
                    ->formatStateUsing(fn($record) => ucfirst($record->status))
                    ->searchable(),

                TextColumn::make('published_at')
                    ->label('Published at')
                    ->sortable()
                    ->dateTime()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Added at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label('Deleted at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //

                SelectFilter::make('status')
                    ->label('FQA Visibility')
                    ->options([
                        'visible' => 'Visible',
                        'invisible' => 'Invisible',
                    ]),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCommonQuestions::route('/'),
            'create' => Pages\CreateCommonQuestions::route('/create'),
            'edit' => Pages\EditCommonQuestions::route('/{record}/edit'),
        ];
    }
}
