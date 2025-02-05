<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Actions\ViewAction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\Action;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_tickets')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('thumbnail')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('path_video')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('about')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_popular')
                    ->required(),
                Forms\Components\DateTimePicker::make('open_time_at'),
                Forms\Components\DateTimePicker::make('closed_time_at'),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'category_name')
                    ->required(),
                Forms\Components\Select::make('seller_id')
                    ->relationship('seller', 'seller_name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_tickets')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('path_video')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_popular')
                    ->boolean(),
                Tables\Columns\TextColumn::make('open_time_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('closed_time_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.category_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('seller.seller_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(), // Tombol Lihat Detail
                Tables\Actions\EditAction::make(),
                Action::make('Export PDF')
                    ->label('Export to PDF')

                    ->action(function ($record) {
                        // Generate PDF
                        $pdf = Pdf::loadView('pdf.ticket', ['ticket' => $record]);

                        // Simpan PDF ke storage dan unduh
                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            "ticket-{$record->id}.pdf"
                        );
                    }),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
