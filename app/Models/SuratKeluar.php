<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SuratKeluar extends Model
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
        'tgl_sk',
        'file_sk',
        'tujuan_surat',
        'perihal',
        'pegawai_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }

    public function sk()
    {
        return $this->hasMany(KodeSurat::class,'id','kode_surat_id');
    }

    public function pgw()
    {
        return $this->hasMany(Pegawai::class, 'id', 'pegawai_id');
    }
}
