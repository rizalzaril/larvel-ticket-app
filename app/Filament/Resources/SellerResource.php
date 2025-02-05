<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellerResource\Pages;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Storage;

class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('seller_name')
                    // ->live()
                    // ->afterStateUpdated(function (Set $set, $state) {
                    //     $set('slug', Str::slug($state));  // Update slug based on seller name
                    // })
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),  // Disable slug field to be auto-generated
                Forms\Components\TextInput::make('seller_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('photo')
                    ->disk('public')  // Menyimpan file di disk public
                    ->directory('sellers')  // Menyimpan di folder sellers
                    ->image()  // Pastikan hanya gambar yang di-upload
                    ->required(),  // Menambahkan validasi wajib
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('seller_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('seller_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('photo')
                    ->searchable()
                    ->width(50)
                    ->height(50)
                    ->extraImgAttributes(['loading' => 'lazy']) // Optimasi performa
                    ->circular()
                    ->url(fn($record) => asset('storage/' . $record->photo))
                    ->disk('public')  // Pastikan menggunakan disk public untuk menampilkan gambar
                    ->checkFileExistence(true),  // Cek jika file ada
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSellers::route('/'),
            'create' => Pages\CreateSeller::route('/create'),
            'edit' => Pages\EditSeller::route('/{record}/edit'),
        ];
    }
}
