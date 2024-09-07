<?php

namespace App\Filament\Resources\CommonQuestionCategoryResource\Pages;

use App\Filament\Resources\CommonQuestionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommonQuestionCategory extends EditRecord
{
    protected static string $resource = CommonQuestionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
