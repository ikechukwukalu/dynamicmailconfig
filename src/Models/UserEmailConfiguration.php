<?php

namespace Ikechukwukalu\Dynamicmailconfig\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserEmailConfiguration extends Model
{
    use HasFactory;

    protected $hidden = [
        'driver',
        'host',
        'port',
        'encryption',
        'username',
        'password'
    ];

    public function scopeConfiguredEmail($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function getEmailConfig(): array
    {
        return [
            'driver' => $this->driver,
            'host' => $this->host,
            'port' => $this->port,
            'from' => ['address' => $this->address, 'name' => $this->name],
            'encryption' => $this->encryption,
            'username' => $this->username,
            'password' => $this->password
        ];
    }

    public function setDriverAttribute($value)
    {
        return $this->encryptField('driver', $value);
    }

    public function setHostAttribute($value)
    {
        return $this->encryptField('host', $value);
    }

    public function setPortAttribute($value)
    {
        return $this->encryptField('port', $value);
    }

    public function setEncryptionAttribute($value)
    {
        return $this->encryptField('encryption', $value);
    }

    public function setUserNameAttribute($value)
    {
        return $this->encryptField('username', $value);
    }

    public function setPasswordAttribute($value)
    {
        return $this->encryptField('password', $value);
    }

    public function getDriverAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function getHostAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function getPortAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function getEncryptionAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function getUserNameAttribute($value)
    {
        return $this->decryptField($value);
    }

    public function getPasswordAttribute($value)
    {
        return $this->decryptField($value);
    }

    private function encryptField(string $field, $value)
    {
        if (config('dynamicmailconfig.hash', true)) {
            return $this->attributes[$field] = Crypt::encryptString($value);
        }

        return $value;
    }

    private function decryptField($value)
    {
        if (config('dynamicmailconfig.hash', true)) {
            return Crypt::decryptString($value);
        }

        return $value;
    }
}
