<?php

namespace App\Models;

use Database\Factories\EmployerFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property string|null $logo
 * @property string|null $website
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $user_id
 * @property-read Collection<int, JobVacancy> $jobVacancies
 * @property-read int|null $job_vacancies_count
 * @method static EmployerFactory factory($count = null, $state = [])
 * @method static Builder<static>|Employer newModelQuery()
 * @method static Builder<static>|Employer newQuery()
 * @method static Builder<static>|Employer query()
 * @method static Builder<static>|Employer whereAddress($value)
 * @method static Builder<static>|Employer whereCreatedAt($value)
 * @method static Builder<static>|Employer whereDescription($value)
 * @method static Builder<static>|Employer whereEmail($value)
 * @method static Builder<static>|Employer whereId($value)
 * @method static Builder<static>|Employer whereLogo($value)
 * @method static Builder<static>|Employer whereName($value)
 * @method static Builder<static>|Employer wherePhone($value)
 * @method static Builder<static>|Employer whereUpdatedAt($value)
 * @method static Builder<static>|Employer whereUserId($value)
 * @method static Builder<static>|Employer whereWebsite($value)
 * @mixin Eloquent
 */
class Employer extends Model
{
    /** @use HasFactory<EmployerFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'phone',
        'logo',
        'website',
        'description',
    ];

    public function jobVacancies(): HasMany
    {
        return $this->hasMany(JobVacancy::class);
    }
}
