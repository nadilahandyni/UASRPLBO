<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SuratMasuk extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kode_surat_id',
        'user_id',
        'no_surat',
        'tgl_sm',
        'file_sm',
        'asal_surat',
        'tujuan_sm',
        'perihal',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tujuan_sm' => 'array',
    ];

    public function sm()
    {
        return $this->hasMany(KodeSurat::class,'id','kode_surat_id');
    }
}
