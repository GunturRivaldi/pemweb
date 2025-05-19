<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GuruResource\Pages;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuruExport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nip')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),
                Forms\Components\Select::make('jenis_kelamin')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                Forms\Components\Textarea::make('alamat')
                    ->rows(3)
                    ->maxLength(65535),
                FileUpload::make('foto')
                    ->image()
                    ->directory('guru-photos')
                    ->maxSize(1024) // maksimal 1MB
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->rounded()
                    ->square()
                    ->height(50)
                    ->width(50)
                    ->url(fn ($record) => $record->foto ? asset('storage/' . $record->foto) : null),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('nip')
                    ->searchable()
                    ->sortable()
                    ->label('NIP'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-laki' : ($state === 'P' ? 'Perempuan' : $state))
                    ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('alamat')
                    ->limit(50)
                    ->label('Alamat'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:i:s')
                    ->sortable()
                    ->label('Dibuat Pada'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->label('Filter Jenis Kelamin'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Excel')
                    ->action(function () {
                        return Excel::download(new GuruExport, 'data_guru.xlsx');
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }

    public static function getPolicy(): string
    {
        return \App\Policies\GuruPolicy::class;
    }
}
