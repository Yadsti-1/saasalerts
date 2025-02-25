<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalendarResource\Pages;
use App\Models\Calendar;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class CalendarResource extends Resource
{
    protected static ?string $model = Calendar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('year')
                    ->label('Año')
                    ->required()
                    ->unique()
                    ->numeric(),
                FileUpload::make('file_path')
                    ->label('Archivo PDF')
                    ->disk('public')
                    ->directory('calendars')
                    ->acceptedFileTypes(['application/pdf'])
                    ->preserveFilenames()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')->sortable()->label('Año'),
                TextColumn::make('file_path')
                    ->label('Archivo')
                    ->formatStateUsing(fn ($state) =>"<a href='/storage/$state' target='_blank'>Ver PDF</a>")
                    ->html(),
                TextColumn::make('user.name')
                    ->label('Subido por')
                    ->sortable(),
                TextColumn::make('uploaded_at')
                    ->label('Fecha de subida')
                    ->sortable()
                    ->dateTime('d/m/Y H:i'), // Formato amigable
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalendars::route('/'),
            'create' => Pages\CreateCalendar::route('/create'),
            'edit' => Pages\EditCalendar::route('/{record}/edit'),
        ];
    }

    public static function beforeCreate($record)
    {
        $record->user_id = Auth::id();
        $record->uploaded_at = now();
    }
}
