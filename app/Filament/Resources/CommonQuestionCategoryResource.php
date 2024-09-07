<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommonQuestionCategoryResource\Pages;
use App\Filament\Resources\CommonQuestionCategoryResource\RelationManagers;
use App\Models\CommonQuestionCategory;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommonQuestionCategoryResource extends Resource
{
    protected static ?string $model = CommonQuestionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'FQA Questions - FQAQ -';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Group::make()->schema([

                    Section::make()->schema([
                        TextInput::make('name_ar')
                            ->label('Name AR')
                            ->helperText('AR for Arabic language')
                            ->required()
                            ->minValue(2)
                            ->maxValue(50),

                        TextInput::make('name_en')
                            ->label('Name EN')
                            ->helperText('EN for English language')
                            ->required()
                            ->minValue(2)
                            ->maxValue(50),

                    ])->columns(2),

                ]),

                Group::make()->schema([

                    Section::make('Visibility')->schema([
                        Select::make('status')
                            ->label('Category Status')
                            ->required()
                            ->in(['active', 'inactive'])
                            ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                            ->helperText('Active category will be visible'),
                    ]),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name_ar')
                    ->label('Name AR')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name_en')
                    ->label('Name EN')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($record) => ucfirst($record->name_en)),


                TextColumn::make('status')
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->label('Added at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Last use at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //

                SelectFilter::make('status')
                    ->label('Category Visibility')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive']),
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
            'index' => Pages\ListCommonQuestionCategories::route('/'),
            'create' => Pages\CreateCommonQuestionCategory::route('/create'),
            'edit' => Pages\EditCommonQuestionCategory::route('/{record}/edit'),
        ];
    }
}
