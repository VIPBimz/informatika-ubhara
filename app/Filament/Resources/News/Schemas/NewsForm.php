<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori Berita')
                    ->relationship('category', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('judul')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Select::make('status')
                    ->label('Status Publikasi')
                    ->options([
                        'draft' => 'Draft (Draf Penulisan)',
                        'published' => 'Published (Tayang di Web)',
                    ])
                    ->default('draft')
                    ->required(),
                DatePicker::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->default(now()),
                Toggle::make('is_featured')
                    ->label('Tampilkan sebagai Berita Unggulan (Featured)'),
                FileUpload::make('cover')
                    ->label('Gambar Sampul (Cover)')
                    ->image()
                    ->directory('news')
                    ->columnSpanFull(),
                Textarea::make('ringkasan')
                    ->label('Ringkasan Singkat')
                    ->placeholder('Ringkasan 1-2 kalimat untuk preview card...')
                    ->rows(2)
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),
                RichEditor::make('konten')
                    ->label('Konten Lengkap')
                    ->required()
                    ->columnSpanFull(),
                Select::make('penulis_id')
                    ->label('Penulis / Editor')
                    ->relationship('author', 'name')
                    ->default(fn () => auth()->id())
                    ->required(),
            ]);
    }
}
